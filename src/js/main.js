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