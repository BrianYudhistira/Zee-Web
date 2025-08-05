# Zee-Web 🚀

<p align="center">
  <img src="public/image/web_icon.png" alt="Zee-Web Logo" width="80" height="80">
</p>

<p align="center">
  <strong>Modern Web Portal with Portfolio & Web Scraping Features</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-red.svg" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue.svg" alt="PHP Version">
  <img src="https://img.shields.io/badge/Tailwind-3.4+-green.svg" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Vite-7.0+-yellow.svg" alt="Vite">
  <img src="https://img.shields.io/badge/License-MIT-brightgreen.svg" alt="License">
</p>

## 📖 Tentang Project

**Zee-Web** adalah aplikasi web portal modern berbasis Laravel yang menyediakan platform digital dengan desain futuristik dan animasi menarik. Project ini menggabungkan fitur portfolio interaktif, dashboard monitoring, sistem autentikasi user, dan integrasi web scraping (ZeeScraper) dalam satu platform yang elegan.

### ✨ Fitur Utama

- 🎨 **Portfolio Interaktif** - Showcase karya dan project dengan desain modern
- 🔐 **Sistem Autentikasi** - Registrasi, login, dan manajemen sesi user
- 📊 **Dashboard Monitoring** - Pantau aktivitas scraping dan kelola data
- 🕷️ **ZeeScraper Integration** - Fitur web scraping terintegrasi untuk pengumpulan data
- 🎭 **UI/UX Modern** - Desain futuristik dengan animasi stars, glass effect, dan gradient
- 📱 **Responsive Design** - Tampilan optimal di semua perangkat
- ⚡ **Performance Optimized** - Menggunakan Vite untuk bundling yang cepat

### 🛠️ Tech Stack

- **Backend:** Laravel 12.x, PHP 8.2+
- **Frontend:** Blade Templates, Tailwind CSS 3.4+
- **Build Tool:** Vite 7.0+
- **Database:** MySQL/SQLite (configurable)
- **Icons:** Remix Icons, Devicons

## 🚀 Quick Start

### Prasyarat

- PHP 8.2 atau lebih tinggi
- Composer
- Node.js & npm
- MySQL/SQLite

### Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/yourusername/Zee-Web.git
   cd Zee-Web
   ```

2. **Install dependencies**
   ```bash
   # Install PHP dependencies
   composer install
   
   # Install Node.js dependencies
   npm install
   ```

3. **Environment setup**
   ```bash
   # Copy environment file
   cp .env.example .env
   
   # Generate application key
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   # Jalankan migrasi
   php artisan migrate
   
   # (Optional) Seed database
   php artisan db:seed
   ```

5. **Development server**
   ```bash
   # Terminal 1 - Laravel server
   php artisan serve
   
   # Terminal 2 - Vite dev server
   npm run dev
   ```

6. **Akses aplikasi**
   
   Buka browser dan kunjungi `http://localhost:8000`

## 📂 Struktur Project

```
Zee-Web/
├── app/
│   ├── Http/Controllers/     # Controllers
│   ├── Models/              # Eloquent Models
│   └── Middleware/          # Custom Middleware
├── database/
│   ├── migrations/          # Database Migrations
│   └── seeders/            # Database Seeders
├── public/
│   └── image/              # Static Images
├── resources/
│   ├── css/                # Stylesheets
│   ├── js/                 # JavaScript Files
│   └── views/              # Blade Templates
└── routes/
    └── web.php             # Web Routes
```

## 🎯 Fitur Detail

### 🏠 Landing Page (Menu)
- Desain futuristik dengan animasi bintang dan partikel
- Glass effect navigation
- Smooth hover animations
- Responsive design

### 👤 Autentikasi
- User registration dengan validasi
- Secure login system
- Session management
- Password hashing

### 💼 Portfolio
- Showcase project dan karya
- Interactive UI elements
- Responsive grid layout
- Smooth animations

### 📈 Dashboard
- Monitoring statistik scraping
- Data visualization
- User profile management
- Activity tracking

### 🕷️ ZeeScraper
- Web scraping capabilities
- Data collection tools
- Export functionality
- Scheduled scraping

## 🔧 Konfigurasi

### Database
Edit file `.env` untuk konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=zee_web
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Mail Configuration
Untuk fitur email (jika diperlukan):

```env
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
```

## 🎨 Customization

### Styling
- CSS files berada di `resources/css/`
- Menggunakan Tailwind CSS untuk utility-first styling
- Custom animations dan effects

### Views
- Blade templates di `resources/views/`
- Modular component structure
- Reusable layouts

## 🤝 Contributing

Kontribusi sangat diterima! Untuk berkontribusi:

1. Fork repository ini
2. Buat feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📝 License

Project ini menggunakan [MIT License](LICENSE).

## 👨‍💻 Author

Dibuat dengan ❤️ oleh [Your Name]

## 🙏 Acknowledgments

- Laravel Framework
- Tailwind CSS
- Vite
- Remix Icons
- Devicons

---

<p align="center">
  <strong>⭐ Jangan lupa berikan star jika project ini bermanfaat! ⭐</strong>
</p>
