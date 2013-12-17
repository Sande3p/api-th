<?php
/*
 * Template Name: Single
 */

?>
<?php 
   	get_header();
    
    $values = get_post_custom($post->ID);
?>
    <div id="mainContent">
		<div id="content">
			<div id="main">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
						
						<h1 class="pageTitle"><?php the_title();?></h1>
						<div class="article">
							<div class="post">
								<?php echo the_content();?>
							</div>
							<?php //comments_template(); ?>
							 <div class="clear"></div>
						</div>
      			  <?php endwhile; endif;?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>