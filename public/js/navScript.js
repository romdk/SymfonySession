// ------------------------------------- Nav Menu -----------------------------
const btnFormations = document.getElementById('btnFormations')
const btnSessions = document.getElementById('btnSessions')
const btnModules = document.getElementById('btnModules')
const btnReferents = document.getElementById('btnReferents')
const btnStagiaires = document.getElementById('btnStagiaires')

btnFormations.addEventListener('click', () => {
    btnFormations.classList.add('btnActive')
    btnSessions.classList.remove('btnActive')
    btnModules.classList.remove('btnActive')
    btnReferents.classList.remove('btnActive')
    btnStagiaires.classList.remove('btnActive')
})

btnSessions.addEventListener('click', () => {
    btnFormations.classList.remove('btnActive')
    btnSessions.classList.add('btnActive')
    btnModules.classList.remove('btnActive')
    btnReferents.classList.remove('btnActive')
    btnStagiaires.classList.remove('btnActive')
})

btnModules.addEventListener('click', () => {
    btnFormations.classList.remove('btnActive')
    btnSessions.classList.remove('btnActive')
    btnModules.classList.add('btnActive')
    btnReferents.classList.remove('btnActive')
    btnStagiaires.classList.remove('btnActive')
})

btnReferents.addEventListener('click', () => {
    btnFormations.classList.remove('btnActive')
    btnSessions.classList.remove('btnActive')
    btnModules.classList.remove('btnActive')
    btnReferents.classList.add('btnActive')
    btnStagiaires.classList.remove('btnActive')
})

btnStagiaires.addEventListener('click', () => {
    btnFormations.classList.remove('btnActive')
    btnSessions.classList.remove('btnActive')
    btnModules.classList.remove('btnActive')
    btnReferents.classList.remove('btnActive')
    btnStagiaires.classList.add('btnActive')
})

btnProfil.addEventListener('click', () => {
    btnFormations.classList.remove('btnActive')
    btnSessions.classList.remove('btnActive')
    btnModules.classList.remove('btnActive')
    btnReferents.classList.remove('btnActive')
    btnStagiaires.classList.remove('btnActive')
})