# Zee-Web 🚀

<p align="center">
  <img src="public/image/web_icon.png" alt="Zee-Web Logo" width="80" height="80">
</p>

<p align="center">
  <strong>Laravel Portfolio Website with Web Scraping Features</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-red.svg" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue.svg" alt="PHP Version">
  <img src="https://img.shields.io/badge/Tailwind-3.4+-green.svg" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/License-MIT-brightgreen.svg" alt="License">
</p>

## ✨ Features

- 🎨 **Portfolio Showcase** - Interactive portfolio with modern design
- 🔐 **User Authentication** - Login, register, and session management
- 📊 **Dashboard** - Monitor activities and manage data
- 🕷️ **Web Scraping** - Integrated ZeeScraper for data collection
- 🎭 **Modern UI** - Futuristic design with animations and glass effects

## 🛠️ Tech Stack

**Backend:** Laravel 12.x, PHP 8.2+  
**Frontend:** Blade, Tailwind CSS, Vite  
**Database:** MySQL/SQLite

## 🚀 Quick Setup

1. **Clone & Install**
   ```bash
   git clone https://github.com/BrianYudhistira/Zee-Web.git
   cd Zee-Web
   composer install
   npm install
   ```

2. **Configure**
   ```bash
   cp .env.example .env
   php artisan key:generate
   php artisan migrate
   ```

3. **Run**
   ```bash
   php artisan serve
   npm run dev
   ```

Visit `http://localhost:8000`

## � Structure

```
├── app/Http/Controllers/     # Controllers
├── app/Models/              # Models
├── resources/views/         # Blade Templates
├── resources/css/           # Stylesheets
└── routes/web.php          # Routes
```

## 🤝 Contributing

1. Fork the repository
2. Create feature branch (`git checkout -b feature/new-feature`)
3. Commit changes (`git commit -m 'Add new feature'`)
4. Push to branch (`git push origin feature/new-feature`)
5. Create Pull Request

## 📝 License

MIT License

---

<p align="center">Made with ❤️ using Laravel & Tailwind CSS</p>
