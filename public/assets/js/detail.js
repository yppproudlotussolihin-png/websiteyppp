let currentScale = 1;
const modal = document.getElementById('imageModal');
const modalImg = document.getElementById('modalImage');

function openModal(imageSrc) {
    modal.style.display = 'flex';
    modalImg.src = imageSrc;
    resetZoom();
}

function closeModal() {
    modal.style.display = 'none';
}

function zoomIn() {
    currentScale += 0.3;
    modalImg.style.transform = `scale(${currentScale})`;
}

function zoomOut() {
    if (currentScale > 0.4) {
        currentScale -= 0.3;
        modalImg.style.transform = `scale(${currentScale})`;
    }
}

function resetZoom() {
    currentScale = 1;
    modalImg.style.transform = `scale(${currentScale})`;
}

window.addEventListener('click', function(event) {
    if (event.target === modal || event.target === document.getElementById('modalImgContainer')) {
        closeModal();
    }
});