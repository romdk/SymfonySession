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