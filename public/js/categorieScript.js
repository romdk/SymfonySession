const btnAjout = document.getElementById('btnAjout');
const overlay = document.getElementById('overlay');
const btnFermer = document.getElementById('btnFermer');

btnAjout.addEventListener('click', () => {
 overlay.style.display = 'flex';
});

btnFermer.addEventListener('click', () => {
    overlay.style.display = 'none';
});