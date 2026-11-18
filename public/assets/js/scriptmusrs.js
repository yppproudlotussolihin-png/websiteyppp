const hamburger = document.querySelector(".hamburger");
const menu = document.querySelector(".menu");

/* =========================
   HAMBURGER MENU
========================= */

hamburger.addEventListener("click", () => {

    hamburger.classList.toggle("active");
    menu.classList.toggle("active");

});

/* =========================
   DROPDOWN MOBILE
========================= */

document.querySelectorAll(".dropdown > a").forEach(item => {

    item.addEventListener("click", function(e){

        if(window.innerWidth <= 992){

            e.preventDefault();

            this.parentElement.classList.toggle("active");

        }

    });

});

document.querySelectorAll(".dropdown-sub > a").forEach(item => {

    item.addEventListener("click", function(e){

        if(window.innerWidth <= 992){

            e.preventDefault();

            this.parentElement.classList.toggle("active");

        }

    });

});



/* ==========================================================================
   2. BAGIAN LOADER LOADING
   ========================================================================== */

// Menghilangkan Loader secara halus saat seluruh halaman selesai dimuat
window.addEventListener("load", () => {
    const loader = document.getElementById("loader");
    if (loader) {
        setTimeout(() => {
            loader.style.opacity = "0";
            loader.style.visibility = "hidden";
        }, 1000); // Loader akan menghilang setelah 1 detik
    }
});

// Menampilkan Loader kembali saat link navigasi diklik (saat akan pindah halaman)
const links = document.querySelectorAll('.nav-link');
links.forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault(); // Mencegah perpindahan halaman instan
        const loader = document.getElementById('loader');
        
        if (loader) {
            loader.style.opacity = '1';
            loader.style.visibility = 'visible';
        }

        // Pindah ke halaman tujuan setelah loader muncul selama 0.5 detik
        setTimeout(() => {
            window.location.href = this.href;
        }, 500);
    });
});

// (Opsional) Mengambil komponen loader dari file eksternal (jika kamu menggunakan sistem komponen)
const loaderPlaceholder = document.getElementById('loader-placeholder');
if (loaderPlaceholder) {
    fetch('../components/loader.html')
        .then(response => response.text())
        .then(data => {
            loaderPlaceholder.innerHTML = data;
        });
}


/* ==========================
   HERO SLIDER
========================== */

const hero = document.querySelector(".hero");

const backgrounds = [

        "../../images/hero1.jpeg",
        "../../images/hero2.jpeg",
        "../../images/hero3.jpeg",
        "../../images/hero4.jpeg",
        "../../images/hero5.jpeg" 

];

let current = 0;

setInterval(() => {

    current++;

    if(current >= backgrounds.length){

        current = 0;

    }

    hero.style.backgroundImage =
    `url(${backgrounds[current]})`;

}, 2000);


/* ==========================================
   Vision & Mission Slider
========================================== */

const visionTrack = document.querySelector(".vision-track");

const switchIndicator = document.querySelector(".switch-indicator");

const switchButtons = document.querySelectorAll(".switch-btn");

switchButtons.forEach((button,index)=>{

    button.addEventListener("click",()=>{

        switchButtons.forEach(btn=>btn.classList.remove("active"));

        button.classList.add("active");

        switchIndicator.style.transform=`translateX(${index*100}%)`;

        visionTrack.style.transform=`translateX(-${index*100}%)`;

    });

});




/* =======================================================
   SCROLL ANIMATION
======================================================= */

const reveals = document.querySelectorAll(".reveal");

const observer = new IntersectionObserver((entries)=>{

entries.forEach(entry=>{

if(entry.isIntersecting){

entry.target.classList.add("active");

}else{

entry.target.classList.remove("active");

}

});

},

{

threshold:.15

});

reveals.forEach(item=>{

observer.observe(item);

});




/* =======================================================
   COUNTER ANIMATION
======================================================= */

const counters = document.querySelectorAll(".counter");

const counterObserver = new IntersectionObserver((entries)=>{

entries.forEach(entry=>{

if(entry.isIntersecting){

const counter = entry.target;

const target = +counter.dataset.target;

let current = 0;

const increment = target / 120;

const updateCounter = ()=>{

if(current < target){

current += increment;

counter.innerText = Math.ceil(current).toLocaleString("id-ID");

requestAnimationFrame(updateCounter);

}else{

counter.innerText = target.toLocaleString("id-ID")+"+";

}

};

updateCounter();

counterObserver.unobserve(counter);

}

});

},

{

threshold:.5

});

counters.forEach(counter=>{

counterObserver.observe(counter);

});