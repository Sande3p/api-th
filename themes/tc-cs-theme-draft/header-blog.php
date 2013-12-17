<?php
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

wp_title ( '', true, 'right' );

// Add the blog description for the home/front page.
$site_description = get_bloginfo ( 'description', 'display' );
if ($site_description && (is_home () || is_front_page ()))
	echo " | $site_description";
?></title>
	<?php wp_head(); ?>

    <!-- Main CSS -->
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/layout_basic.css" />
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/layout_blog.css" />
	<?php get_template_part('header.assets'); ?>
   
  </head>
<body id="blog">
	<header id="header"> 
        <?php
			get_template_part ( 'top-nav' );
		?>
		<div class="headerLead">
			<div class="container">
				<div class="banner">	
			<?php
			$blog = get_page_by_path ( 'blog', OBJECT, 'page' );
			echo get_the_post_thumbnail ( $blog->ID, 'full' );
			?>	
			<a class="learnMore" href="#">Learn More</a>
				</div>
				<?php 
				// Get menu object
				$nav_menu = wp_get_nav_menu_object ( 'blog_menu' );
				?>
				<nav class="subNav <?php echo 'count-'. $nav_menu->count;?>">
				<?php
				$catObj = get_category_by_slug('blog'); 
				$catId = $catObj->term_id;
				$args = array(
					'type'                     => 'blog',
					'child_of'                 => $catId,
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 0,
					'taxonomy'                 => 'category'
				); 
				$arrCategories = get_categories( $args );
					if($arrCategories!=null) :
				?>
					<div class="menu-blog_menu-container">
						<ul id="menu-blog_menu" class="menu">
				<?php
					foreach($arrCategories as $key=>$value) :
						$categoryLink = get_bloginfo("wpurl")."/blog/".$value->slug;
				?>
							<li id="menu-item-<?php echo $value->term_id;?>" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-<?php echo $value->term_id;?>"><a href="<?php echo $categoryLink;?>"><?php echo $value->name;?></a></li>
				<?php
					endforeach;
				?>	
					</ul>
				</div>
				<?php endif; ?>
			</nav>
				<div class="search">
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
				</div>
			</div>
			<!-- /.container -->
		</div>
		<!-- /.leadHead -->

	</header>
	<!-- End of #header -->