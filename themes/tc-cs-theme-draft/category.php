<?php 
/*
 * category template file
 */
    get_header('blog');
    
    $values = get_post_custom($post->ID);
?>
	
    <div id="content">
        <div class="contentInner">
            <div class="mainRail">
                <?php
				$category_id = get_term_by( 'slug', get_query_var('category_name'), 'category' )->term_id;
				// Get the URL of this category
				$category_link = get_category_link( $category_id );
				?>
				<a class="feed" href="<?php echo esc_url( add_query_arg("feed","rss",$category_link));?>">Subscribe</a>
				
				<?php
                    // get news from database
                    $current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array(
                         'paged' => $current_page,
						 'post_type' =>array('post','blog','pressroom'),
						 'post_status'=>'publish',
						 'category_name' => get_query_var('category_name')
                    );
                    
                    $news = new WP_Query($args);
                    $total_pages = $news->max_num_pages;
                    $total_posts = $news->found_posts;
                    $displaying_posts = $news->post_count;
                    
                    if ($news->have_posts()): while ($news->have_posts()): $news->the_post();
                    setPostViews($post->ID);
                ?>
				  <section>
                    <h2><a href="<?php echo get_permalink($post->ID); ?>"><?php the_title(); ?></a></h2>
                    <div class="meta"><?php the_time('F d, Y'); ?><span>|</span>By <?php the_author_posts_link(); ?><span>|</span>In <?php the_category(', '); ?></div> 
                    <figure>
                        <div class="imgBox">
                            <img src="<?php  echo get_featured_img($post); ?>" alt=""/>
                        </div>    
                        <figcaption>
                            <p><?php the_excerpt(); ?></p>
                            <a href="<?php echo get_permalink($post->ID); ?>">Read More</a>
                        </figcaption>
                    </figure>
                    <div class="social">
                        <?php sharethis_button(); ?>
                    </div>
                </section>
                <?php endwhile; endif; ?>
                <?php if(function_exists('wp_paginate')) {
						wp_paginate();
				} ?>
            </div><!-- End of .mainRail -->
            <aside class="rightRail">
                <?php dynamic_sidebar('News front page right sidebar'); ?>
            </aside><!-- End of .rightRail -->
            <div class="clear"></div>
         </div><!-- End of .contentInner -->
    </div><!-- End of #content -->


<?php get_footer(); ?>