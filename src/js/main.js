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
  link.classList.add('lightbox');
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