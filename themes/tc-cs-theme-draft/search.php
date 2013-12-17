<?php 
/*
 * search results page
 */
get_header('blog');

?>
	
    <div id="content">
        <div class="container">
            <div class="mainRail">
                <?php
                // fetch blog items from database
                $current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                    'post_type' => $_GET['type'],
                    'paged' => $current_page,
                    's' => get_query_var('s')
                );
                
                $blog_query = new WP_Query($args);

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
                            <?php echo get_the_excerpt();  ?>
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
                wp_reset_query();
                ?>
                <div class="pagination"> 
                    <div class="pagers">
                        <span>Displaying <?php $start = ($current_page-1) * $posts_per_page +1; $end = $start+$displaying_posts-1; echo "$start - $end";?> of <?php echo $total_posts; ?></span>
                        <a class="prev <?php if ($current_page <= 1) echo 'disabled'; ?>" href="<?php if ($current_page > 1) echo get_pagenum_link($current_page-1); else echo 'javascript:;'; ?>"><i></i></a>   
                        <?php 
                        for ($i = 1; $i <= $total_pages; $i++):
                        ?>   
                        <a href="<?php echo $current_page!=$i?get_pagenum_link($i):'javascript:;'; ?>" class="<?php echo $current_page == $i ? 'current':''; ?>"><?php echo $i; ?></a>
                        <?php
                        endfor;
                        ?>
                        <a class="next <?php if ($current_page >= $total_pages) echo 'disabled'; ?>" href="<?php if ($current_page < $total_pages) echo get_pagenum_link($current_page+1); else echo 'javascript:;'; ?>"><i></i></a>
                    </div>
                </div>
            </div><!-- End of .mainRail -->
            <aside class="rightRail">
                <?php
                       dynamic_sidebar('Search results page right sidebar');
                ?>
                
            </aside><!-- End of .rightRail -->
            <div class="clear"></div>
        </div><!-- End of .contentInner -->
    </div><!-- End of #content -->

<?php get_footer(); ?>

