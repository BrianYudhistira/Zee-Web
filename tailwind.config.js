/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',   // ✅ semua file Blade
    './resources/**/*.js',          // ✅ kalau kamu pakai Tailwind di JS
    './resources/**/*.css',         // ✅ penting! karena kamu pakai file CSS
  ],
  theme: {
    extend: {
      colors: {
        primary: '#4F46E5',
        secondary: '#6a75ff',
        accent: '#FBBF24',
      },
    },
  },
  plugins: [],
}
