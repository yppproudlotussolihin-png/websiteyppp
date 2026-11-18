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


/* ==========================================================================
   3. BAGIAN HERO SECTION (SLIDESHOW GAMBAR BACKGROUND)
   ========================================================================== */

const hero = document.querySelector(".hero");
if (hero) {
    // Daftar gambar background yang akan diganti secara bergantian
    const backgrounds = [
        "assets/images/hero1.jpeg",
        "assets/images/hero2.jpeg",
        "assets/images/hero3.jpeg",
        "assets/images/hero4.jpeg",
        "assets/images/hero5.jpeg" 
    ];
    
    let current = 0;

    // Mengganti background secara otomatis setiap 2 detik (2000 milidetik)
    setInterval(() => {
        current++;
        // Jika sudah mencapai gambar terakhir, kembali ke gambar pertama
        if (current >= backgrounds.length) {
            current = 0;
        }
        hero.style.backgroundImage = `url('${backgrounds[current]}')`;
    }, 2000);
}


/* ==========================================================================
   4. BAGIAN ANIMASI SCROLL (UNTUK KARTU VISI MISI)
   ========================================================================== */

const cards = document.querySelectorAll('.card');

// Menggunakan Intersection Observer untuk mendeteksi kapan elemen muncul di layar
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            // Menambahkan class 'show' untuk memicu animasi yang ada di file CSS
            entry.target.classList.add('show');
        }
    });
}, {
    threshold: 0.3 // Animasi berjalan saat minimal 30% dari kartu sudah terlihat di layar
});

// Menerapkan fitur observer di atas pada semua elemen dengan class .card
cards.forEach(card => {
    observer.observe(card);
});




AOS.init({
    duration:1000,
    once:true
});