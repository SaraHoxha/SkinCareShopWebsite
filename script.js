let slideNum = 1;
showSlides(slideNum);

function nextSlide(n) {
  showSlides(slideNum += n);
}

function  prevSlide(n) {
    showSlides(slideNum -= n);
  }

function currentSlide(n) {
  showSlides(slideNum = n);
}

function showSlides(n) {
  let i;
  let banners = document.getElementsByClassName("banner");
  let dots = document.getElementsByClassName("dot");
  if (n > banners.length) {slideNum = 1} 

  if (n < 1) {slideNum = banners.length}

  for (i = 0; i < banners.length; i++) {
    banners[i].style.display = "none"; 
  }

  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }

  banners[slideNum-1].style.display = "block"; 
  dots[slideNum-1].className += " active";
}