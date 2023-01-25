// -------------------------------------------------------AFFICHER FORMULAIRE------------------------------------
const btnAjout = document.getElementById('btnAjout');
const overlay = document.getElementById('overlay');
const btnFermer = document.getElementById('btnFermer');

btnAjout.addEventListener('click', () => {
 overlay.style.display = 'flex';
});

btnFermer.addEventListener('click', () => {
    overlay.style.display = 'none';
});




// ---------------------------------------------------SEARCHBAR-----------------------------------------------
function affPersonnes() {
    
    let input = document.getElementById('searchBar');
    let ul = document.getElementById('results');
    let li = ul.getElementsByClassName('result');
    let filter = input.value.toUpperCase();
    
    if(input === document.activeElement){
        ul.style.display = "flex";
        
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            let txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "block";
            }else {
                li[i].style.display = "none";
            }
        }
        if(input.value == ""){
            ul.style.display = 'flex';
        }
    }
}


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
    currentSessions.style.overflowX = 'scroll' 
    upcomingSessions.style.display = 'none'  
    pastSessions.style.display = 'none'  
})

upcomingBtn.addEventListener('click', () => {
    currentBtn.classList.remove('btnActive')
    upcomingBtn.classList.add('btnActive')
    pastBtn.classList.remove('btnActive')
    currentSessions.style.display = 'none'  
    upcomingSessions.style.display = 'block'
    upcomingSessions.style.overflowX = 'scroll' 
    pastSessions.style.display = 'none'   
})

pastBtn.addEventListener('click', () => {
    currentBtn.classList.remove('btnActive')
    upcomingBtn.classList.remove('btnActive')
    pastBtn.classList.add('btnActive')
    currentSessions.style.display = 'none'  
    upcomingSessions.style.display = 'none'  
    pastSessions.style.display = 'block'
    pastSessions.style.overflowX = 'scroll'    
})