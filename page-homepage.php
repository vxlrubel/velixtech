<?php
/*
Template Name: Home Page
Description: A custom template for displaying homepage.
*/

get_header();
?>

<div class="clearfix">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div>
                    <div>here is the small title</div>
                    <div>Big Title Here</div>
                    <div>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempora numquam, et adipisci officiis excepturi amet natus nobis, eaque exercitationem quibusdam aspernatur ad! Culpa, fugit minima!
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="ratio-16x9">
                    <img src="<?php echo ASSETS . 'img/hero-image.jpg' ?>" class="mix-blend-mode-darken" alt="hero image">
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
