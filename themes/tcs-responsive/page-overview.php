<?php
/**
 * Template Name: Overview template
 */
?>
<?php

get_header ();

$values = get_post_custom ( $post->ID );

$userkey = get_option ( 'api_user_key' );
$siteURL = site_url ();
?>

<script type="text/javascript">
	var siteurl = "<?php bloginfo('siteurl');?>";	
</script>
<div class="content">
	<div id="main">

	<?php
	
	if (have_posts ()) :
		the_post ();
		$quote = get_post_meta ( $post->ID, "Quote", true );
		$qAuthor = get_post_meta ( $post->ID, "Quote author", true );
		?>
	<!-- Start Overview Page-->
		<div class="pageTitleWrapper">
			<div class="pageTitle container">
				<h2 class="overviewPageTitle"><?php the_title();?></h2>
			</div>
		</div>




		<article id="mainContent" class="splitLayout overviewPage">
			<div class="container">
				<div class="rightSplit  grid-3-3">
					<div class="mainStream grid-2-3">
						
						<section class="pageContent">
						<?php the_content();?>
						</section>
					<?php endif; wp_reset_query();?>
					
					
						<!-- /.pageContent -->

					</div>
					<!-- /.mainStream -->
					<aside class="sideStream  grid-1-3">
						<div class="sideFindRelatedContent">
							<h3>Find Related Content</h3>

							<ul class="relatedContentList">
							<?php
							// for use in the loop, list 4 post titles related to first tag on current post
							$tags = wp_get_post_tags ( $post->ID );
							if ($tags) {
								$first_tag = $tags [0]->term_id;
								$args = array (
										'tag__in' => array (
												$first_tag 
										),
										'post__not_in' => array (
												$post->ID 
										),
										'post_type' => array (
												'post',
												'page' 
										),
										'posts_per_page' => 4,
										'ignore_sticky_posts' => 1 
								);
								$related_query = new WP_Query ( $args );
								if ($related_query->have_posts ()) {
									while ( $related_query->have_posts () ) :
										$related_query->the_post ();
										
										$pid = $post->ID;
										$thumbId = get_post_thumbnail_id ( $pid );
										$iurl = wp_get_attachment_url ( $thumbId );
										?>
									<li><a class="contentLink" href="<?php the_permalink() ?>">
										<img class="contentThumb" src="<?php echo $iurl;?>" alt="<?php the_title(); ?>">
										<?php the_title(); ?>
									</a> <span class="contentBrief"><?php echo custom_excerpt(10) ?></span></li>
									
							<?php
									endwhile
									;
								}
								wp_reset_query ();
							}
							?>
								</ul>
						</div>
						<!-- /.sideFindRelatedContent -->
						<?php if($quote != ""):?>
						<div class="sideQuote">
							<p class="quoteTxt">“<?php echo $quote;?>”</p>
							<p class="quoterName"><?php echo $qAuthor;?></p>
						</div>						
						<!-- /.sideQuote -->
						<?php endif;?>

						<div class="sideMostRecentChallenges">
							<h3>Most Recent Challenges</h3>
							<?php 
								$devContest= get_most_recent_contest('develop');
								$devContest = $devContest->data[0];
								$designContest = get_most_recent_contest('design');		
								$designContest = $designContest->data[0];
							?>
							<ul>									
								<li><a class="contestName contestType1" href="<?php bloginfo('wpurl');?>/challenge-details/<?php echo $devContest->challengeId?>">
										<i></i><?php echo $devContest->challengeName ?>
									</a></li>
								<li class="alt"><a class="contestName contestType2" href="<?php bloginfo('wpurl');?>/challenge-details/<?php echo $designContest->challengeId?>/?type=design">
										<i></i><?php echo $designContest->challengeName ?>
									</a></li>								
							</ul>
						</div>
						<!-- /.sideMostRecentChallenges -->						
					</aside>
					<!-- /.sideStream -->
					<div class="clear"></div>
				</div>
				<!-- /.rightSplit -->
			</div>
		</article>
		<!-- /#mainContent -->
<?php get_footer(); ?>