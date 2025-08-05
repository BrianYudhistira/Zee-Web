document.getElementById('mobile-menu-btn').addEventListener('click', function () {
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenu.classList.toggle('hidden');
  });

document.getElementById('login-btn').addEventListener('click', function () {
    window.location.href = '/menu';
  });
