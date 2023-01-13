// ------------------------------------- Nav Menu -----------------------------
const btnFormations = document.getElementById('btnFormations')
const btnSessions = document.getElementById('btnSessions')
const btnReferents = document.getElementById('btnReferents')
const btnStagiaires = document.getElementById('btnStagiaires')
const btnProfil = document.getElementById('btnProfil')

btnFormations.addEventListener('click', () => {
    btnFormations.classList.add('btnActive')
    btnSessions.classList.remove('btnActive')
    btnReferents.classList.remove('btnActive')
    btnStagiaires.classList.remove('btnActive')
    btnProfil.classList.remove('btnActive')
})

btnSessions.addEventListener('click', () => {
    btnFormations.classList.remove('btnActive')
    btnSessions.classList.add('btnActive')
    btnReferents.classList.remove('btnActive')
    btnStagiaires.classList.remove('btnActive')
    btnProfil.classList.remove('btnActive')
})

btnReferents.addEventListener('click', () => {
    btnFormations.classList.remove('btnActive')
    btnSessions.classList.remove('btnActive')
    btnReferents.classList.add('btnActive')
    btnStagiaires.classList.remove('btnActive')
    btnProfil.classList.remove('btnActive')
})

btnStagiaires.addEventListener('click', () => {
    btnFormations.classList.remove('btnActive')
    btnSessions.classList.remove('btnActive')
    btnReferents.classList.remove('btnActive')
    btnStagiaires.classList.add('btnActive')
    btnProfil.classList.remove('btnActive')
})

btnProfil.addEventListener('click', () => {
    btnFormations.classList.remove('btnActive')
    btnSessions.classList.remove('btnActive')
    btnReferents.classList.remove('btnActive')
    btnStagiaires.classList.remove('btnActive')
    btnProfil.classList.add('btnActive')
})