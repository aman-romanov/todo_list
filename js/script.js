function changeBg(){
    const img = [
        'url("../img/bg_1.jpg")',
        'url("../img/bg_2.jpg")',
        'url("../img/bg_3.jpg")',
        'url("../img/bg_4.jpg")',
        'url("../img/bg_5.jpg")',
        'url("../img/bg_6.jpg")',
        'url("../img/bg_7.jpg")'
    ];

    const slide = document.querySelector('body');
    const bg = img[Math.floor(Math.random()*img.length)];
    document.querySelector('body').style.backgroundImage=bg;
}

setInterval(changeBg(), 3000);

/* let currentSlide = 0;

function startSlider() {
  let imageCount = document.querySelectorAll(".bg-img");
  let images = document.querySelector(".bg-slideshow");

  if (imageCount.length === 0) {
    imageCount = document.querySelectorAll(".bg-img");
    images.style.transform = `translateX(0px)`;
    return;
  }

  images.style.transform = `translateX(-${currentSlide * 550}px)`;
}

setInterval(() => {
    startSlider();
}, 3000); */

/* // set index and transition delay
let index = 0;
let transitionDelay = 2000;

// get div containing the slides
let slideContainer = document.querySelector(".bg-slideshow");
// get the slides
let slides = document.querySelectorAll("li");

// set transition delay for slides
for (let slide of slides) {
  slide.style.transition = `all ${transitionDelay/1000}s linear`;
}

// show the first slide
showSlide(index);

// show a specific slide
function showSlide(slideNumber) {
  slides.forEach((slide, i) => {
    slide.style.display = i == slideNumber ? "block" : "none";
  });
  // next index
  index++;
  // go back to 0 if at the end of slides
  if (index >= slides.length) {
    index = 0;
  }
}

// transition to next slide every x seconds
setInterval (() => showSlide(index), transitionDelay); */


/* const slider = document.querySelector('.bg-slideshow');
const slides = document.querySelectorAll('.bg-slides');
 
// Store the total number of images
const slideCount = 7;
let activeSlide = 0;
 
// To change the images dynamically every 
// 5 Secs, use SetInterval() method

function showPicture(){
    slides[activeSlide].classList.remove('.bg-slides-active');
    activeSlide++;
    if (activeSlide === slideCount) {
      activeSlide = 0;
    }
    slides[activeSlide].classList.add('.bg-slides-active');
}

setInterval(showPicture(), 2000);
 */

/* const i = 0;
const images = [];
const slideTime = 3000; // 3 seconds

images[0] = '../img/bg_1.jpg';
images[1] = '../img/bg_2.jpg';
images[2] = '../img/bg_3.jpg';

function slideShow(){
    function changePicture() {
        document.body.style.backgroundImage = images[i];
    
        if (i < images.length - 1) {
            i++;
        } else {
            i = 0;
        };
    }
    setInterval(changePicture(), slideTime);
}

window.onload = slideShow(); */