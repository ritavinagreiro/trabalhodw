// Seleciona o botão e o menu
const btn = document.getElementById('menu-btn');
const menu = document.getElementById('menu-dropdown');

// Alterna a visibilidade do menu ao clicar
btn.addEventListener('click', () => {
  menu.classList.toggle('hidden');
});
