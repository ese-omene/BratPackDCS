<?php
include 'includes/header.php';
?>
<!-- we have a slider which we manipulate with javascript -->
<link rel="stylesheet" type="text/css" href="styles/main.css" />
<div class="slideshow">
    <div class="slideshow__slides">
        <img src="images/sliderimages/s_image1.jpg" class="slidesow__slides_img">
        <div id="slideshow__slides_caption1">
            <div>Experience child care as it should be.</div>
            <a href="">Read more about us</a>
        </div>
    </div>
    <div class="slideshow__slides">
        <img src="images/sliderimages/s_image2.jpg" class="slidesow__slides_img">
        <div id="slideshow__slides_caption2">
            <div>A nurturing and creative world.</div>
            <a href="">Why choose us?</a>
        </div>
    </div>
    <div class="slideshow__slides">
        <img src="images/sliderimages/s_image3.jpg" class="slidesow__slides_img">
        <div id="slideshow__slides_caption3">
            <div>A great place to grow.</div>
            <a href="">Find out more about our activities</a>
        </div>
    </div>

    <a class="slideshow__arrow_prev" onclick="slideshow__changeSlides(-1)">&#10094;</a>
    <a class="slideshow__arrow_next" onclick="slideshow__changeSlides(1)">&#10095;</a>
</div>

<!-- we include the needed javascript file -->
<script src="scripts/homepage.js"> </script>
<?php
include 'includes/footer.php';
?>