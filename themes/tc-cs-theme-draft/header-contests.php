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
        
        wp_title( '', true, 'right' ); 
    
        // Add the blog description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            echo " | $site_description";
    ?></title>
	<?php wp_head(); ?>

    <!-- Main CSS -->  
     <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/layout_basic.css" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/layout_blog.css" />
	<?php get_template_part('header.assets'); ?>
   
  </head> 
  <body>
    <header id="header"> 
        <?php
			get_template_part('top-nav');
		?>
        <div class="titleLine">
            <h1>
                <i>TopCoder Contests</i>
                <span>Open Innovation, Technology, the Future</span>
            </h1>
            <div class="searchBox">
                <div class="boxR">
                    <div class="boxMid">
                    <form method="get" name="searchform" id="searchform" enctype="application/x-www-form-urlencoded" action="<?php echo site_url ();?>/contest-search/">
                            <input name="Contest_Name" id="Contest_Name" type="text" data-placeholder="Search Contest" />
                            <a href="javascript: document.searchform.submit();"></a>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- End of .titleLine -->
    </header><!-- End of #header -->