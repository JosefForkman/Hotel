let hedder = document.querySelector('header');
let hamburgerOpen = document.querySelector('#hamburgerOpen');

hamburgerOpen.addEventListener('click', () => {
    hedder.classList.toggle('active');
})
