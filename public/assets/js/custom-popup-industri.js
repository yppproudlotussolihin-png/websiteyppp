window.addEventListener('DOMContentLoaded', () => {

    // ==========================================
    // 1. LOGIKA POP-UP AWAL (INFINITE SLIDER)
    // ==========================================
    const popup = document.getElementById('infoPopup');
    if (popup) {
        const closeBtn = document.getElementById('closePopup');

        setTimeout(() => { popup.classList.add('active'); }, 500);
        if (closeBtn) {
            closeBtn.addEventListener('click', () => { popup.classList.remove('active'); });
        }
        popup.addEventListener('click', (e) => { if (e.target === popup) popup.classList.remove('active'); });

        const popupSlides = document.getElementById('popupSlides');
        if (popupSlides) {
            const originalPopupImages = popupSlides.querySelectorAll('img');
            const totalPopup = originalPopupImages.length;
            const popupPrev = document.getElementById('popupPrev');
            const popupNext = document.getElementById('popupNext');
            const popupDotsContainer = document.getElementById('popupDots');

            const pClonesBefore = [];
            const pClonesAfter = [];
            originalPopupImages.forEach(img => {
                pClonesBefore.push(img.cloneNode(true));
                pClonesAfter.push(img.cloneNode(true));
            });
            pClonesAfter.forEach(clone => popupSlides.appendChild(clone));
            pClonesBefore.reverse().forEach(clone => popupSlides.insertBefore(clone, popupSlides.firstChild));

            let popupIdx = totalPopup;
            let popupInterval;

            if (popupDotsContainer) {
                originalPopupImages.forEach((_, i) => {
                    const dot = document.createElement('div');
                    dot.classList.add('dot');
                    if (i === 0) dot.classList.add('active');
                    dot.addEventListener('click', () => { goToPopupSlide(i); });
                    popupDotsContainer.appendChild(dot);
                });
            }
            const popupDots = popupDotsContainer ? popupDotsContainer.querySelectorAll('.dot') : [];

            popupSlides.style.transition = 'none';
            popupSlides.style.transform = `translateX(-${popupIdx * 100}%)`;

            function updatePopupSlider() {
                popupSlides.style.transition = 'transform 0.5s ease-in-out';
                popupSlides.style.transform = `translateX(-${popupIdx * 100}%)`;

                const activeDot = (popupIdx - totalPopup + totalPopup * 10) % totalPopup;
                popupDots.forEach(dot => dot.classList.remove('active'));
                if (popupDots[activeDot]) popupDots[activeDot].classList.add('active');
            }

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
                popupInterval = setInterval(nextPopupSlide, 4000);
            }

            if (popupNext) popupNext.addEventListener('click', () => { nextPopupSlide(); resetPopupInterval(); });
            if (popupPrev) popupPrev.addEventListener('click', () => { prevPopupSlide(); resetPopupInterval(); });
            resetPopupInterval();
        }
    }


    // ==========================================
    // 2. FUNGSI REUSABLE UNTUK SLIDER (PRODUK & BERITA)
    // ==========================================
    function setupSlider(containerId, trackId, prevBtnId, nextBtnId, dotsContainerId) {
        const container = document.getElementById(containerId);
        const track = document.getElementById(trackId);
        if (!container || !track) return;

        const originalCards = track.children;
        const totalCards = originalCards.length;
        const prevBtn = document.getElementById(prevBtnId);
        const nextBtn = document.getElementById(nextBtnId);
        const dotsContainer = document.getElementById(dotsContainerId);

        // Lebar card (320px) + gap CSS (25px)
        const cardWidth = 320 + 25; 

        // Kloning elemen untuk infinite loop yang mulus
        const clonesBefore = [];
        const clonesAfter = [];
        Array.from(originalCards).forEach(card => {
            clonesBefore.push(card.cloneNode(true));
            clonesAfter.push(card.cloneNode(true));
        });

        clonesAfter.forEach(clone => track.appendChild(clone));
        clonesBefore.reverse().forEach(clone => track.insertBefore(clone, track.firstChild));

        let currentIndex = totalCards;
        let slideInterval;

        // Buat titik indikator (dots)
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

        // Reset posisi secara instan di ujung agar perputaran tak terbatas
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
            slideInterval = setInterval(nextSlide, 4000); // Geser otomatis tiap 4 detik
        }

        if (nextBtn) nextBtn.addEventListener('click', () => { nextSlide(); resetInterval(); });
        if (prevBtn) prevBtn.addEventListener('click', () => { prevSlide(); resetInterval(); });

        resetInterval();

        // Jeda saat kursor berada di atas slider
        container.addEventListener('mouseenter', () => clearInterval(slideInterval));
        container.addEventListener('mouseleave', resetInterval);

        // Dukungan Sentuh (Touch / Swipe & Drag)
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
                currentIndex++;
            } else if (diff > 50) {
                currentIndex--;
            }

            updateSlider();
            resetInterval();
        }
    }

    // Inisialisasi Slider untuk Produk Unggulan
    setupSlider('produkContainer', 'produkTrack', 'produkPrev', 'produkNext', 'produkDots');

    // Inisialisasi Slider untuk Berita & Artikel
    setupSlider('beritaContainer', 'beritaTrack', 'beritaPrev', 'beritaNext', 'beritaDots');
});