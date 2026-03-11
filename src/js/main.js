// /** Add class to submenu containers that have the current child in the navigation **/

var getParents = function (elem, selector) {

  // Set up a parent array
  var parents = [];

  // Push each parent element to the array
  for (; elem && elem !== document; elem = elem.parentNode) {
    if (selector) {
      if (elem.matches(selector)) {
        parents.push(elem);
      }
      continue;
    }
    parents.push(elem);
  }

  // Return our parent array
  return parents;
};

// Get subNavs
var currentSubNavs;
currentSubNavs = document.querySelectorAll(".is-style-caes-fac-vertical-nav .current-menu-item");

var elem = document.querySelector(".is-style-caes-fac-vertical-nav .current-menu-item");
var parents = getParents(elem, ".wp-block-navigation__submenu-container");

parents.forEach(function (item) {
  item.classList.add('caes-fac-subnav-currparent')
});

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
var timer = 0;
var count = 0;
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
  link.classList.add('parvus-lightbox');
  // get sibling of link if it is a figcaption
  const sibling = link.nextElementSibling;
  // if sibling is a figcaption, add lightbox class to it
  if (sibling && sibling.classList.contains('wp-element-caption')) {
    // get html of sibling
    const caption = sibling.innerHTML;
    // set caption text to data-caption
    link.setAttribute('data-caption', caption);
  }
}

// Import Parvus
import Parvus from 'parvus';

// // Initialize Parvus
const prvs = new Parvus({
  selector: '.parvus-lightbox',
  gallerySelector: '.wp-block-gallery'
})

// /** PLUGINS JS **/ //
// These should be consolidated into block code once we replace shortcode versions

// /** Plugin: CAES Admin - Tabbed Sites List **/

window.addEventListener("DOMContentLoaded", () => {
  const tabs = document.querySelectorAll('[role="tab"]');
  const tabList = document.querySelector('[role="tablist"]');

  // Add a click event handler to each tab
  tabs.forEach((tab) => {
    tab.addEventListener("click", changeTabs);
  });

  // Enable arrow navigation between tabs in the tab list
  let tabFocus = 0;

  if (tabList !== null) {

    tabList.addEventListener("keydown", (e) => {
      // Move right
      if (e.key === "ArrowRight" || e.key === "ArrowLeft") {
        tabs[tabFocus].setAttribute("tabindex", -1);
        if (e.key === "ArrowRight") {
          tabFocus++;
          // If we're at the end, go to the start
          if (tabFocus >= tabs.length) {
            tabFocus = 0;
          }
          // Move left
        } else if (e.key === "ArrowLeft") {
          tabFocus--;
          // If we're at the start, move to the end
          if (tabFocus < 0) {
            tabFocus = tabs.length - 1;
          }
        }

        tabs[tabFocus].setAttribute("tabindex", 0);
        tabs[tabFocus].focus();
      }
    });

  }
});

function changeTabs(e) {
  const target = e.target;
  const parent = target.parentNode;
  const grandparent = parent.parentNode;

  // Remove all current selected tabs
  parent
    .querySelectorAll('[aria-selected="true"]')
    .forEach((t) => t.setAttribute("aria-selected", false));

  // Set this tab as selected
  target.setAttribute("aria-selected", true);

  // Hide all tab panels
  grandparent
    .querySelectorAll('[role="tabpanel"]')
    .forEach((p) => p.setAttribute("hidden", true));

  // Show the selected panel
  grandparent.parentNode
    .querySelector(`#${target.getAttribute("aria-controls")}`)
    .removeAttribute("hidden");
}

// WP Inventory - add a wrapper around the wp-inventory plugin table if it exists

var wpInvTables = document.querySelectorAll("table.wpinventory_loop");

const wrapWPInvTables = () => {
  wpInvTables.forEach((table) => {
    var wrapper = document.createElement('div');
    wrapper.className = "wp-inv-wrapper";
    table.parentNode.insertBefore(wrapper, table);
    wrapper.appendChild(table);
  })
}

wrapWPInvTables();

/* BACK TO TOP BUTTON */

// First, wait until the whole page is loaded
document.addEventListener('DOMContentLoaded', function () {

  // Add new link element to dom
  const backToTop = document.createElement('a');
  backToTop.innerHTML = `
  <span>Back to top</span>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M201.4 137.4c12.5-12.5 32.8-12.5 45.3 0l160 160c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L224 205.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l160-160z"/></svg>`;
  backToTop.href = '#';
  backToTop.classList.add('caes-fac-back-to-top');

  // Append backToTop to <main> element
  let mainSection;

  if (document.querySelector('main .caes-fac-post-cols') !== null) {
    mainSection = document.querySelector('main .caes-fac-post-cols');
  } else {
    mainSection = document.querySelector('main');
  }

  mainSection.appendChild(backToTop);

  // Show or hide button if scroll position is lower than viewport height
  window.addEventListener('scroll', function () {
    if (window.scrollY > (window.innerHeight / 2)) {
      if (!backToTop.classList.contains('caes-fac-back-to-top-visible')) {
        backToTop.classList.add('caes-fac-back-to-top-visible');
      }
    } else {
      if (backToTop.classList.contains('caes-fac-back-to-top-visible')) {
        backToTop.classList.add('caes-fac-back-to-top-hiding');
        setTimeout(() => {
          backToTop.classList.remove('caes-fac-back-to-top-visible', 'caes-fac-back-to-top-hiding');
        }, 250); // Match the timeout to the CSS transition duration for opacity
      }
    }
  });
  // Add event listener to backToTop
  backToTop.addEventListener('click', function (event) {
    event.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });

  // WP Accordion scroll
  const accordionButtons = document.querySelectorAll('.wp-block-accordion-item button');

  if (accordionButtons.length) {
    accordionButtons.forEach(button => {
      button.addEventListener('click', function () {
        setTimeout(() => {
          const accordionItem = this.closest('.wp-block-accordion-item');
          const offset = 20;
          const top = accordionItem.getBoundingClientRect().top + window.pageYOffset - offset;

          window.scrollTo({
            top: top,
            behavior: 'smooth'
          });
        }, 300);
      });
    });
  }

});