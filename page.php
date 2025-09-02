<!-- get header content -->
<?php

// get header content
get_header();

// get main content
echo '<div class="container">';
the_content();
echo '</div>';
// get footer content
get_footer();
