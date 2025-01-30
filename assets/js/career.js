// Scroll to Top Button Logic
let scrollToTopBtn = document.getElementById("scrollToTopBtn");

// Show or hide the "Scroll to Top" button when scrolling
window.onscroll = function() {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    scrollToTopBtn.classList.add("show-scroll-btn");
  } else {
    scrollToTopBtn.classList.remove("show-scroll-btn");
  }
};

// Smooth Scroll to the Top
function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
}
