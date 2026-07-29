/* =====================================================
   HEALTH ANALYTICS HOSPITAL SYSTEM
   DASHBOARD JAVASCRIPT
===================================================== */



document.addEventListener(
"DOMContentLoaded",
function(){



/*
=====================================================
LIVE CLOCK
=====================================================
*/


function updateClock(){


    let clock =
    document.getElementById(
        "liveClock"
    );


    if(clock){


        let now =
        new Date();


        clock.innerHTML =
        now.toLocaleString();


    }


}


setInterval(
    updateClock,
    1000
);

updateClock();








/*
=====================================================
NUMBER COUNTER ANIMATION
=====================================================
*/


let counters =
document.querySelectorAll(
".counter"
);



counters.forEach(
counter => {


    let target =
    parseInt(
        counter.dataset.target
    );



    let count = 0;



    let speed =
    target > 100
    ?
    20
    :
    50;



    let timer =
    setInterval(
    ()=>{


        count += Math.ceil(
            target / 50
        );


        if(count >= target){

            count = target;

            clearInterval(timer);

        }


        counter.innerHTML =
        count;


    },
    speed
    );



});









/*
=====================================================
NOTIFICATION POPUP
=====================================================
*/


window.showNotification =
function(message){


    let box =
    document.createElement(
        "div"
    );


    box.className =
    "hospital-alert";


    box.innerHTML =

    `
    <i class="bi bi-bell-fill"></i>
    ${message}
    `;



    document.body.appendChild(box);



    setTimeout(
    ()=>{


        box.classList.add(
            "show"
        );


    },100);



    setTimeout(
    ()=>{


        box.remove();


    },5000);



    playNotificationSound();



}









/*
=====================================================
NOTIFICATION SOUND
=====================================================
*/


function playNotificationSound(){


    let audio =
    new Audio(
    "https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3"
    );


    audio.volume =
    0.4;


    audio.play()
    .catch(
    ()=>{}
    );


}









/*
=====================================================
GRAPH TOGGLE
=====================================================
*/


let buttons =
document.querySelectorAll(
".chart-toggle"
);



buttons.forEach(
button=>{


button.addEventListener(
"click",
function(){



let target =
document.querySelector(
this.dataset.target
);



if(target.style.display==="none")
{


    target.style.display =
    "block";


    this.innerHTML =
    "Hide Graph";


}

else{


    target.style.display =
    "none";


    this.innerHTML =
    "Show Graph";


}



});



});









/*
=====================================================
CARD CLICK EFFECT
=====================================================
*/


let cards =
document.querySelectorAll(
".analytics-card"
);



cards.forEach(
card=>{


card.addEventListener(
"click",
function(){


this.style.transform =
"scale(0.97)";



setTimeout(
()=>{

this.style.transform =
"";


},
150
);



});


});









/*
=====================================================
AUTO SYSTEM NOTIFICATION DEMO
=====================================================
*/


setTimeout(
()=>{


showNotification(
"New patient registered successfully"
);


},
5000
);






});