window.addEventListener('DOMContentLoaded', () => {

    // ==========================================
    // LOGIKA SLIDER OTOMATIS BERITA SEKOLAH
    // ==========================================
    const container = document.getElementById('beritaContainer');
    const track = document.getElementById('beritaTrack');
    if (!container || !track) return;

    const originalCards = Array.from(track.children);
    const totalCards = originalCards.length;
    const prevBtn = document.getElementById('beritaPrev');
    const nextBtn = document.getElementById('beritaNext');
    const dotsContainer = document.getElementById('beritaDots');

    // Lebar card (350px) + gap CSS (30px)
    const cardWidth = 350 + 30; 

    // Kloning elemen di depan dan belakang untuk infinite loop yang mulus
    const clonesBefore = originalCards.map(card => card.cloneNode(true));
    const clonesAfter = originalCards.map(card => card.cloneNode(true));

    clonesAfter.forEach(clone => track.appendChild(clone));
    clonesBefore.reverse().forEach(clone => track.insertBefore(clone, track.firstChild));

    let currentIndex = totalCards;
    let slideInterval;

    // Membuat titik indikator (dots)
    let dots = [];
    if (dotsContainer) {
        for (let i = 0; i < totalCards; i++) {
            const dot = document.createElement('div');
            dot.classList.add('dot');
            if (i === 0) dot.classList.add('active');
            dot.addEventListener('click', () => { goToSlide(i); });
            dotsContainer.appendChild(dot);
        }
        dots = dotsContainer.querySelectorAll('.dot');
    }

    // Posisi awal tanpa animasi
    track.style.transition = 'none';
    track.style.transform = `translateX(-${currentIndex * cardWidth}px)`;

    function updateSlider() {
        track.style.transition = 'transform 0.5s cubic-bezier(0.25, 1, 0.5, 1)'; // Efek hentakan halus
        track.style.transform = `translateX(-${currentIndex * cardWidth}px)`;

        if (dots.length > 0) {
            const activeDot = (currentIndex - totalCards + totalCards * 10) % totalCards;
            dots.forEach(dot => dot.classList.remove('active'));
            if (dots[activeDot]) dots[activeDot].classList.add('active');
        }
    }

    // Reset posisi secara instan di ujung perputaran agar tidak ada ruang kosong
    track.addEventListener('transitionend', () => {
        if (currentIndex >= totalCards * 2) {
            track.style.transition = 'none';
            currentIndex -= totalCards;
            track.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
        } else if (currentIndex < totalCards) {
            track.style.transition = 'none';
            currentIndex += totalCards;
            track.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
        }
    });

    function nextSlide() { currentIndex++; updateSlider(); }
    function prevSlide() { currentIndex--; updateSlider(); }

    function goToSlide(index) {
        currentIndex = totalCards + index;
        updateSlider();
        resetInterval();
    }

    function resetInterval() {
        clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, 4000); // Geser otomatis setiap 4 detik
    }

    if (nextBtn) nextBtn.addEventListener('click', () => { nextSlide(); resetInterval(); });
    if (prevBtn) prevBtn.addEventListener('click', () => { prevSlide(); resetInterval(); });

    resetInterval();

    // Jeda pergerakan otomatis saat kursor berada di area slider
    container.addEventListener('mouseenter', () => clearInterval(slideInterval));
    container.addEventListener('mouseleave', resetInterval);

    // Dukungan Sentuh (Touch / Swipe & Mouse Drag)
    let isDragging = false, startPos = 0;

    function getClientX(e) {
        return e.type.includes('mouse') ? e.pageX : e.touches[0].clientX;
    }

    container.addEventListener('touchstart', dragStart, { passive: true });
    container.addEventListener('touchend', dragEnd);
    container.addEventListener('touchmove', dragMove, { passive: true });
    container.addEventListener('mousedown', dragStart);
    container.addEventListener('mouseup', dragEnd);
    container.addEventListener('mouseleave', (e) => { if (isDragging) dragEnd(e); });
    container.addEventListener('mousemove', dragMove);

    function dragStart(e) {
        isDragging = true;
        startPos = getClientX(e);
        clearInterval(slideInterval);
        track.style.transition = 'none';
    }

    function dragMove(e) {
        if (!isDragging) return;
        const currentPosition = getClientX(e);
        const diff = currentPosition - startPos;
        track.style.transform = `translateX(${-currentIndex * cardWidth + diff}px)`;
    }

    function dragEnd(e) {
        if (!isDragging) return;
        isDragging = false;
        const endPosition = e.type.includes('mouse') ? e.pageX : e.changedTouches[0].clientX;
        const diff = endPosition - startPos;

        if (diff < -50) {
            currentIndex++; // Geser ke kiri (Next)
        } else if (diff > 50) {
            currentIndex--; // Geser ke kanan (Prev)
        }

        updateSlider();
        resetInterval();
    }
});