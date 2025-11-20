const slides = document.querySelectorAll('.rank-slide');
const total = slides.length;
let current = 0;

const indexLabel = document.getElementById('rankIndex');

function updateIndicator() {
    indexLabel.textContent = current + 1;
}

function showRank(newIndex, direction) {
    let oldSlide = slides[current];
    let newSlide = slides[newIndex];

    oldSlide.classList.remove('active');
    newSlide.classList.remove('slide-left', 'slide-right');

    // Animación según la dirección
    if (direction === "next") {
        oldSlide.classList.add('slide-left');
        newSlide.style.left = "100%";
    } else {
        oldSlide.classList.add('slide-right');
        newSlide.style.left = "-100%";
    }

    setTimeout(() => {
        newSlide.classList.add('active');
        newSlide.style.left = "0";
    }, 30);

    current = newIndex;
    updateIndicator();
}

document.getElementById('nextRank').addEventListener('click', () => {
    let next = (current + 1) % total;
    showRank(next, "next");
});

document.getElementById('prevRank').addEventListener('click', () => {
    let prev = (current - 1 + total) % total;
    showRank(prev, "prev");
});

updateIndicator();