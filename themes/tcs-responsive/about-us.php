<?php
/*
Template Name: About Us
*/
?>
<?php 
/**
 * Enqueue scripts and styles those where used only on this template
 */
add_action ( 'wp_enqueue_scripts', 'contact_us_inc_style' );
function contact_us_inc_style() {
	wp_register_style ( 'member.css',  get_bloginfo( 'stylesheet_directory' ).'/css/members.css');
	wp_enqueue_style ( 'member.css' );
	wp_register_script ( 'member.js', get_bloginfo( 'stylesheet_directory' ).'/js/member.js');
	wp_enqueue_script ( 'member.js' );
}
?>
<?php get_header(); ?>

        <div class="content pageView">
            <div id="main">
                <?php if(have_posts()) : the_post();?>
                        <?php the_content();?>
                <?php endif; wp_reset_query();?>

<?php get_footer(); ?>
