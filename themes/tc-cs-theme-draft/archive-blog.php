<?php 
/*
 * Template Name: Archive Blog
 */
    get_header('blog');
    
    $values = get_post_custom($post->ID);
?>
	
    <div id="content">
        <div class="container">
            <div class="mainRail">
               
               
				<?php
                // fetch blog items from database
                global $wpdb;
				
				$slug = get_query_var('slug');
				$isCategory = false;
				if( is_category($slug) ) 
					$isCategory = true;
				
				$query;
				if( $isCategory==false ) {
					$catObj = get_category_by_slug($slug); 
					$catId = $catObj->term_id;
	  
					$query = array(
						'post_type' => 'blog',
						'cat' => $catId
					);
				}
				else {
					$postId = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '$slug'");
					$query = array(
						'post_type' => 'blog',
						'p' => $postId
					);
				}
                query_posts($query);
                
                $total_pages = $wp_query->max_num_pages;
                $total_posts = $wp_query->found_posts;
                $displaying_posts = $wp_query->post_count;
                
                if (have_posts() ): while (have_posts()): the_post();
                    $blog_values = get_post_custom($post->ID);
                ?>
                <section>
                    <h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="meta"><!--<?php the_time('F d, Y'); ?><span>|</span> -->By <?php the_author_posts_link();?></div>
                    <figure>
                         <?php  echo get_tc_thumbnail($post->ID, 'thumbnail'); ?>
                        <figcaption> 
                            <?php echo get_the_excerpt();  ?>
                            <a href="<?php echo get_permalink(); ?>">Read More</a>
                        </figcaption>
                    </figure>
                </section>
                <?php
                endwhile; endif;
                wp_reset_query();
                ?>
                
				<?php if(function_exists('wp_paginate')) {
						wp_paginate();
				} ?>
							
				&nbsp;
            </div><!-- End of .mainRail -->
            <aside class="rightRail">
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
				<div class="commonWidget categoriesWidg posts">
					<header>
						<ul>
							<li class="current">Categories</li>
						</ul>
					</header>
					<div class="content">

						<ul class="categoryList">
			<?php
					foreach($arrCategories as $key=>$value) :
						$categoryLink = get_bloginfo("wpurl")."/blog/".$value->slug;
			?>			
								<li class="cat-item cat-item-<?php echo $value->term_id;?>"><a title="" href="<?php echo $categoryLink;?>"><?php echo $value->name;?></a> <a title="RSS" href="javascript:;"><img title="RSS" alt="RSS" src="<?php echo get_bloginfo("stylesheet_directory")."/i/rss-small.png"?>"></a>
							</li>
			<?php 	endforeach; ?>
						</ul>
					</div>


					<div class="corner tl"></div>
					<div class="corner tr"></div>
					<div class="corner bl"></div>
					<div class="corner br"></div>
				</div>
			<?php endif; ?>	
                <?php
                      dynamic_sidebar('Blog page right sidebar');
                ?>				
            </aside><!-- End of .rightRail -->
            <div class="clear"></div>
        </div><!-- End of .contentInner -->
    </div><!-- End of #content -->	
	
	

<?php get_footer(); ?>
