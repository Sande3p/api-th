<?php
/**
 * Template Name: Page Blog
 */
?>
<?php 

get_header ();
/**
 * Enqueue scripts and styles exclusive to this template/module
 */

wp_register_style ( 'blog-base.css',  get_bloginfo( 'stylesheet_directory' ).'/css/blog-base.css');
wp_register_style ( 'blog.css',  get_bloginfo( 'stylesheet_directory' ).'/css/blog.css');
wp_register_style ( 'blog-responsive.css',  get_bloginfo( 'stylesheet_directory' ).'/css/blog-responsive.css');
wp_enqueue_style ( 'blog-base.css' );	
wp_enqueue_style ( 'blog.css' );
wp_enqueue_style ( 'blog-responsive.css' );


$script = 'blog.js';
wp_register_script ( $script, get_bloginfo ( 'stylesheet_directory' ) . '/js/'.$script );
wp_enqueue_script ( $script );
?>
<?php

$values = get_post_custom ( $post->ID );

$currUrl = curPageURL();
$userkey = get_option ( 'api_user_key' );
$currPage = (int) $_GET['pageNo'] != "" ? (int) $_GET['pageNo'] : 1;
$postPerPage = get_option("posts_per_page") == "" ? 5 : get_option("posts_per_page");
$siteURL = site_url ();

$blogPageTitle = get_option("blog_page_title") == "" ? "Welcome to the TopCoder-CloudSpokes Blog" : get_option("blog_page_title");
?>

<script type="text/javascript">
	var siteurl = "<?php bloginfo('siteurl');?>";
	var page = <?php echo $currPage; ?>;
</script>
<div class="content">
	<div id="main">

	<?php
	
	if (have_posts ()) :
		the_post ();
		?>
	<!-- Start Overview Page-->
		
		<!-- page title -->
		<div class="pageTitleWrapper">
			<div class="pageTitle container">
				<h2 class="blogPageTitle"><?php echo $blogPageTitle;?></h2>
				<span class="blogIcon"></span>
			</div>
			<div class="blogCategoryWrapper">
				<div class="container">
					<div class="innerWrapper">
						<div class="blogCategoryMenu">
						<?php
							$items = wp_get_nav_menu_items( BLOG );
							if($items!=null)
							foreach($items as $menu) :
								$active = $catId == $menu->object_id ? "active" : "";
						?>
							<a href="<?php echo $menu->url;?>" class="<?php echo $active;?>"><?php echo $menu->title;?></a>
						<?php endforeach; ?>
						</div>
						<ul class="blogMenuMobile">
							<div class="default">Categories<span class="arrow"></span></div>
							<div class="current">Categories<span class="arrow"></span></div>
							<?php
								if($items!=null)
								foreach($items as $menu) :
							?>
								<li><a href="<?php echo $menu->url;?>"><?php echo $menu->title;?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- page title end -->




		<article id="mainContent" class="splitLayout overviewPage">
			<div class="container blogPageMainContent">
				<div class="rightSplit  grid-3-3">
					<div class="mainStream grid-2-3">
						<section>
						<div class="blogsWrapper">
							<input type="hidden" class="pageNo" value="<?php echo $currPage; ?>" />
							<input type="hidden" class="catId" value="" />
						<?php 
							wp_reset_query();
							$args = "post_type=".BLOG;
							$args .= "&order=DESC";
							if($showAll=="") {
								$args .= "&posts_per_page=".$postPerPage;
								$args .= "&paged=$currPage";
							}
							
							query_posts($args);
							if ( have_posts() ) :
								while ( have_posts() ) : 
									the_post();
									$postId = $post->ID;
									$image = wp_get_attachment_image_src( get_post_thumbnail_id( $postId ), 'blog-thumb' );
									if($image!=null) $imageUrl = $image[0];
									else $imageUrl = get_bloginfo('stylesheet_directory')."/i/blog-thumb-placeholder.png";
									
									$imageMobile = wp_get_attachment_image_src( get_post_thumbnail_id( $postId ), 'blog-thumb' );
									if($imageMobile!=null) $imageUrlMobile = $imageMobile[0];
									else $imageUrlMobile = get_bloginfo('stylesheet_directory')."/i/story-side-pic.png";
									
									$dateObj = DateTime::createFromFormat('Y-m-d H:i:s', $post->post_date);
									$dateStr = $dateObj->format('F j, Y');
									
									$twitterText = urlencode(wrap_content_strip_html(wpautop($post->post_content), 130, true,'\n\r',''));
									$title = htmlspecialchars($post->post_title);
									$subject = htmlspecialchars(get_bloginfo('name')).' : '.$title;
									$body = htmlspecialchars($post->post_content);
									$emailBody = get_permalink();
									$email_article = 'mailto:?subject='.rawurlencode($subject).'&amp;body='.$emailBody;
									$twitterShare = "http://twitter.com/home?status=".$twitterText;
									$fbShare = "http://www.facebook.com/sharer/sharer.php?s=100&amp;p[url]=".get_permalink()."&amp;p[images][0]=".$imageUrl."&amp;p[title]=".get_the_title()."&amp;p[summary]=".$twitterText;
									$gplusShare = "https://plus.google.com/share?url=".get_permalink();
									
									$authorObj = get_user_by("id",$post->post_author);
									$authorLink = get_bloginfo("wpurl")."/author/".$authorObj->user_nicename;
						?>		
							<!-- Blog Item -->
							<div class="blogItem">
								<!-- Thumb place holder -->
								<div class="mobiThumbPlaceholder">
									<a href="<?php the_permalink();?>"><img src="<?php echo $imageUrlMobile;?>" width="300" height="160" /></a>
								</div>
								<!-- Thumb place holder end -->
								<a href="<?php the_permalink();?>" class="blogTitle blueLink"><?php the_title();?></a>
								
								<!-- Blog Desc -->
								<div class="blogDescBox">
									<div class="postDate"><span><?php echo $dateStr;?> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; By:&nbsp;&nbsp;</span></div>
									<div class="postAuthor"><a href="<?php echo $authorLink; ?>" class="author blueLink"><?php the_author();?></a></div>
									<div class="postCategory"><span>In : </span> 
									<?php
										$categories = get_the_category();
										$separator = '<span>, </span>';
										$output = '';
										if($categories){
											foreach($categories as $key=>$category) {
												if(strtolower($category->name)!=BLOG)
													$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
											}
										}
										echo rtrim($output, $separator);
									?>									
									</div>
								</div>
								<!-- Blog Desc End -->
								
								<!-- Blog Right Section -->
								<div class="blogRightSection">
									<!-- Imageplacehoder -->
									<div class="imagePlaceholder">
										<a href="<?php the_permalink();?>"><img src="<?php echo $imageUrl;?>" width="158" height="158" alt=""></img></a>
									</div>
									<!-- Imageplacehoder End -->
									
									<!-- Content Right -->
									<div class="contentRight">
										<div class="excerpt pageContent">
											<?php 
												$excerpt = wrap_content_strip_html(wpautop($post->post_content), 400, true,'\n\r','','<a>');
												echo $excerpt;
											?>
										</div>
										<div class="shareVia">
											<span>Share via : </span>
											<a href="<?php echo $email_article;?>" class="shareButton email"></a>
											<a href="<?php echo $fbShare;?>" class="shareButton fb"></a>
											<a href="<?php echo $twitterShare;?>" class="shareButton twitter"></a>
											<a href="<?php echo $gplusShare;?>" class="shareButton gplus"></a>
										</div>
										<a href="<?php the_permalink();?>" class="continueReading">Continue Reading</a>
									</div>
									<!-- Content Right End -->
									
								</div>
								<!-- Blog Right Section End -->
								
							</div>
							<!-- Blog Item End -->
						<?php 
								endwhile;
							endif;
						?>
						</div>
						<?php
							wp_reset_query();
							$args = "post_type=".BLOG;
							$args .= "&posts_per_page=-1";
							$wpQueryAll = query_posts($args);
							$postCount = count($wpQueryAll);
							
							$prevLink = add_query_arg("pageNo",($currPage-1),$currUrl);
							$nextLink = add_query_arg("pageNo",($currPage+1),$currUrl);
							
							if($postCount > $postPerPage) :
						?>
							<div class="pagingWrapper">
								<?php if($currPage>1) :?><a class="prev" href="<?php echo $prevLink;?>">Older Posts</a><?php endif; ?>
								<?php if( $postCount > ($currPage * $postPerPage)) : ?><a class="next" href="<?php echo $nextLink;?>">Newer Posts</a><?php endif;?>
							</div>
						<?php endif; ?>	
						
							<div class="showMoreWrapper showMoreWrapperMobile">
								<a id="showMoreBlogPost" href="javascript:;" class="btn">Show More</a>
								<span class="morePostLoading">&nbsp;</span>
								<span class="noMorePostExist">No more post exist!</span>
							</div>
							
						</section>
					<?php endif; wp_reset_query();?>
					<!-- /.pageContent -->
					</div>
					
					<!-- /.mainStream -->
					<aside class="sideStream  grid-1-3">
						
						<?php get_sidebar("blog"); ?>
						
					</aside>
					<!-- /.sideStream -->
					
					<div class="clear"></div>
					
				</div>
				<!-- /.rightSplit -->
			</div>
		</article>
		<!-- /#mainContent -->
<?php get_footer(blog); ?>