// --------------------------------Tableaux Sessions --------------------------------
const currentBtn = document.getElementById('currentBtn')
const upcomingBtn = document.getElementById('upcomingBtn')
const pastBtn = document.getElementById('pastBtn')
const currentSessions = document.getElementById('currentSessions')
const upcomingSessions = document.getElementById('upcomingSessions')
const pastSessions = document.getElementById('pastSessions')

currentBtn.addEventListener('click', () => {
    currentBtn.classList.add('btnActive')
    upcomingBtn.classList.remove('btnActive')
    pastBtn.classList.remove('btnActive')  
    currentSessions.style.display = 'block'  
    upcomingSessions.style.display = 'none'  
    pastSessions.style.display = 'none'  
})

upcomingBtn.addEventListener('click', () => {
    currentBtn.classList.remove('btnActive')
    upcomingBtn.classList.add('btnActive')
    pastBtn.classList.remove('btnActive')
    currentSessions.style.display = 'none'  
    upcomingSessions.style.display = 'block'  
    pastSessions.style.display = 'none'   
})

pastBtn.addEventListener('click', () => {
    currentBtn.classList.remove('btnActive')
    upcomingBtn.classList.remove('btnActive')
    pastBtn.classList.add('btnActive')
    currentSessions.style.display = 'none'  
    upcomingSessions.style.display = 'none'  
    pastSessions.style.display = 'block'     
})


// ------------------------------------Formulaire ajout-------------------------------
const btnAjout = document.getElementById('btnAjout');
const overlay = document.getElementById('overlay');
const btnFermer = document.getElementById('btnFermer');

btnAjout.addEventListener('click', () => {
 overlay.style.display = 'flex';
});

btnFermer.addEventListener('click', () => {
    overlay.style.display = 'none';
});