
gsap.registerPlugin(ScrollTrigger, ScrollSmoother, ScrollToPlugin);


/************** Smooth Scroll Intialisation start **************/
// Create a media condition that targets viewports at least 768px wide
const mediaQuery = window.matchMedia('(min-width: 768px)')
// Check if the media query is true
if (mediaQuery.matches) { 
  let smoother = ScrollSmoother.create({ 
    smooth: 2,
    normalizeScroll: true, 
    effects: true, 
  });
}
/************** Smooth Scroll Intialisation end **************/

 
    /************** Animation on scroll for ipad and dekstop view start **************/
    gsap.utils.toArray('.animate-child').forEach(animateChild => {
    gsap.to(animateChild, { 
      scrollTrigger: {
          trigger: animateChild, 
          start: 'top 80%', 
          once: true,
          toggleClass:'trigger', 
        }
      });
    });
    /************** Animation on scroll for ipad and dekstop view end **************/
    
   

$('.btn-hero').click(function(){
  gsap.to(window, {
    duration: 0.5,
    scrollTo: '#download'
  });

})
/************** Scroll to script for Home hero end **************/

/************** Swiper js script for all sliders start **************/
/* Testimonial slider */
if(document.querySelector(".testimonial-slider")){
  var swiper = new Swiper(".testimonial-slider", {
  slidesPerView: "auto",
  centeredSlides: false,
  spaceBetween: 80, 
  loop:false,  
  slideToClickedSlide:true,
  keyboard: {
    enabled: true,
  },
  breakpoints: {
    320: {
    spaceBetween: 10,
    centeredSlides: false,
    },
    768: { 
    spaceBetween: 80,
    centeredSlides: true,
    } 
  }
});
}

var swiper = new Swiper(".mySwiper", {
  effect: "cards",
  grabCursor: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  
});

/************** Swiper js script for all sliders end **************/



/************** Add class to body when navigation open below 1200px screensize start **************/
document.querySelector(".navbar-toggler").addEventListener("click", function(){
  document.querySelector("body").classList.toggle("nav-open");
});
 
/************** Add class to body when navigation open below 1200px screensize end **************/

/************** Add class to body when user start to scroll**************/
window.onscroll = function() {
  fixHeader()
};
var body = document.getElementsByTagName("body")[0];
var sticky = body.offsetTop + 10;

function fixHeader() {
  if (window.pageYOffset > sticky) {
      body.classList.add("fixed");
  } else {
      body.classList.remove("fixed");
  }
}
/************** Add class to body when user start to scroll**************/


/************** Bootstrap form validation start **************/
// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
'use strict'

// Fetch all the forms we want to apply custom Bootstrap validation styles to
const forms = document.querySelectorAll('.needs-validation')

// Loop over them and prevent submission
Array.from(forms).forEach(form => {
form.addEventListener('submit', event => {
if (!form.checkValidity()) {
event.preventDefault()
event.stopPropagation()
}

form.classList.add('was-validated')
}, false)
})
})();
/************** Bootstrap form validation end **************/

/************** video play control start **************/

document.addEventListener('DOMContentLoaded', (event) => {
  const videos = document.querySelectorAll('.custom-video');

  videos.forEach((video) => {
      video.addEventListener('play', () => {
          videos.forEach((vid) => {
              if (vid !== video) {
                  vid.pause();
              }
          });
      });
  });
});

/************** video play control end **************/

 


