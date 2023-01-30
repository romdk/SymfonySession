// -------------------------------------------------------MENU BURGER-------------------------------------------
const btnBurger = document.getElementById('btnBurger');
const nav = document.getElementById('nav');
const span1 = document.getElementById('burgerSpan1');
const span2 = document.getElementById('burgerSpan2');
const span3 = document.getElementById('burgerSpan3');
const overlay = document.getElementById('overlay');
const forms = document.querySelectorAll('.form');
let btn = 'null';

btnBurger.addEventListener('click',() => {
    if (btn !== 'active') {
        btn = 'active'
        btnBurger.style.transform = "translateX(5px)";
        nav.style.transform = "translateX(200px)";
        span1.style.backgroundColor = "white";
        span1.style.width = "20px";
        span1.style.transform = "rotate(45deg) translateY(10px)"
        span2.style.transform = "scaleX(0)"
        span3.style.backgroundColor = "white";
        span3.style.width = "20px";
        span3.style.transform = "rotate(-45deg) translateY(-10px)"
        overlay.style.display = "flex";
        forms.forEach((form) => {
            form.style.display = "none";            
        });
    }else {
        btn = 'null'
        nav.style.transform = "translateX(0px)";
        btnBurger.style.transform = "translateX(0px)";
        span1.style.backgroundColor = "#1c1c1c";
        span1.style.width = "30px";
        span1.style.transform = "rotate(0deg) translateY(0px)"
        span2.style.backgroundColor = "#1c1c1c";
        span2.style.transform = "scaleX(1)";
        span3.style.backgroundColor = "#1c1c1c";
        span3.style.width = "30px";
        span3.style.transform = "rotate(0deg) translateY(0px)"
        overlay.style.display = "none";
        forms.forEach((form) => {
            form.style.display = "flex";        
        });
    }
});

// -------------------------------------------------------DARKMODE-----------------------------------------------
const toggleBtn = document.getElementById('toggleBtn');
const toggleDot = document.getElementById('toggleDot');
// localStorage.setItem("mode", "light");
console.log(localStorage.getItem('mode'));

toggleBtn.addEventListener('click',() => {
    if (localStorage.getItem("mode") != "dark") {
        localStorage.setItem("mode", "dark");
        toggleDot.style.transform = "translateX(36px)";
        toggleBtn.style.backgroundColor = "var(--clr-btn1)";
        document.body.classList.add("darkmode");
    }else if (localStorage.getItem("mode") == "dark") {
        localStorage.setItem("mode", "light");
        toggleDot.style.transform = "translateX(0px)";
        toggleBtn.style.backgroundColor = "#434343";
        document.body.classList.remove("darkmode");
    }
    console.log(localStorage.getItem('mode'));
});
if (localStorage.getItem("mode") == "dark") {
        toggleDot.style.transform = "translateX(36px)";
        toggleBtn.style.backgroundColor = "var(--clr-btn1)";
        document.body.classList.add("darkmode");
    }else if(localStorage.getItem("mode") == "light"){
        toggleDot.style.transform = "translateX(0px)";
        toggleBtn.style.backgroundColor = "#434343";
        document.body.classList.remove("darkmode");
    }
// -------------------------------------------------------AFFICHER FORMULAIRE------------------------------------
const btnAjout = document.getElementById('btnAjout');
const btnFermer = document.getElementById('btnFermer');

btnAjout.addEventListener('click', () => {
 overlay.style.display = 'flex';
 btnBurger.style.display = "none"
});

btnFermer.addEventListener('click', () => {
    overlay.style.display = 'none';
    btnBurger.style.display = "flex"
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