let header, footer, main;

function initElements() {
    header = document.getElementById('header');
    footer = document.getElementById('footer');
    main = document.getElementById('main-content');
}

function adjustMainHeight() {
    if (!header || !footer || !main) {
        initElements();
    }

    if (!header || !footer || !main) return;

    if (window.innerHeight <= 943 || window.innerWidth < 768) {
        main.style.height = 'auto';
    } else {
        const availableHeight = window.innerHeight - header.offsetHeight - footer.offsetHeight;
        main.style.height = availableHeight + 'px';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    initElements();
    adjustMainHeight();
});

window.addEventListener('load', adjustMainHeight);
window.addEventListener('resize', debounce(adjustMainHeight, 500));

function debounce(func, delay) {
    let timeout;
    return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func(...args), delay);
    };
}
