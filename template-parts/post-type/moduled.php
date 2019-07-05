<?php if(have_posts()): while(have_posts()): the_post(); ?>
    <!-- Post Starts -->
    <div id="post-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class("full-width moduled-page"); ?>>
        <?php the_content(); ?>
    </div><!-- post Ends here -->
<?php endwhile;  endif; ?>