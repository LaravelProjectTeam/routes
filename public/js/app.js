// mobile menu
const burgerIcon = document.querySelector('#burger');
const navbarMenu = document.querySelector('#nav-links');

burgerIcon.addEventListener('click', () => {
  navbarMenu.classList.toggle('is-active');
});

// notifications
const notificationCloseButton = document.querySelector('.notification > .delete');

notificationCloseButton?.addEventListener('click', () => {
    notificationCloseButton.parentNode.remove();
});
