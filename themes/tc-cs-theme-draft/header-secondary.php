<?php
/*
 * common header for all pages
 */
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php 
        /*
         * Print the <title> tag based on what is being viewed.
         */
        global $page, $paged;
    
        wp_title( '|', true, 'right' );
    
        // Add the blog name.
        bloginfo( 'name' );
    
        // Add the blog description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            echo " | $site_description";
    ?></title>

    <?php wp_head(); ?>
    
    <!-- Main CSS -->  
    <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/layout_basic.css" />
    <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/jqtransform.css" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/layout_secondary.css" />
	<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.jqtransform.js"></script>

    <?php get_template_part('header.assets'); ?>
  </head> 
  <body>
  
    <header id="header"> 
         <?php
			get_template_part('top-nav');
		?>
    </header><!-- End of #header -->
	<!--
    <nav class="secondaryMenu">
    	<?php wp_nav_menu( 
			array(
				'container' => false,
				'theme_location' => '',
				'menu' => 'secondary_menu',
			)
		); ?>
    </nav>
	-->