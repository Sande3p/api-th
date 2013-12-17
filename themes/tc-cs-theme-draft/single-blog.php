<?php
/*
 * Template Name: Single Blog
 */

?>
<?php 
    get_header('blog');
    
    $values = get_post_custom($post->ID);
?>
	
    <div id="content" class="detailPage"> 
        <div class="container">
            <div class="mainRail">
                <?php
                if (have_posts()): while (have_posts()): the_post();
                    setPostViews($post->ID);
                ?>
                <article>
                    <h1><?php the_title(); ?></h1>
                    <div class="meta">
                        <div class="left"><!--Posted by <?php the_author_posts_link(); ?> on <?php the_time('F d, Y  @ g:i a'); ?> --></div>                       
                    </div>
                    <div class="socialPanel">
                        <div class="panelR">
                            <div class="panelM"> 
                                <?php sharethis_button(); ?>
                            </div>
                        </div>    
                    </div>
                    <?php echo get_the_content(); ?>
                    <div class="tags">
                        <?php echo get_the_tag_list('<label>Tags:</label>',', ',''); ?>
                    </div>
                    <div class="navigate">
                        <?php
                        // get previous post
                        $prev_post = get_adjacent_post(false, '', true);
                        if (!empty($prev_post)):
                        ?>
                        <div class="prev">
                            <a href="<?php echo get_permalink($prev_post->ID); ?>" class="btn"></a>
                            <div>
                                <span>Previous</span>
                                <a href="<?php echo get_permalink($prev_post->ID); ?>"><?php echo get_the_title($prev_post->ID); ?></a>
                            </div>
                        </div>
                        <?php
                        endif; 
                        
                        $next_post = get_adjacent_post(false, '', false);
                        if (!empty($next_post)):
                        ?>
                        <div class="next">
                            <a href="<?php echo get_permalink($next_post->ID); ?>" class="btn"></a>
                            <div>
                                <span>Next</span>
                                <a href="<?php echo get_permalink($next_post->ID); ?>"><?php echo get_the_title($next_post->ID); ?></a>
                            </div>
                        </div>
                        <?php
                        endif;
                        ?>
                    </div>
                    <div class="commentBox">
                        <?php comments_template(); ?>
						<!--
						<header>
                             <h2>Add New Comment</h2> 
                             <a class="redBtn" href="<?php wp_login_url(get_permalink($post->ID));  ?>">
                                 <span class="buttonMask"><span class="text">Login</span></span>
                            </a>
                        </header>
                        <?php do_action('oa_social_login'); ?>
                        <div class="addComment">
                            <a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/i/avatar.png" alt="" /></a>
                            <div class="textarea">
                                <textarea cols="10" rows="10" data-placeholder="Type your comments here" ></textarea> 
                                <div class="corner tl"></div>
                                <div class="corner tr"></div>
                                <div class="corner bl"></div>
                                <div class="corner br"></div>
                            </div>
                        </div>
                        <div class="comments">
                            <?php
                                   wp_list_comments();
                            ?>
                        </div>
                       <div class="reactions">
                            <h6>Reactions</h6>
                            <a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/i/avatar.png" alt="" /></a>
                            <a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/i/avatar.png" alt="" /></a>
                            <a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/i/avatar.png" alt="" /></a>
                        </div>
						-->
                    </div>
                </article>
                <?php
                endwhile; endif;
                ?>
            </div><!-- End of .mainRail -->
            <aside class="rightRail">
                <?php
                                dynamic_sidebar('Blog page right sidebar');
                ?>        
            </aside><!-- End of .rightRail -->
            <div class="clear"></div>
        </div><!-- End of .contentInner -->
    </div><!-- End of #content -->
	<!-- bugr 8816 -->
	
	
	<?php
	// read ab_testing,
	$experiment_ID = 5; // experiment ID
	$type = abtest_get_experiment($experiment_ID);
	
	switch ( $type ):
		case "ebook":
			$classModal = "ebookModal";
			$actionModal = "subscribe-ebook";
		break;
		case "blog":
			$classModal = "blogModal";
			$actionModal = "subscribe-blog";
		break;
	endswitch;
	
	?>	
	


<?php get_footer('blog'); ?>