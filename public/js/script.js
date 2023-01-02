// ------------------------------------- Nav Menu -----------------------------
const btnFormations = document.getElementById('btnFormations')
const btnSessions = document.getElementById('btnSessions')
const btnStagiaires = document.getElementById('btnStagiaires')
const btnProfil = document.getElementById('btnProfil')

btnFormations.addEventListener('click', () => {
    btnFormations.classList.add('btnActive')
    btnSessions.classList.remove('btnActive')
    btnStagiaires.classList.remove('btnActive')
    btnProfil.classList.remove('btnActive')
})

btnSessions.addEventListener('click', () => {
    btnFormations.classList.remove('btnActive')
    btnSessions.classList.add('btnActive')
    btnStagiaires.classList.remove('btnActive')
    btnProfil.classList.remove('btnActive')
})

btnStagiaires.addEventListener('click', () => {
    btnFormations.classList.remove('btnActive')
    btnSessions.classList.remove('btnActive')
    btnStagiaires.classList.add('btnActive')
    btnProfil.classList.remove('btnActive')
})

btnProfil.addEventListener('click', () => {
    btnFormations.classList.remove('btnActive')
    btnSessions.classList.remove('btnActive')
    btnStagiaires.classList.remove('btnActive')
    btnProfil.classList.add('btnActive')
})

// --------------------------------Tableaux Sessions --------------------------------
const currentBtn = document.getElementById('currentBtn')
const upcomingBtn = document.getElementById('upcomingBtn')
const pastBtn = document.getElementById('pastBtn')
const currentSession = document.getElementById('currentSession')
const upcomingSession = document.getElementById('upcomingSession')
const pastSession = document.getElementById('pastSession')

currentBtn.addEventListener('click', () => {
    currentBtn.classList.add('btnActive')
    upcomingBtn.classList.remove('btnActive')
    pastBtn.classList.remove('btnActive')  
    currentSession.style.display = 'block'  
    upcomingSession.style.display = 'none'  
    pastSession.style.display = 'none'  
})

upcomingBtn.addEventListener('click', () => {
    currentBtn.classList.remove('btnActive')
    upcomingBtn.classList.add('btnActive')
    pastBtn.classList.remove('btnActive')
    currentSession.style.display = 'none'  
    upcomingSession.style.display = 'block'  
    pastSession.style.display = 'none'   
})

pastBtn.addEventListener('click', () => {
    currentBtn.classList.remove('btnActive')
    upcomingBtn.classList.remove('btnActive')
    pastBtn.classList.add('btnActive')
    currentSession.style.display = 'none'  
    upcomingSession.style.display = 'none'  
    pastSession.style.display = 'block'     
})