window.addEventListener('DOMContentLoaded', () => {

    // ==========================================
    // 1. LOGIKA POP-UP AWAL (INFINITE SLIDER)
    // ==========================================
    const popup = document.getElementById('infoPopup');
    const closeBtn = document.getElementById('closePopup');

    // Munculkan Pop-up
    setTimeout(() => { popup.classList.add('active'); }, 500);
    closeBtn.addEventListener('click', () => { popup.classList.remove('active'); });
    popup.addEventListener('click', (e) => { if (e.target === popup) popup.classList.remove('active'); });

    const popupSlides = document.getElementById('popupSlides');
    const originalPopupImages = popupSlides.querySelectorAll('img');
    const totalPopup = originalPopupImages.length;
    const popupPrev = document.getElementById('popupPrev');
    const popupNext = document.getElementById('popupNext');
    const popupDotsContainer = document.getElementById('popupDots');

    // Kloning gambar Pop-up agar nyambung terus (Infinite Loop)
    const pClonesBefore = [];
    const pClonesAfter = [];
    originalPopupImages.forEach(img => {
        pClonesBefore.push(img.cloneNode(true));
        pClonesAfter.push(img.cloneNode(true));
    });
    // Tambahkan kloningan ke dalam HTML secara otomatis
    pClonesAfter.forEach(clone => popupSlides.appendChild(clone));
    pClonesBefore.reverse().forEach(clone => popupSlides.insertBefore(clone, popupSlides.firstChild));

    let popupIdx = totalPopup; // Mulai dari gambar asli pertama
    let popupInterval;

    // Buat Titik Navigasi Pop-up
    originalPopupImages.forEach((_, i) => {
        const dot = document.createElement('div');
        dot.classList.add('dot');
        if (i === 0) dot.classList.add('active');
        dot.addEventListener('click', () => { goToPopupSlide(i); });
        popupDotsContainer.appendChild(dot);
    });
    const popupDots = popupDotsContainer.querySelectorAll('.dot');

    // Posisi Awal Tanpa Animasi
    popupSlides.style.transition = 'none';
    popupSlides.style.transform = `translateX(-${popupIdx * 100}%)`;

    function updatePopupSlider() {
        popupSlides.style.transition = 'transform 0.5s ease-in-out';
        popupSlides.style.transform = `translateX(-${popupIdx * 100}%)`;

        const activeDot = (popupIdx - totalPopup + totalPopup * 10) % totalPopup;
        popupDots.forEach(dot => dot.classList.remove('active'));
        if (popupDots[activeDot]) popupDots[activeDot].classList.add('active');
    }

    // Trik "Nyambung Terus": Pindah posisi secara diam-diam saat transisi selesai
    popupSlides.addEventListener('transitionend', () => {
        if (popupIdx >= totalPopup * 2) {
            popupSlides.style.transition = 'none';
            popupIdx -= totalPopup;
            popupSlides.style.transform = `translateX(-${popupIdx * 100}%)`;
        } else if (popupIdx < totalPopup) {
            popupSlides.style.transition = 'none';
            popupIdx += totalPopup;
            popupSlides.style.transform = `translateX(-${popupIdx * 100}%)`;
        }
    });

    function nextPopupSlide() { popupIdx++; updatePopupSlider(); }
    function prevPopupSlide() { popupIdx--; updatePopupSlider(); }

    function goToPopupSlide(index) {
        popupIdx = totalPopup + index;
        updatePopupSlider();
        resetPopupInterval();
    }

    function resetPopupInterval() {
        clearInterval(popupInterval);
        popupInterval = setInterval(() => { nextPopupSlide(); }, 4000);
    }

    popupNext.addEventListener('click', () => { nextPopupSlide(); resetPopupInterval(); });
    popupPrev.addEventListener('click', () => { prevPopupSlide(); resetPopupInterval(); });
    resetPopupInterval(); // Jalankan otomatis


    // ==========================================
    // 2. LOGIKA BERITA SLIDER (INFINITE LOOP & TOUCH)
    // ==========================================
    const beritaContainer = document.getElementById('beritaContainer');
    const beritaTrack = document.getElementById('beritaTrack');
    const originalBeritaCards = document.querySelectorAll('.berita-card');
    const totalBerita = originalBeritaCards.length;
    const beritaPrev = document.getElementById('beritaPrev');
    const beritaNext = document.getElementById('beritaNext');
    const beritaDotsContainer = document.getElementById('beritaDots');

    const cardWidth = 320 + 25; // 320px (lebar card) + 25px (gap)

    // Kloning Berita agar nyambung terus tanpa batas kosong
    const bClonesBefore = [];
    const bClonesAfter = [];
    originalBeritaCards.forEach(card => {
        bClonesBefore.push(card.cloneNode(true));
        bClonesAfter.push(card.cloneNode(true));
    });
    
    // Masukkan kloningan ke depan dan belakang track
    bClonesAfter.forEach(clone => beritaTrack.appendChild(clone));
    bClonesBefore.reverse().forEach(clone => beritaTrack.insertBefore(clone, beritaTrack.firstChild));

    let beritaIdx = totalBerita; // Mulai dari card asli pertama
    let beritaInterval;

    // Buat Titik Navigasi Berita
    originalBeritaCards.forEach((_, i) => {
        const dot = document.createElement('div');
        dot.classList.add('dot');
        if (i === 0) dot.classList.add('active');
        dot.addEventListener('click', () => { goToBeritaSlide(i); });
        beritaDotsContainer.appendChild(dot);
    });
    const beritaDots = beritaDotsContainer.querySelectorAll('.dot');

    // Posisi awal berita tanpa animasi
    beritaTrack.style.transition = 'none';
    beritaTrack.style.transform = `translateX(-${beritaIdx * cardWidth}px)`;

    function updateBeritaSlider() {
        beritaTrack.style.transition = 'transform 0.5s ease-in-out';
        beritaTrack.style.transform = `translateX(-${beritaIdx * cardWidth}px)`;

        const activeDot = (beritaIdx - totalBerita + totalBerita * 10) % totalBerita;
        beritaDots.forEach(dot => dot.classList.remove('active'));
        if (beritaDots[activeDot]) beritaDots[activeDot].classList.add('active');
    }

    // Trik "Nyambung Terus": Menggulung balik secara instan & tak terlihat saat di ujung
    beritaTrack.addEventListener('transitionend', () => {
        if (beritaIdx >= totalBerita * 2) {
            beritaTrack.style.transition = 'none'; // Matikan animasi
            beritaIdx -= totalBerita; // Kembali ke index asli
            beritaTrack.style.transform = `translateX(-${beritaIdx * cardWidth}px)`;
        } else if (beritaIdx < totalBerita) {
            beritaTrack.style.transition = 'none';
            beritaIdx += totalBerita;
            beritaTrack.style.transform = `translateX(-${beritaIdx * cardWidth}px)`;
        }
    });

    function nextBeritaSlide() { beritaIdx++; updateBeritaSlider(); }
    function prevBeritaSlide() { beritaIdx--; updateBeritaSlider(); }

    function goToBeritaSlide(index) {
        beritaIdx = totalBerita + index;
        updateBeritaSlider();
        resetBeritaInterval();
    }

    function resetBeritaInterval() {
        clearInterval(beritaInterval);
        beritaInterval = setInterval(() => { nextBeritaSlide(); }, 4000); // Geser tiap 4 detik
    }

    // Navigasi Panah Berita
    beritaNext.addEventListener('click', () => { nextBeritaSlide(); resetBeritaInterval(); });
    beritaPrev.addEventListener('click', () => { prevBeritaSlide(); resetBeritaInterval(); });
    
    resetBeritaInterval();

    // Hentikan geser otomatis jika kursor berada di area berita
    beritaContainer.addEventListener('mouseenter', () => clearInterval(beritaInterval));
    beritaContainer.addEventListener('mouseleave', resetBeritaInterval);


    // --- Fitur Swipe/Sentuh Layar Manual di HP ---
    let isDragging = false, startPos = 0;

    function getPositionX(event) {
        return event.type.includes('mouse') ? event.pageX : event.touches[0].clientX;
    }

    beritaContainer.addEventListener('touchstart', touchStart, {passive: true});
    beritaContainer.addEventListener('touchend', touchEnd);
    beritaContainer.addEventListener('touchmove', touchMove, {passive: true});
    beritaContainer.addEventListener('mousedown', touchStart);
    beritaContainer.addEventListener('mouseup', touchEnd);
    beritaContainer.addEventListener('mouseleave', (e) => { if (isDragging) touchEnd(e); });
    beritaContainer.addEventListener('mousemove', touchMove);

    function touchStart(event) {
        isDragging = true;
        startPos = getPositionX(event);
        clearInterval(beritaInterval);
        beritaTrack.style.transition = 'none'; // Bergerak real-time mengikuti jari
    }

    function touchMove(event) {
        if (!isDragging) return;
        const diff = getPositionX(event) - startPos;
        beritaTrack.style.transform = `translateX(${-beritaIdx * cardWidth + diff}px)`;
    }

    function touchEnd(event) {
        if (!isDragging) return;
        isDragging = false;
        const diff = getPositionX(event) - startPos;

        // Sensitivitas geseran minimal 50px
        if (diff < -50) {
            beritaIdx++; // Geser ke kiri (Next)
        } else if (diff > 50) {
            beritaIdx--; // Geser ke kanan (Prev)
        }

        updateBeritaSlider();
        resetBeritaInterval(); // Nyalakan kembali auto-gesernya
    }
});