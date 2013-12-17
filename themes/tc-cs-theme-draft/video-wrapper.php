<?php
/**
 * Template Name: Video Wrapper
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
    <!-- Main CSS -->  
    
    <script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/lib/videojs/video.css" />
    <script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/lib/videojs/video.js"></script>
    
    <script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/lib/flowplayer/flowplayer-3.2.11.min.js"></script>
    <script type="text/javascript">
      	_V_.options.flash.swf = "<?php bloginfo( 'stylesheet_directory' ); ?>/lib/videojs/video-js.swf";
	</script>
	
    <style>
    	html {
            width: 610px;
            height: 320px;
            padding: 0;
            margin: 0;
        }
        * {
            margin: 0;
            padding: 0;
        }
        #mediaplayer {
            display: none;
            position: absolute; 
            left: 0; 
            top: 0;
            width:610px;
            height:320px;
        }
   </style>
   <script type="text/javascript">
   		$(document).ready(function(e) {
			
			function understands_video() {
  				return !!document.createElement('video').canPlayType; // boolean
			}
			if ( !understands_video() || $.browser.mozilla) {
				$('#mediaplayer').css('display', 'block');
				$('#htmlplayer').remove();
 				flowplayer('mediaplayer', {
					src: '<?php bloginfo( 'stylesheet_directory' ); ?>/lib/flowplayer/flowplayer-3.2.14.swf',
					wmode: 'transparent'
				});
			}
        });
   </script>
  </head> 
  <body>
<?php
$pId = $_GET['pid'];
if (isset($pId)) {
	
	$thumbnailVal = get_post_meta($pId,"Video Thumbnail",true);
	$thumbnailImg = wp_get_attachment_image_src( $thumbnailVal, "medium" );
	if ($thumbnailImg) {
		$thumbnailImg = $thumbnailImg[0];
	} else {
		$thumbnailImg = '';
	}
	$videoId = get_post_meta($pId,"Video",true);
	$weburl = wp_get_attachment_url($videoId);
?>
<video id="htmlplayer" class="video-js vjs-default-skin"  
      controls preload="auto" width="610" height="320"  
      poster="<?php echo $thumbnailImg; ?>"  
      data-setup='{}' src="<?php echo $weburl; ?>">
</video>
<div>
	<a href="<?php echo $weburl; ?>" id="mediaplayer"></a> 
</div>
<?php
}
 
?>

</body>