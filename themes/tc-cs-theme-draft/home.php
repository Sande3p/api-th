<?php
/*
 * Template Name: Home
*/

?>
<?php 
get_header('home');
global $isHome;
$isHome=true;
$values = get_post_custom($post->ID);
$page = get_page_by_title('Home');
$homeId = $page->ID;
$salesPage = get_page_by_title('Pricing');
$salesId = $salesPage->ID;
?>
<div id="main" class="mainHome">
	<div class="graySectoin">
		<div class="mask">
			<div class="twoCols">
				<div class="tcCommunity">
							<div class="boxBottom">
								<div class="boxCon">
									<div class="communityWorld">
										<p class="desc fontGray">
											<span>The TopCoder Community </span>is<br /> <span class="memberCount"> ---,--- </span> strong.
										<p class="tcBranding fontGray">Design. Development. Big Data.</p>
										<p class="joinRow">
											<a class="redBigBtn" href="javascript:;" id="joinNow"> <span class="buttonMask"><span class="text">Join Topcoder</span> </span>
											</a>
										</p>
										<p class="fontGray tagText">We Design. We Build. We Solve.</p>
									</div>
								</div>
							</div>
				</div>			
				<!-- /.tcCommunity -->
				
				
				<div class="openInnovation">
							<div class="gradient">
								<p class="desc">
									On-Demand <span>Open Innovation</span>
								</p>
								<div class="listCon fontGray">
									<p>
										<span class="focused">Gain</span> access to incredible technology talent
									</p>
									<p>
										<span class="focused">Increase</span> your speed to market
									</p>
									<p>
										<span class="focused">Create</span> more innovative digital assets
									</p>
								</div>
								<!-- /.listCon -->
								<div class="videos">
									<?php 
									$vid1 = get_post_meta( $homeId, "Open Innovation Video 1", true);
									$vid2 = get_post_meta( $homeId, "Open Innovation Video 2", true);
									?>
									
									<div class="ltVideo">
										<div class="vidFrame">
											<a href="javascript:openVideoandQuestionnaire('4QVVQdaXnYo')" class="play">Watch the video</a>
											<p class="vidDesc">What can I create on TopCoder?</p>
										</div>
									</div>
									<div class="rtVideo">
										<div class="vidFrame">
											 <a href="javascript:openVideoandQuestionnaire('p2O8pulK5P8')" class="play">Watch the video</a>
											<p class="vidDesc">What is the TopCoder Platform?</p>
										</div>
									</div>
								</div>
								<!-- /videos -->
								<p class="btns">
									<span class="btnGroup"> <span class="or">or</span> <a class="redBigBtn greenBigBtn" target="_blank" href="<?php echo get_post_meta( $salesId, "URL talk sales", true  );?>"><span class="text">Talk with Sales </span> </a> 
									<a target="_blank" class="redBigBtn btnAlt greenBigBtn" href="<?php echo esc_url( get_permalink( get_page_by_title( 'Pricing' ) ) ); ?>"> <span class="buttonMask"><span class="text">Editions &amp; Pricing</span> </span>
									</a>
									</span>
								</p>
							</div>
				</div>
				
				<!-- /.openInnovation -->
			</div>
			<!-- /.twoCols -->
		</div>
		<!-- /.mask -->
	</div>	
		<div class="tcPublications">
			<div class="mask">
				<ul>
					<?php 
					query_posts(array(
							'post_type' => 'interactive',
							'orderby' => 'date',
							'posts_per_page' => 3
					));
					$count = 0;
					?>
					<?php if (have_posts()) : while (have_posts()) : the_post();
					$pid = get_the_ID();
					$thumb = get_post_meta( $pid, "Thumbnail", true  );
					$thumb = wp_get_attachment_url( $thumb );
					$link = get_post_meta( $pid, "Link", true  );
					$btnTxt = get_post_meta( $pid, "BtnText", true  );
					?>
					<li class="valueCreation">
						<div class="wrap">
							<div class="imgWrap">
								<a href="<?php echo $link;?>"><img alt="<?php echo get_the_title(); ?>" src="<?php echo $thumb; ?>" /> </a>
							</div>
							<h2>
								<a href=" <?php echo $link;?>"><?php echo get_the_title(); ?> </a>
							</h2>
							<p class="desc"><?php echo get_the_content();?></p>
							<p class="btns">
								<a class=" blueBtn" href=" <?php echo $link;?>"> <span class="buttonMask"><span class="text"><?php echo $btnTxt;?> </span> </span>
								</a>
							</p>
						</div>
					</li>
					<?php 
					$count +=1;
					endwhile; endif;
					wp_reset_query();
					?>
				</ul>
			</div>
		</div>
		<!-- /.tcPublications -->
		<div class="tcTracks">
			<div class="mask">
				<div class="corner cTL"></div>
				<div class="corner cTR"></div>
				<div class="corner cBL"></div>
				<div class="corner cBR"></div>
				<h3>On the Topcoder Platform you can build all of these digital assets and more, on demand:</h3>
				<ul class="trackList">
					<?php 
					query_posts(array(
							'post_type' => 'featured-platform',
							'orderby' => 'date', 'order' => 'ASC',
							'posts_per_page' => 50
					));
					$count = 0;
					?>
					<?php if (have_posts()) : while (have_posts()) : the_post();
					$pid = get_the_ID();
					$thumb = get_post_meta( $pid, "Feature icons", true  );
					$thumb = wp_get_attachment_url( $thumb );
					if ( $thumb == '' ){ 
						$thumb = get_bloginfo( 'stylesheet_directory' ). '/i/icon-'. $post->post_name .'.png';
					}
					?>
					<li class="<?php if($count % 3 ==0 ){ echo "leftMost"; } ?>"><div class="platform">
							<div class="imgWrap">
								<img alt="<?php echo get_the_title(); ?>" src="<?php echo $thumb ?>" /> 
							</div>
							<div class="desc">
								<span class="type"><?php echo get_the_title(); ?> </span>
								<p>
									<?php echo get_post_meta( $pid, "Descriptions", true  ); ?>
								</p>
							</div>
						</div> <!-- /.platform --></li>
					<?php 
					$count +=1;
					endwhile; endif;
					wp_reset_query();
					?>
				</ul>
				<!-- /.trackList -->
				<footer>
					<p>
						<span>The fastest way to develop innovative digital assets.</span><br /> A powerful enterprise ready platform the moment you begin.
					</p>
					<input type="hidden" class="platformImg" /> <a class="greenBtn" href="<?php echo esc_url( get_permalink( get_page_by_title( 'Pricing' ) ) ); ?>"> <span class="buttonMask"><span
							class="text">See All Editions &amp; Pricing</span> </span>
					</a>
				</footer>
				<!-- /.footer -->
			</div>
		</div>
	<!-- /.tcTracks -->
	<div class="grayRibbon">
		<h2>Discover what enterprises and organizations are creating on TopCoder:</h2>
	</div>
	<div class="tcQuotes">
		<div class="mask">
			<ul class="quoteList">
				<?php 
				query_posts(array(
						'post_type' => 'quotes',
						'orderby' => 'menu_order',
						'order' =>'ASC'
				));
				$count = 0;

				if (have_posts()) : while (have_posts()) : the_post();
				$pid = get_the_ID();
				$thumb = get_post_meta( $pid, "Image", true  );
				$thumb = wp_get_attachment_url( $thumb );				
				?>
				<li class="<?php if($count %3 ==0){ echo "left"; };?> "><div class="quote">
						<div class="boxRt">
							<div class="boxMid">
								<div class="imgWrap">
									<img alt="" src="<?php echo $thumb?>" />
								</div>
								<p class="quoteTxt">
									"<?php echo get_post_meta( $pid, "Quote", true  );?>"
								</p>
								<p class="author">
									- <?php echo get_post_meta( $pid, "Author", true  );?>
								</p>
							</div>
						</div>
					</div></li>
				<!-- /.quote -->
				<?php 
				$count +=1;
				endwhile; endif;
				wp_reset_query();
				?>
			</ul>
			<div class="btns">
				<a class="redBtn" href="case-studies"> <span class="buttonMask"><span class="text">All Clients</span> </span>
				</a><a href="case-studies" class="clientStories"></a>
			</div>
		</div>
	</div>
	<!-- /.tcQuotes -->
</div>
<!-- /.main -->
<?php get_footer(); ?>