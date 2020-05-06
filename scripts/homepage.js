var slides__num = 1;
display__slides(slides__num);

function slideshow__changeSlides(n) {
    display__slides(slides__num += n);
}
function display__slides(n) {
    var i;
    var slides = document.getElementsByClassName("slideshow__slides");
    if (n > slides.length) { slides__num = 1 }
    if (n < 1) { slides__num = slides.length }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slides__num - 1].style.display = "block";
}

// based on https://www.w3schools.com/w3css/w3css_slideshow.asp