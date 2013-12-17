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
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/layout_webinar.css" />
    <!--[if IE 7]>
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/ie7.css"/>
    <![endif]-->
    <style>
		body > .tbl .inner .buttonBar a.vdownload,
		.popMask .popup .scrollArea a.vdownload
		{display:none;}
	</style>
   	<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.min.js"></script>
   	<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery-ui-1.8.18.custom.min.js"></script>
   	<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery-ui-effect.min.js"></script>
   	<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.jqtransform.js"></script>
   	<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/cufon-yui.js"></script>
	<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/myriad-pro.cufonfonts.js"></script>
    <script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.jcarousel.js"></script>	
	<script  type="text/javascript">
	/* re-arrange webinar modal */
	$(window).scroll(function(){		
		screenwidth = $(window).width();
		screenheight = $(window).height();
		docheight = $(document).height();
		docwidth = $(document).width();
		popWinPosLeft = screenwidth/2 - $('.popup:visible').width()/2;
		popWinPosTop = screenheight/2 - $('.popup:visible').height()/2;
		$("#greybackground").css({"height":docheight,"width":docwidth});
		if(popWinPosTop<0)
			$('.popMask').css({"position":"absolute"});
		else
			$('.popMask').css({"position":"fixed"});		
	
		
	});

var carousselPosition=0;	
$(document).ready(function(){		
	
	if ( $(".topCarousel ul.container li").length > 1 ) { 
		try {
			$('.topCarousel .container').jcarousel({
				auto: 5,
				scroll: 1,
				wrap: 'circular',
				animation:700,
				initCallback: mycarousel_initCallback,
				itemVisibleInCallback: {onBeforeAnimation: carouselStepCallback},
				buttonNextHTML: null,
				buttonPrevHTML: null
			});
		}catch(e) {
		}
	}
	
	function mycarousel_initCallback(carousel) {
		
		jQuery('.pagDot').bind('click', function() {
			var carousselPosition = parseInt($(this).attr('rel'), 0);
			carousel.scroll(  parseInt($(this).children().html()) );
			jQuery('.carouselDot a').removeClass("activeBullet");
			jQuery(this).addClass("activeBullet");
			//$(".description").hide();
			//$("#description"+carousselPosition).show();
			return false;
		});
		
		jQuery('.carouselDot a').bind('mouseenter', function() {
			carousel.stopAuto();      
			return false;
		});
		jQuery('.carouselDot a').bind('mouseleave', function() {
			carousel.startAuto();       
			return false;
		});
	};

	function carouselStepCallback(carousel) {
		try {
			Cufon.replace('.myriad_pro_bold_condensed',  { fontFamily: 'Myriad Pro Bold Condensed', hover: true }); 
			Cufon.replace('.myriad_pro_condensed', { fontFamily: 'Myriad Pro Condensed', hover: true }); 
		} catch (e) {
		}
	
		carousselPosition = carousel.last % carousel.size();
		carousselPosition = carousselPosition==0 ? carousel.size() : carousselPosition;  

		jQuery('.carouselDot a').removeClass("current");
		$("#carouselNav-"+carousselPosition).addClass("current");
		
		//$(".description").hide();
		//$("#description"+carousselPosition).show();
	}
});
	</script>
	
	
	<?php get_template_part('header.assets'); ?>
  </head> 
  <body>
    <header id="header" class="webinarHeader">
        <?php
			get_template_part('top-nav');
		?>
        <div class="titleLine">
            <h1>
                <i class="myriad_pro_bold_condensed">WEBINARS AND INNOVATION VIDEOS</i> 
            </h1>
            <div class="searchBox">
                <div class="boxR">
                    <div class="boxMid">
                        <form method="get" name="searchform" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <input name="s" id="s" type="text" data-placeholder="Search Blog" />
                            <input type="hidden" name="type" value="blog" />
                            <a href="javascript: document.searchform.submit();"></a>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- End of .titleLine -->
    </header><!-- End of #header -->
    