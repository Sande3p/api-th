<?php 
/*
 * Template Name: Front 
 */
    get_header();
    
    $values = get_post_custom($post->ID);
?>
	
    <div id="mainContent">
		<div id="content">
			<div id="main">
					<?php $paged=(get_query_var('paged'))?get_query_var('paged'):1;
					$postPerPage = 10;
					query_posts(array(
							'posts_per_page'=>-1,
							'post_type'=>'post'
						));
					global $wp_query;
					
					$rowCount = $wp_query->post_count;
					wp_reset_query();
					query_posts(array(
							'posts_per_page'=>$postPerPage,
							'post_type'=>'post',
							'paged'=>$paged
						));
					
					//print_r($wp_query);
					if($category!="") {
						query_posts(array(
							'posts_per_page'=>$postPerPage,
							'cat'=>$category,
							'paged'=>$paged
						));
					}

					$current_page = ( $paged ? $paged : '1' );
					$current_min = ( $paged > 1 ?  ($paged-1)*$postPerPage + 1 : '1' );
					$current_min = $rowCount > 0 ? $current_min : 0;
					$current_max = ($paged * $postPerPage) > $rowCount ? $rowCount : ($paged * $postPerPage);
					$u_time = get_the_time('U');
					
					?>
				   

				   <div class="filter">
						<div class="pageNumber">
							<div class="pageBox">
								<?php echo get_pagination(5); ?>
							</div>
						</div>
						<a class="rss" href="<?php echo wp_get_rss_permalink($category);?>"></a>
						<span class="rightPage">
							<?php
							echo 'Displaying <strong>'.$current_min . '</strong> - <strong>' . $current_max . '</strong> of <strong>' .$rowCount.'</strong>';
							
							
							?>  |
						</span>
				   </div>
								<?php //if($rowCount>0) : ?>
								<?php if(have_posts()):while(have_posts()): the_post();?>

								<h3><?php the_title();?></h3>
								<?php
									$thumbnailVal = get_post_meta($post->ID,"Thumbnail",true);
									$thumbnailImg = wp_get_attachment_image_src( $thumbnailVal, "medium" );
									$thumbnailImg = $thumbnailImg[0];
									if($thumbnailImg!=null) :
								?>
									<div class="listThumbnail"><img src="<?php echo $thumbnailImg;?>" alt="" width="200" height="160" /></div>
								<?php endif; ?>
								<div class="article">
									<span class="dateAuthor"><?php the_date();?></span>
									<?php  the_excerpt(); ?>
									<a href='<?php echo the_permalink();?>' class="readmoreLink">Read More</a>
									<div class="filterBT">
									 

									</div>
									<!--End filterBT-->
									 <div class="clear"></div>
								</div>
								<?php endwhile; endif;?>
								<?php //endif; ?>
				  <div class="filter">
						 <div class="pageNumber">
							  <div class="pageBox">
								  <?php echo get_pagination(5); ?>
							  </div>
						  </div>
						<?php
							$archivePageId = get_page_by_path("aboutus/archive")->ID;
							$archivePermalink = get_permalink( $archivePageId  );
						?>
						<span></span>				  
						<span class="rightPage">
							<?php
							echo 'Displaying <strong>'.$current_min . '</strong> - <strong>' . $current_max . '</strong> of <strong>' .$rowCount.'</strong>';
							
							
							?>  |
						</span>
				   </div>
				   <?php wp_reset_query();?>
				  
				<div class="clear"></div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>