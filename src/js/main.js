// /** PARVUS - Parvus is a lightbox library for images **/

// // First, find all the image blocks that link to an image.
// const linkedImgs = document.querySelectorAll('.wp-block-image a[href*=".jpg"],.wp-block-image a[href*=".jpeg"],.wp-block-image a[href*=".png"],.wp-block-image a[href*=".gif"]');
// for (const link of linkedImgs) {
//    link.classList.add('lightbox');
//   }

// // Import Parvus
// import Parvus from 'parvus';

// // Initialize Parvus
// const prvs = new Parvus({
//     gallerySelector: '.wp-block-gallery',
//     captionsSelector: 'img',
//     captionsAttribute: 'alt'
// })

// Import Tobii
import Tobii from '@midzer/tobii';

// First, find all the image blocks that link to an image.
const linkedImgs = document.querySelectorAll('.wp-block-image a[href*=".jpg"],.wp-block-image a[href*=".jpeg"],.wp-block-image a[href*=".png"],.wp-block-image a[href*=".gif"]');
for (const link of linkedImgs) {
   link.classList.add('lightbox');
  }

// Then, set data-group attribute on child images of each wp-block gallery.
const wpGalleries = document.querySelectorAll('.wp-block-gallery');

function setGroupAttr(gallery, index) {
  const galleryImgs = gallery.querySelectorAll('.wp-block-image a[href*=".jpg"],.wp-block-image a[href*=".jpeg"],.wp-block-image a[href*=".png"],.wp-block-image a[href*=".gif"]');
  for (const galleryImg of galleryImgs)  {
    galleryImg.setAttribute("data-group", "gallery-" + index);
  }
}

wpGalleries.forEach((gallery, index) => setGroupAttr(gallery, index));

const tobii = new Tobii();