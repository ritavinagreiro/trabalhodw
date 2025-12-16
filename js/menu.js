const btn = document.getElementById('menu-btn');
const menu = document.getElementById('menu-dropdown');
btn?.addEventListener('click', () => {
    menu.classList.toggle('hidden');
});

const userBtn = document.getElementById('user-btn');
const dropdown = document.getElementById('dropdown');

if (userBtn && dropdown) {
    userBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', (event) => {
        if (!userBtn.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
}



