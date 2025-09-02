<?php
/*
Template Name: Blog Page
Description: A custom template for displaying blog posts.
*/

get_header();
?>

<div class="container">
    <h1><?php the_title(); ?></h1>
    <?php
    // Display posts (the blog loop)
    $blog_query = new WP_Query(array(
        'post_type'      => 'post',
        'posts_per_page' => 10,
        'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
    ));
    if ($blog_query->have_posts()) :
        while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
            <div class="blog-post">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="post-meta"><?php the_time('F j, Y'); ?></div>
                <div class="post-excerpt"><?php the_excerpt(); ?></div>
            </div>
    <?php endwhile;

        // Pagination
        the_posts_pagination(array(
            'prev_text' => 'Previous',
            'next_text' => 'Next',
        ));
    else :
        echo '<p>No posts found.</p>';
    endif;
    wp_reset_postdata();
    ?>
</div>

<?php
get_footer();
?>
