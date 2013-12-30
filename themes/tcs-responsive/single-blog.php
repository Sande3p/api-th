<?php
/**
 * Template Name: Single Blog
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

$userkey = get_option ( 'api_user_key' );
$siteURL = site_url ();

$blogPageTitle = get_option("blog_page_title") == "" ? "Welcome to the TopCoder-CloudSpokes Blog" : get_option("blog_page_title");
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
		
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $postId ), 'single-post-thumbnail' );
		if($image!=null) $imageUrl = $image[0];
		else $imageUrl = get_bloginfo('stylesheet_directory')."/i/story-side-pic.png";
		
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
	
		$categories = get_the_category();
		$arrCategoriesId;
		if($categories!=null){
			foreach($categories as $key=>$category) {
				$arrCategoriesId[] = $category->term_id;
			}
		}	
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
							$activeMenuId=null;
							if($items!=null)
							foreach($items as $menu) :
								$active="";
								if($activeMenuId==null&&$arrCategoriesId!=null) {
									$key = in_array($menu->object_id, $arrCategoriesId);
									$active="";
									if($key==true) {
										$active = "active";
										$activeMenuId = $menu->object_id;
									}
								}
						?>
							<a href="<?php echo $menu->url;?>" class="<?php echo $active;?>"><?php echo $menu->title;?></a>
						<?php endforeach; ?>
						</div>
						<?php
							$activeMenuObj = get_category( $activeMenuId );
							$categories = $activeMenuObj!=null ? $activeMenuObj->cat_name : "Categories";
						?>
						<ul class="blogMenuMobile">
							<div class="default">Categories<span class="arrow"></span></div>
							<div class="current"><?php echo $categories;?><span class="arrow"></span></div>
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
						<section class="singleContent">
						
							<h1 class="blogTitle"><?php the_title();?></h1>
							
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
											if(strtolower($category->name)!=BLOG) {
												$categoryLink = get_category_link( $category->term_id );
												$categoryName = $category->name;
												$output .= '<a href="'.$categoryLink.'" title="View all posts in '.$categoryName.'">'.$categoryName.'</a>'.$separator;
											}
										}
									}
									$output = substr($output, 0, strlen($output)-strlen($separator));
									echo $output;
								?>									
								</div>
							</div>
							<!-- Blog Desc End -->
							
							<!-- content wrapper -->
							<div class="contentWrapper pageContent">
								<?php the_content();?>
							</div>
							<!-- content wrapper end -->
							
							<!-- share via -->
							<div class="shareVia shareViaBig">
								<span>Share via : </span>
								<a href="<?php echo $email_article;?>" class="shareButtonBig email"></a>
								<a href="<?php echo $fbShare;?>" class="shareButtonBig fb"></a>
								<a href="<?php echo $twitterShare;?>" class="shareButtonBig twitter"></a>
								<a href="<?php echo $gplusShare;?>" class="shareButtonBig gplus"></a>
							</div>
							<!-- share via End -->
						</section>
						
						<?php
							$tags = get_the_tags();
							if($tags!=null):
						?>
						<!-- Post Tags -->
						<div class="postTags">
							Tags : <?php
										$separator = ', ';
										$output = '';
										if($tags){
											foreach($tags as $key=>$tag) {
												$output .= '<a href="'.get_tag_link( $tag->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $tag->name ) ) . '">'.$tag->name.'</a>'.$separator;
											}
										}
										echo trim($output, $separator);
									?>	
						</div>
						<!-- Post Tags End -->
	<?php endif; ?>
						
						<?php
							$prevPostObj = get_previous_post();
							$nextPostObj = get_next_post();
							if( $prevPostObj!=null || $nextPostObj!=null ) :
						?>
							<!-- Post Nav -->
							<div class="postNavWrapper">
							<?php if($prevPostObj!=null) :?>
								<div class="postNavBox leftNav">
									<a href="<?php echo get_post_permalink($prevPostObj->ID);?>" class="blueLink"><?php echo $prevPostObj->post_title;?></a>
									<a class="navLink prev" href="<?php echo get_post_permalink($prevPostObj->ID);?>">Prev</a>
								</div>
							<?php endif; ?>
							
							<?php if($nextPostObj!=null) :?>
								<div class="postNavBox rightNav">
									<a href="<?php echo get_post_permalink($nextPostObj->ID);?>" class="blueLink"><?php echo $nextPostObj->post_title;?></a>
									<a class="navLink next" href="<?php echo get_post_permalink($nextPostObj->ID);?>">Next</a>
								</div>
							<?php endif; ?>
							</div>
							<!-- Post Nav -->
						<?php endif; ?>
						
					<?php endif; wp_reset_query();?>
						
					
						<!-- /.pageContent -->
						<?php comments_template(); ?>
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