<?php
/*
 * header for news page
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
	<?php get_template_part('header.assets'); ?>
	
   
  </head> 
  <body>
    <header id="header"> 
        <?php
			get_template_part('top-nav');
		?>       
    </header><!-- End of #header -->
    