<?php
/*
 force to load aja-oper (json generator), will be used by calendar widget on webinars and events
 
 */
if ( $_REQUEST['a_type'] != '' ):	
	get_template_part( 'ajax-oper' );
	exit;
endif;	

 ?>
<?php 
	include 'login.process.php';
	
	$requestUrl = $_SERVER["REQUEST_URI"];

	if(preg_match('/\/news\/$/', $requestUrl)) {
		define("PORTAL","news");		
		get_template_part( 'front', 'news' );
		die();
	}
	if(preg_match('/\/news\/page\//', $requestUrl)) {
		define("PORTAL","news");
		get_template_part( 'front', 'news' );
		die();
	}    
	if(preg_match('/\/blog\/$/', $requestUrl)) {
		define("PORTAL","blog");
		get_template_part( 'front', 'blog' );
		die();
	}
    if(preg_match('/\/blog\/page\//', $requestUrl)) {
		define("PORTAL","blog");
		get_template_part( 'front', 'blog' );
		die();
    }
	if(preg_match('/\/event\/$/', $requestUrl)) {
		get_template_part( 'front', 'event' );
		die();
	}
	if(preg_match('/\/author\//', $requestUrl)) {
		get_template_part( 'author' );
		die();
	}
	if(preg_match('/\/category\//', $requestUrl)) {
		get_template_part( 'category' );
		die();
	}
	
    get_header();
    $values = get_post_custom($post->ID);
	
	?>
	
    <div id="mainContent">
		<div id="content">
			<div id="main">
					<div class="filter filterSingle">
						<div class="pageNum">
                        		<?php echo previous_post_link('%link', '<span class="prev"></span> Prev');?>
                                |
                                <?php echo next_post_link('%link', 'Next <span class="next"></span>'); ?>
						 </div>
					
					 <div class="clear"></div>
					</div>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
						
						<h3><?php the_title();?></h3>
						<div class="article">
							<span class="dateAuthor"><?php the_date();?></span>
							<div class="post">
								<?php echo the_content();?>
							</div>
							<?php comments_template(); ?>
							<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>

							<div class="filterBT">
							 <div class="pageNum pageNumBT">
							 	<?php echo previous_post_link('%link', '<span class="prev"></span> Prev');?>
                                |
                                <?php echo next_post_link('%link', 'Next <span class="next"></span>'); ?>
							 </div>
							 
							</div>
							<!--End filterBT-->
							 <div class="clear"></div>
						</div>
      			  <?php endwhile; endif;?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>