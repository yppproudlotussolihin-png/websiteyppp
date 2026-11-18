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
    BAGIAN LOADER LOADING
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

    "assets/images/hero1.jpeg",

    "assets/images/hero2.jpeg",

    "assets/images/hero3.jpeg",

    "assets/images/hero4.jpeg",

    "assets/images/hero5.jpeg"

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









/* ==========================
   AOS ANIMATION
========================== */

AOS.init({
    duration:1000,
    once:true
});


