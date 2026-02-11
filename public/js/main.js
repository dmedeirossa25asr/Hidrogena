const langSelector = document.querySelector('.lang-selector');
langSelector.addEventListener('click', (e) => {
  e.stopPropagation();
  langSelector.classList.toggle('open');
});

document.addEventListener('click', () => {
  langSelector.classList.remove('open');
});