// /** Navigation block - make collapsable on mobile **/

// Coming soon...

// /** Animations on scroll **/

const scrollElements = document.querySelectorAll(".js-scroll");
const throttleCount = document.getElementById('throttle-count');

var throttleTimer;

const throttle = (callback, time) => {
  if (throttleTimer) return;

  throttleTimer = true;
  setTimeout(() => {
    callback();
    throttleTimer = false;
  }, time);
}

const elementInView = (el, dividend = 1) => {
  const elementTop = el.getBoundingClientRect().top;

  return (
    elementTop <=
    (window.innerHeight || document.documentElement.clientHeight) / dividend
  );
};

const elementOutofView = (el) => {
  const elementTop = el.getBoundingClientRect().top;

  return (
    elementTop > (window.innerHeight || document.documentElement.clientHeight)
  );
};

const displayScrollElement = (element) => {
  element.classList.add("scrolled");
};

const hideScrollElement = (element) => {
  element.classList.remove("scrolled");
};

const handleScrollAnimation = () => {
  scrollElements.forEach((el) => {
    if (elementInView(el, 1.25)) {
      displayScrollElement(el);
    } else if (elementOutofView(el)) {
      hideScrollElement(el)
    }
  })
}
var timer=0;
var count=0;
var scroll = 0;

handleScrollAnimation();

window.addEventListener("scroll", () => { 
  throttle(() => {
    handleScrollAnimation();
  }, 250);
});

// /** PARVUS - Parvus is a lightbox library for images **/

// // First, find all the image blocks that link to an image.
const linkedImgs = document.querySelectorAll('.wp-block-image a[href*=".jpg"],.wp-block-image a[href*=".jpeg"],.wp-block-image a[href*=".png"],.wp-block-image a[href*=".gif"]');
for (const link of linkedImgs) {
  link.classList.add('lightbox');
}

// Import Parvus
import Parvus from 'parvus';

// // Initialize Parvus
const prvs = new Parvus({
  gallerySelector: '.wp-block-gallery',
  captionsSelector: 'img',
  captionsAttribute: 'alt'
})