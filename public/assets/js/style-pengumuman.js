
    let currentScale = 1;
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');

    // Fungsi membuka gambar
    function openModal(imageSrc) {
        modal.style.display = 'flex';
        modalImg.src = imageSrc;
        resetZoom(); // Pastikan ukuran kembali normal saat baru dibuka
    }

    // Fungsi menutup gambar
    function closeModal() {
        modal.style.display = 'none';
    }

    // Fungsi memperbesar gambar (Zoom In)
    function zoomIn() {
        currentScale += 0.3;
        modalImg.style.transform = `scale(${currentScale})`;
    }

    // Fungsi memperkecil gambar (Zoom Out)
    function zoomOut() {
        if (currentScale > 0.4) {
            currentScale -= 0.3;
            modalImg.style.transform = `scale(${currentScale})`;
        }
    }

    // Fungsi mengembalikan ke ukuran awal
    function resetZoom() {
        currentScale = 1;
        modalImg.style.transform = `scale(${currentScale})`;
    }

    // Menutup pop-up jika responden klik area hitam di luar gambar
    window.addEventListener('click', function(event) {
        if (event.target === modal || event.target === document.getElementById('modalImgContainer')) {
            closeModal();
        }
    });
