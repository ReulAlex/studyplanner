// actualizează anul afișat în footer
  (function(){ var y=document.getElementById('year'); if(y) y.textContent=new Date().getFullYear(); })();

// Funcție pentru afișare/ascundere parolă
function togglePassword(inputId, iconElem) {
    const input = document.getElementById(inputId);
    if (!input) return;
    if (input.type === "password") {
        input.type = "text";
        iconElem.textContent = "🙈";
    } else {
        input.type = "password";
        iconElem.textContent = "👁️";
    }
}
// Funcționalitate pentru meniul hamburger
document.addEventListener('DOMContentLoaded', () => {
  const burgerBtn = document.querySelector('.js-menu-toggle-btn');
  const nav = document.querySelector('.nav');
  const closeBtn = document.querySelector('.nav-close-btn');

  const toggleMobileMenu = () => {
    burgerBtn.classList.toggle('hamburger-menu--active');
    if (nav) {
      nav.classList.toggle('nav--mobile-open');
    }
  };
  if (burgerBtn) {
    burgerBtn.addEventListener('click', toggleMobileMenu);
  }
  if (closeBtn) {
    closeBtn.addEventListener('click', () => {
      burgerBtn.classList.remove('hamburger-menu--active');
      nav.classList.remove('nav--mobile-open');
    });
  }

  // Închide meniul la click pe link din nav (mobil)
  if (nav) {
    nav.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        burgerBtn.classList.remove('hamburger-menu--active');
        nav.classList.remove('nav--mobile-open');
      });
    });
  }
});