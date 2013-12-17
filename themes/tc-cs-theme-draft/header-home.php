<?php
	include 'login.process.php';

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
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/layout_home.css" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/home_banners.css" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/layout_registermodal.css" />
    <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/layout_questionnaire.css" />
    <?php get_template_part('header.assets'); ?>
	
  </head> 
  <body>
      <header id="header"> 
        <?php
			get_template_part('top-nav');
		?>
		<!--
		<div class="banner">
        <?php query_posts(array(
					'post_type'=>'banner',
					 'orderby' => 'date', 
					 'order' => 'DESC',
					 'posts_per_page' => 1
				));
			if(have_posts()):while(have_posts()): the_post();
           
                $link = get_post_meta(get_the_ID(), 'Link', true);
                if ($link == null) {
					$link = esc_url( get_permalink( get_the_ID() ) );
				}
            ?>
            <a href="<?php echo $link; ?>">
                <figure>
            <?php
				$no_image = '';
				$thumbnailVal = get_post_meta(get_the_ID(),"Thumbnail",true);
				$thumbnailImg = wp_get_attachment_image_src( $thumbnailVal, "medium" );
				$thumbnailImg = $thumbnailImg[0];
				
				if($thumbnailImg!=null) {
			?>
                   <img src="<?php echo $thumbnailImg; ?>" alt=""/>
			<?php
                } else {
                    $no_image = 'noImage';
                }
            
            ?>
                    <figcaption class="<?php echo $no_image; ?>">
                    <?php
						$title = get_post_meta(get_the_ID(), 'Title', true);
						$content = get_post_meta(get_the_ID(), 'Banner Content', true);
						$footer = get_post_meta(get_the_ID(), 'Banner Footer', true);
					?>
                        <h2><?php echo $title; ?></h2>
                        <p><?php echo $content; ?></p>
                        <i><?php echo $footer; ?></i>
                    </figcaption>
                </figure>
                <span class="more">LEARN MORE!</span>
				<a target="_blank" href="<?php echo get_option('talk_url'); ?>" class="talk"></a>
            <?php endwhile; endif; 
            ?>
        </div>
		
		<div class="banner">
                    <a href="http://www.topcoder.com/whatiseoi">
                <figure>
                               <img alt="" src="http://www.topcoder.com/wp-content/uploads/2012/07/eoi-icon.png">
			                    <figcaption class="">
                                            <h2>Enterprise Open <span>Innovation</span></h2>
                        <p><font style="font-size:26px">Development, Design, Algorithms &amp; Analytics.</font><br><font style="font-size:15px"><span>The Power of Open Innovation</span>. The Process and Control Your Enterprise Demands.</font></p>
                        <i><i>The world's largest global competitive community + an enterprise level platform = your success.</i></i>
                    </figcaption>
                </figure>
                <span class="more">LEARN MORE!</span>
				</a><a class="talk" href="http://www.topcoder.com/whatiseoi" target="_blank"></a>
                    </div>
					
		<div id="banner1" class="banner">
			<a href="#" class="button">
				WANT TO<br/>
				<strong>TALK?</strong>
			</a>
			<div class="logo"></div>
			<div class="header"></div>
				<span class="smallHeader">Development, Design, Algorithms & Analytics</span>
			<div class="clear"></div>
				<a href="http://www.topcoder.com/whatiseoi" class="wantToTalk">Learn More</a>
				<div class="footerText">

					<span>Innovate Faster</span>
					<span class="arrow"></span>
					<span>Produce More</span>
					<span class="arrow"></span>
					<span>Risk Less</span>
					<span class="arrow"></span>
					<span>THIS IS ENTERPRISE <strong class="red">OPEN INNOVATION.</strong></span>
				</div>
		</div>
		
		<div id="banner2" class="banner">
              <div class="leftBar">
                  <h1>Digital Innovation on Demand</h1>
                    <h2>
                        <span class="first">What can <span class="memberCount">436,911</span> Developers, Designers,<br/>Algorithmists & Data Scientists<br/>do for you?
                        <span class="last">What can <span class="memberCount">436,911</span> Developers, Designers,<br/>Algorithmists & Data Scientists<br/>do for you?</span></span>
                    </h2>
                  <h3>Innovate Faster. Produce More. Risk Less.<br/>
                      <span>This  is Enterprise Open Innovation.</span></h3>
              </div>

              <div class="rightBar">
                  <a href="http://connect.topcoder.com/ContactUsGeneral_General.html" class="button">
                      <span class="first">Want to talk?<span class="last"> Want to talk?</span></span>
                  </a>
                  <a href="http://www.topcoder.com/whatiseoi" class="learnMore">
                      <span class="first">Learn More<span class="last">Learn More</span></span>
                  </a>
              </div>
          </div>
	
		<div id="banner3" class="banner">
			<img class="fLeft" src="/beta/wp-content/themes/tc-eoi-theme-demo/i/banner/b3_pict1.png" width="309" height="114" alt="" />
			<div class="right">
				<h2>
					Open Innovation and Crowdsourcing <br />
					for Your Enterprise
				</h2>
				<p>Development, Design, Algorithms &amp; Analytics</p>
			</div>
			<a href="http://connect.topcoder.com/ContactUsGeneral_General.html" class="btn1"><span class="mask">
			<span class="text">
			<img class="fLeft" src="/beta/wp-content/themes/tc-eoi-theme-demo/i/banner/b3_talkIcon.png" width="38" height="35" alt="" />WANT TO<br />TALK</span></span></a>
			<div class="clear"></div>
			<p class="textUnder">Innovate Faster. Produce More. Risk Less. <span class="red">This is Enterprise Open Innovation.</span><a href="http://www.topcoder.com/whatiseoi" class="btn2"><span class="mask"><span class="text">Learn More</span></span></a></p>
		</div>
		-->  
    </header><!-- End of #header -->