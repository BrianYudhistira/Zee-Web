from bs4 import BeautifulSoup
import requests
import json
import re
import mysql.connector
from datetime import datetime
import os
import sys
from dotenv import load_dotenv

# Fix encoding issues on Windows
if sys.platform.startswith('win'):
    import codecs
    sys.stdout = codecs.getwriter('utf-8')(sys.stdout.detach())
    sys.stderr = codecs.getwriter('utf-8')(sys.stderr.detach())

# Load environment variables from Laravel .env file
load_dotenv(os.path.join(os.path.dirname(os.path.dirname(os.path.dirname(__file__))), '.env'))

class API():
    def __init__(self):
        self.base_url = 'https://www.prydwen.gg'
        # Database configuration from Laravel .env
        self.db_config = {
            'host': os.getenv('DB_HOST', 'localhost'),
            'database': os.getenv('DB_DATABASE', 'zee_web'),
            'user': os.getenv('DB_USERNAME', 'root'),
            'password': os.getenv('DB_PASSWORD', ''),
            'port': int(os.getenv('DB_PORT', 3306)),
            'charset': 'utf8mb4',
            'autocommit': True
        }
        
        page_to_scrape = 'https://www.prydwen.gg/zenless/characters'
        self.soup = BeautifulSoup(requests.get(page_to_scrape).text, 'html.parser')
        
        # Initialize database connection
        self.db_connection = None
        self.connect_to_database()

    def connect_to_database(self):
        """Establish connection to MySQL database"""
        try:
            print("[DATABASE] Connecting to MySQL database...")
            self.db_connection = mysql.connector.connect(**self.db_config)
            print(f"[DATABASE] Successfully connected to database: {self.db_config['database']}")
        except mysql.connector.Error as e:
            print(f"[DATABASE] Failed to connect to database: {e}")
            self.db_connection = None

    def close_database_connection(self):
        """Close database connection"""
        if self.db_connection and self.db_connection.is_connected():
            self.db_connection.close()
            print("[DATABASE] Connection closed.")

    def extract_text_carefully(self, element):
        """Extract text while avoiding nested div content"""
        if not element:
            return ""
        
        result_parts = []
        
        # Process each direct child
        for content in element.contents:
            if hasattr(content, 'name'):  # It's a tag
                if content.name == 'div':
                    # Skip nested divs entirely
                    continue
                else:
                    # Other tags might have useful text
                    text = content.get_text(strip=True)
                    if text:
                        result_parts.append(text)
            else:  # It's a text node
                text = str(content).strip()
                if text and text not in ['\n', '\r\n', '\t']:
                    result_parts.append(text)
        
        result = ' '.join(result_parts)
        return ' '.join(result.split())  # Clean up whitespace

    def scrape_characters(self):
        characters = self.soup.find_all('div', class_='avatar-card card')
        char_data = {}
        detail_data_all = {}

        for character in characters:
            name_tag = character.find('span', class_='emp-name')
            link_tag = character.find('a')
            image_tag = character.find('img', src=lambda x: x and x.endswith('.webp'))
            element_div = character.find('div', class_='element')
            type_div = character.find('div', class_='class')
            tier_tag = character.find('div', class_=lambda c: c and 'rarity-' in c)
            if name_tag and link_tag and image_tag and element_div:
                name = name_tag.text
                link = self.base_url + link_tag['href']
                print(f"\n[SCRAPING] Starting character: {name}")
                print(f"[SCRAPING] Character URL: {link}")
                image = self.base_url + image_tag['src']
                picture_tag = element_div.find('picture')
                element_tag = picture_tag.find('img')
                element_type = element_tag['alt']
                type_tag = type_div.find('picture')
                type = type_tag.find('img')['alt'] if type_tag else None
                src = element_tag.get('src') or element_tag.get('data-src')
                element_pict = self.base_url + src if src.startswith('/') else src
                if tier_tag:
                    class_list = tier_tag.get('class', [])
                    match = re.search(r'rarity-([A-Z])', ' '.join(class_list))
                    if match:
                        tier = match.group(1)
                char_data[name] = {"Link": link, "Image": image, 'Element': element_type, "Element Pict": element_pict, "Tier": tier, "Type": type}
                # Scrape detail untuk setiap karakter
                print(f"[SCRAPING] Fetching details for {name}...")
                detail = self.scrape_details(link)
                detail_data_all[name] = detail
                print(f"[SCRAPING] > Completed character: {name}")


        with open('characters.json', 'w', encoding='utf-8') as f:
            json.dump(char_data, f, ensure_ascii=False, indent=4)

        print(f"\n[PROCESSING] Found {len(char_data)} characters to process")
        print("[PROCESSING] Starting data formatting...")

        # Format output sesuai permintaan user
        message = []
        now = datetime.now().strftime('%Y-%m-%d %H:%M:%S')  # MySQL datetime format
        id_counter = 1
        diskdrive_id = 1
        wengine_id = 1
        bestdiskdrivestat_id = 1
        for name in char_data:
            print(f"\n[FORMATTING] Processing character data: {name}")
            char = char_data[name]
            detail = detail_data_all.get(name)
            if detail is None:
                detail = {}
                print(f"[FORMATTING] No detail data found for {name}")
            else:
                print(f"[FORMATTING] Detail data found for {name}")
            # Format zzz_diskdrive
            zzz_diskdrive = []
            print(f"[FORMATTING] Processing {len(detail.get('Disk_Drive', []))} disk drives for {name}")
            for i, disk in enumerate(detail.get('Disk_Drive', []), 1):
                zzz_diskdrive.append({
                    "id": diskdrive_id,
                    "zzz_char_id": id_counter,
                    "name": disk.get("Disk Drive Name", "Unknown"),
                    "detail_2pc": disk.get("Disk Drive Detail 2pc", ""),
                    "detail_4pc": disk.get("Disk Drive Detail 4pc", ""),
                    "created_at": now,
                    "updated_at": now
                })
                diskdrive_id += 1
            # Format zzz_wengine
            zzz_wengine = []
            print(f"[FORMATTING] Processing {len(detail.get('W_engine', []))} W engines for {name}")
            for i, w in enumerate(detail.get('W_engine', []), 1):
                zzz_wengine.append({
                    "id": wengine_id,
                    "zzz_char_id": id_counter,
                    "build_name": w.get("Build", ""),
                    "build_s": w.get("Build S", ""),
                    "w_engine_picture": w.get("W Engine Pict", ""),
                    "detail": w.get("detail", ""),
                    "rarity": w.get("rarity", "Unknown"),
                    "created_at": now,
                    "updated_at": now
                })
                wengine_id += 1
            # Format zzz_bestdiskdrivestat
            zzz_bestdiskdrivestat = []
            best_stats = detail.get('Best_Disk_Drive_Stats', [])
            print(f"[FORMATTING] Processing {len(best_stats)} best disk drive stats for {name}")
            substats = ""
            endgame_stats = ""
            for i, stat in enumerate(best_stats, 1):
                disk_number = stat.get("Disk No", str(i))
                substats = stat.get("Substats", substats)
                endgame_stats = stat.get("Endgame Stats", endgame_stats)
                zzz_bestdiskdrivestat.append({
                    "id": bestdiskdrivestat_id,
                    "zzz_char_id": id_counter,
                    "disk_number": disk_number,
                    "substats": substats,
                    "endgame_stats": endgame_stats,
                    "created_at": now,
                    "updated_at": now
                })
                bestdiskdrivestat_id += 1
            message.append({
                "id": id_counter,
                "name": name,
                "link": char.get("Link", ""),
                "image": char.get("Image", ""),
                "element": char.get("Element", "unknown"),
                "element_picture": char.get("Element Pict", "unknown"),
                "tier": char.get("Tier", "unknown"),
                "type": char.get("Type", "unknown"),
                "created_at": now,
                "updated_at": now,
                "zzz_diskdrive": zzz_diskdrive,
                "zzz_wengine": zzz_wengine,
                "zzz_bestdiskdrivestat": zzz_bestdiskdrivestat
            })
            
            # Print data untuk setiap karakter
            char_output = {
                "id": id_counter,
                "name": name,
                "link": char.get("Link", ""),
                "image": char.get("Image", ""),
                "element": char.get("Element", "unknown"),
                "element_picture": char.get("Element Pict", "unknown"),
                "tier": char.get("Tier", "unknown"),
                "type": char.get("Type", "unknown"),
                "created_at": now,
                "updated_at": now,
                "zzz_diskdrive": zzz_diskdrive,
                "zzz_wengine": zzz_wengine,
                "zzz_bestdiskdrivestat": zzz_bestdiskdrivestat
            }
            # print(json.dumps(char_output, indent=4, ensure_ascii=False))  # Commented to avoid encoding issues
            print(f"[FORMATTING] > Completed formatting for character: {name}")
            print("-" * 80)
            id_counter += 1
        
        print(f"\n[COMPLETED] Successfully processed {len(message)} characters")
        print("[COMPLETED] Saving to database...")
        
        # Save to database instead of JSON file
        self.save_to_database(message)
        
        print("[COMPLETED] > All data saved to database successfully!")

    def save_to_database(self, characters_data):
        """Save scraped data directly to the database"""
        if not self.db_connection or not self.db_connection.is_connected():
            print("[DATABASE] No database connection available")
            return False
        
        try:
            cursor = self.db_connection.cursor()
            
            # Clear existing data (optional - comment out if you want to keep old data)
            print("[DATABASE] Clearing existing data...")
            cursor.execute("DELETE FROM zzz_bestdiskdrivestats")
            cursor.execute("DELETE FROM zzz_wengines") 
            cursor.execute("DELETE FROM zzz_diskdrives")
            cursor.execute("DELETE FROM zzz_chars")
            self.db_connection.commit()
            
            # Reset auto-increment IDs
            cursor.execute("ALTER TABLE zzz_chars AUTO_INCREMENT = 1")
            cursor.execute("ALTER TABLE zzz_diskdrives AUTO_INCREMENT = 1")
            cursor.execute("ALTER TABLE zzz_wengines AUTO_INCREMENT = 1")
            cursor.execute("ALTER TABLE zzz_bestdiskdrivestats AUTO_INCREMENT = 1")
            self.db_connection.commit()
            
            characters_saved = 0
            
            for char_data in characters_data:
                # Insert character
                char_query = """
                INSERT INTO zzz_chars (name, link, image, element, element_picture, tier, type, created_at, updated_at)
                VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)
                """
                char_values = (
                    char_data['name'][:255],  # Truncate to 255 chars
                    char_data['link'][:255],  # Truncate to 255 chars
                    char_data['image'][:500],  # Truncate to 500 chars
                    char_data['element'][:100],  # Truncate to 100 chars
                    char_data['element_picture'][:500],  # Truncate to 500 chars
                    char_data['tier'][:50],  # Truncate to 50 chars
                    char_data['type'][:50],  # Truncate to 50 chars
                    char_data['created_at'],
                    char_data['updated_at']
                )
                
                cursor.execute(char_query, char_values)
                char_id = cursor.lastrowid
                
                # Insert disk drives
                for disk in char_data['zzz_diskdrive']:
                    disk_query = """
                    INSERT INTO zzz_diskdrives (zzz_char_id, name, detail_2pc, detail_4pc, created_at, updated_at)
                    VALUES (%s, %s, %s, %s, %s, %s)
                    """
                    disk_values = (
                        char_id,
                        disk['name'][:255],  # Truncate to 255 chars
                        disk['detail_2pc'][:255],  # Truncate to 255 chars
                        disk['detail_4pc'][:255],  # Truncate to 255 chars
                        disk['created_at'],
                        disk['updated_at']
                    )
                    cursor.execute(disk_query, disk_values)
                
                # Insert W-engines
                for wengine in char_data['zzz_wengine']:
                    wengine_query = """
                    INSERT INTO zzz_wengines (zzz_char_id, build_name, build_s, w_engine_picture, detail, rarity, created_at, updated_at)
                    VALUES (%s, %s, %s, %s, %s, %s, %s, %s)
                    """
                    wengine_values = (
                        char_id,
                        wengine['build_name'][:255],  # Truncate to 255 chars
                        wengine['build_s'][:255],  # Truncate to 255 chars
                        wengine['w_engine_picture'][:500],  # Truncate to 500 chars
                        wengine['detail'][:255],  # Truncate to 255 chars
                        wengine['rarity'][:10],  # Truncate to 10 chars
                        wengine['created_at'],
                        wengine['updated_at']
                    )
                    cursor.execute(wengine_query, wengine_values)
                
                # Insert best disk drive stats
                for stat in char_data['zzz_bestdiskdrivestat']:
                    stat_query = """
                    INSERT INTO zzz_bestdiskdrivestats (zzz_char_id, disk_number, substats, endgame_stats, created_at, updated_at)
                    VALUES (%s, %s, %s, %s, %s, %s)
                    """
                    stat_values = (
                        char_id,
                        stat['disk_number'][:50],  # Truncate to 50 chars
                        stat['substats'][:255],  # Truncate to 255 chars
                        stat['endgame_stats'][:255],  # Truncate to 255 chars
                        stat['created_at'],
                        stat['updated_at']
                    )
                    cursor.execute(stat_query, stat_values)
                
                characters_saved += 1
                print(f"[DATABASE] Saved character: {char_data['name']} (ID: {char_id})")
            
            # Commit all changes
            self.db_connection.commit()
            cursor.close()
            
            print(f"[DATABASE] Successfully saved {characters_saved} characters to database")
            return True
            
        except mysql.connector.Error as e:
            print(f"[DATABASE] Error saving to database: {repr(str(e))}")
            if self.db_connection:
                self.db_connection.rollback()
            return False

    def scrape_details(self, Page_url):
        soup = BeautifulSoup(requests.get(Page_url).text, 'html.parser')
        detail_data = {
            'W_engine': [],
            'Disk_Drive': [],
            'Best_Disk_Drive_Stats': []
        }

        build = soup.find('div', class_='build-tips')

        if not build:
            return detail_data
        
        build_items = build.find_all('div', class_='zzz-engine profile accordion')
        disk_drive_tag = build.find_all('div', class_='zzz-weapon-accordion accordion')

        # Get all information with-padding divs in the build section
        all_details = build.find_all('div', class_='information with-padding')
        
        # Filter to get only clean details (without inner divs)
        clean_details = []
        for detail in all_details:
            inner_divs = detail.find_all('div', recursive=True)
            if not inner_divs:
                clean_details.append(detail)
        
        print(f"[DETAILS] Found {len(clean_details)} clean details for {len(build_items)} build items")

        # Match build items with clean details
        for i, build_item in enumerate(build_items):
            w_engine = build_item.find('span', class_=lambda c: c and c.startswith('zzz-set-name'))
            w_engine_pict_tag = build_item.find('div', class_=lambda c: c and c.startswith('zzz-icon rarity'))
            build_text = w_engine.text.strip() if w_engine else ""
            build_s = build_item.find('span', class_='cone-super')
            w_engine_pict = None
            w_engine_pict_src = None
            
            # Extract rarity from w_engine class
            rarity = "Unknown"
            if w_engine:
                class_list = w_engine.get('class', [])
                for class_name in class_list:
                    if class_name.startswith('zzz-set-name-rarity-'):
                        rarity = class_name.split('-')[-1]  # Gets the last part after the last dash
                        break

            # Use clean detail if available
            clean_detail = clean_details[i] if i < len(clean_details) else None
            
            if not clean_detail:
                continue

            # Check data W_engine
            if w_engine:
                if build_s:
                    if w_engine_pict_tag:
                        w_engine_pict = w_engine_pict_tag.find('img', src=lambda x: x and x.endswith('.webp'))
                        if w_engine_pict and w_engine_pict.has_attr('src'):
                            w_engine_pict_src = w_engine_pict['src']        
                        build_s_text = build_s.text.strip()                               
                        if w_engine_pict_src:
                            # Extract text from clean detail element
                            detail_text = clean_detail.get_text(strip=True)
                            detail_text = ' '.join(detail_text.split())  # Clean whitespace
                            build_entry = {
                                "Build": build_text,
                                "Build S": build_s_text,
                                "W Engine Pict": self.base_url + w_engine_pict_src if w_engine_pict_src.startswith('/') else w_engine_pict_src,
                                "detail": detail_text,
                                "rarity": rarity
                            }
                            detail_data['W_engine'].append(build_entry)
                        else:
                            w_engine_pict_backup = w_engine_pict_tag.find('picture') if w_engine_pict_tag else None
                            w_engine_pict_src_backup = w_engine_pict_backup.find('img') if w_engine_pict_backup else None
                            if w_engine_pict_src_backup and w_engine_pict_src_backup.has_attr('data-src'):
                                w_engine_pict_src = w_engine_pict_src_backup.get('data-src')
                                # Extract text from clean detail element
                                detail_text = clean_detail.get_text(strip=True)
                                detail_text = ' '.join(detail_text.split())  # Clean whitespace
                                build_entry = {
                                    "Build": build_text,
                                    "Build S": build_s_text,
                                    "W Engine Pict": self.base_url + w_engine_pict_src if w_engine_pict_src.startswith('/') else w_engine_pict_src,
                                    "detail": detail_text,
                                    "rarity": rarity
                                }
                                detail_data['W_engine'].append(build_entry)

        # Check data Disk Drive
        for disk_drive in disk_drive_tag:
            disk_drive_name_tag = disk_drive.find('span', class_='zzz-weapon-name rarity-S')
            disk_drive_name = disk_drive_name_tag.text.strip() if disk_drive_name_tag else "Unknown"

            descriptions = disk_drive.find_all('div', class_='description')
            sets = disk_drive.find_all('span', class_='set')

            detail_2pc = ""
            detail_4pc = ""

            for s, desc in zip(sets, descriptions):
                set_text = s.text.strip()
                desc_text = desc.get_text(separator=" ", strip=True)
                
                if set_text == "(2)":
                    detail_2pc = desc_text
                elif set_text == "(4)":
                    detail_4pc = desc_text

            disk_drive_data = {
                "Disk Drive Name": disk_drive_name,
                "Disk Drive Detail 2pc": detail_2pc,
                "Disk Drive Detail 4pc": detail_4pc
            }

            detail_data['Disk_Drive'].append(disk_drive_data)

        #Check Data Best Disk Drives Stats
        Best_Device_Stats = soup.find('div', class_='main-stats')
        if Best_Device_Stats:
            for stat in Best_Device_Stats:
                Disk_No = stat.find('div', class_='stats-inside').text if stat.find('div', class_='stats-inside') else ""
                Disk_desc = stat.find('div', class_='list-stats').text.strip() if stat.find('div', class_='list-stats') else ""
                best_disk_drive_data = {
                    "Disk No": Disk_No,
                    "Disk Desc": Disk_desc
                }
                detail_data['Best_Disk_Drive_Stats'].append(best_disk_drive_data)

        substat_tags = soup.find('div', class_='box sub-stats')
        if substat_tags:
            detail_data['Best_Disk_Drive_Stats'].append({"Substats": substat_tags.text.strip()})

        End_game_stats = soup.find('div', class_='endgame-stats')
        if End_game_stats:
            pass

        with open('detail Characters.json', 'w', encoding='utf-8') as f:
            json.dump(detail_data, f, ensure_ascii=False, indent=4)
        return detail_data

if __name__ == "__main__":
    api = API()
    try:
        api.scrape_characters()
    except KeyboardInterrupt:
        print("\n[INTERRUPTED] Scraping interrupted by user")
    except Exception as e:
        # Use repr to safely handle unicode characters in error messages
        print(f"\n[ERROR] An error occurred: {repr(str(e))}")
    finally:
        # Always close database connection
        api.close_database_connection()
        print("[COMPLETED] Script finished.")
