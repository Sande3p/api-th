<?php 
/*
 * will show posts written by author
 */
    get_header('blog');

?>
	
    <div id="content">
        <div class="contentInner">
            <div class="mainRail">
                <?php
                // fetch blog items from database
                $current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                    'post_type' => 'blog',
                    'paged' => $current_page,
					'post_type' =>array('post','blog','news'),
					'post_status'=>'publish',
                    'author_name' => get_query_var('author_name')
                );
                
                $blog_query = new WP_Query($args);
				$wp_query  = $blog_query ;
                $total_pages = $blog_query->max_num_pages;
                $total_posts = $blog_query->found_posts;
                $displaying_posts = $blog_query->post_count;
                
                if ($blog_query->have_posts() ): while ($blog_query->have_posts()): $blog_query->the_post();
                ?>
                <section>
                    <h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="meta"><?php the_time('F d, Y'); ?><span>|</span>By <?php the_author_posts_link(); ?></div>
                    <figure>
                        <img src="<?php  echo get_featured_img($post); ?>" alt=""/>
                        <figcaption> 
                            <?php the_excerpt();  ?>
                            <a href="<?php echo get_permalink(); ?>">Read More</a>
                        </figcaption>
                    </figure>
                    <!--
                    <div class="social">
                    </div>
                    -->
                </section>
                <?php
                endwhile; endif;
                if(function_exists('wp_paginate')) {
						wp_paginate();
				} ?>
                
            </div><!-- End of .mainRail -->
            <aside class="rightRail">
                <?php
                                        dynamic_sidebar('Author archive page right sidebar');
                ?>
                
            </aside><!-- End of .rightRail -->
            <div class="clear"></div>
        </div><!-- End of .contentInner -->
    </div><!-- End of #content -->

<?php get_footer(); ?>
