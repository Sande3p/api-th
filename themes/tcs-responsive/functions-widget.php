<?php
	add_action ( 'widgets_init', 'themes_load_widgets' );
	/* Register the widget */
	function themes_load_widgets() {
		register_widget ( 'Search_blog_widget' );
		register_widget ( 'Blog_category_widget' );
		register_widget ( 'Popular_post_widget' );
		register_widget ( 'Subscribe_widget' );
		register_widget ( 'Download_banner_widget' );
	}

/**
 * Search Blog Widget
 */
class Search_blog_widget extends WP_Widget {
	// setup widget
	function Search_blog_widget() {
		
		// widget settings
		$widget_ops = array (
				'classname' => 'search_blog_widget',
				'description' => __ ( 'Search blogs widget', 'search_blog_widget' ) 
		);
		
		// widget control settings
		$control_ops = array (
				'width' => 388,
				'height' => 327,
				'id_base' => 'search_blog_widget' 
		);
		
		// create widget
		$this->WP_Widget ( 'search_blog_widget', __ ( 'Search blogs widget', 'search_blog_widget' ), $widget_ops, $control_ops );
	}
	
	/**
	 * How to display the widget on the screen.
	 */
	function widget($args, $instance) {
		// Widget output
		extract ( $args );
		
		/* Our variables from the widget settings. */
		$title = $instance ['contest'];
		
		/* Before widget (defined by themes). */
		echo $before_widget;
		?>
		<div class="searchBox">
			<div class="group">
				<form id="formSearchContest" action="javascript:;" method="GET">
					<input type="hidden" class="searchUrl" value="<?php bloginfo("wpurl");?>/blog/search/" />
					<input type="text" class="text isBlured searchKey" />
					<input type="submit" style="display:none" />
					<a class="btn" href="javascript:$('#formSearchContest').submit();">Find</a>
				</form>
			</div>
		</div>

	<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	/**
	 * Update the widget settings.
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance ['title'] = strip_tags ( $new_instance ['title'] );
		
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form($instance) {
		
		/* Set up some default widget settings. */
		$defaults = array (
				'title' => __ ( 'Blog Search', event_widget ) 
		);
		$instance = wp_parse_args ( ( array ) $instance, $defaults );
		?>
		<?php
	}
}

/**
 * Search Blog Widget End
 */
 
/**
 * Blog Categories Widget
 */
class Blog_category_widget extends WP_Widget {
	// setup widget
	function Blog_category_widget() {
		
		// widget settings
		$widget_ops = array (
				'classname' => 'blog_category_widget',
				'description' => __ ( 'Blog category widget', 'blog_category_widget' ) 
		);
		
		// widget control settings
		$control_ops = array (
				//'width' => 388,
				//'height' => 327,
				'id_base' => 'blog_category_widget' 
		);
		
		// create widget
		$this->WP_Widget ( 'blog_category_widget', __ ( 'Blog category widget', 'blog_category_widget' ), $widget_ops, $control_ops );
	}
	
	/**
	 * How to display the widget on the screen.
	 */
	function widget($args, $instance) {
		// Widget output
		extract ( $args );
		
		/* Our variables from the widget settings. */
		$title = $instance ['title'];
		$postPerPage = $instance['post_per_page'];
		
		$title = $title == "" ? "Categories" : $title;
		$postPerPage = $postPerPage == "" ? 7 : $postPerPage;
		
		
		/* Before widget (defined by themes). */
		echo $before_widget;
	
		$blogCategoryId = getCategoryId(BLOG);
		$args = array(
			'type'                     => 'blog',
			'child_of'                 => $blogCategoryId,
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 0,
			'hierarchical'             => 0,
			'exclude'                  => '0'
		); 
		$categoryPerPage = $postPerPage;
		$arrCategory = get_categories( $args );
		$categoryCount = count($arrCategory);
		$count=1;
		if($arrCategory!=null) :
			if($categoryCount>$postPerPage)
				$count = (int) ($categoryCount / $categoryPerPage);	
				$count += $categoryCount % $categoryPerPage > 0 ? 1 : 0;
		?>
		<div class="categoriesWidget">
			<h3><?php echo $title;?></h3>
			<div id='mySwipe' class='swipe'>
				<div class='swipe-wrap'>
				<?php
					for($i=0;$i<$count;$i++) {
						$adder = $count>1 ? $i * $categoryPerPage : 0;
						echo "<ul>";
						for($j=0;$j<$categoryPerPage;$j++) {
							$index = $j+$adder;
							if($index<$categoryCount) :
							?>
								<li><a class="contestName" href="<?php echo get_category_link($arrCategory[$index]->term_id);?>"><i></i><?php echo $arrCategory[$index]->cat_name;?></a></li>
							<?php 
							endif;
						}										
						echo "</ul>";
					}
				?>
				</div>
				<?php
					if($count>1) :
				?>
				<div id="categoryNav" class="swipeNavWrapper">
				<?php
						for($i=0;$i<$count;$i++) :
							$active = $i==0 ? "on" : "";
				?>
					<a id="swipeNav<?php echo $i;?>" href="javascript:;" class="<?php echo $active;?>">&nbsp;</a>
				<?php 	endfor; ?>
				</div>
				<?php endif;?>
			</div>
		</div>
		<!-- /.categories-->
		<?php endif; ?>

	<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	/**
	 * Update the widget settings.
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance ['title'] = strip_tags ( $new_instance ['title'] );
		$instance ['post_per_page'] = strip_tags ( $new_instance ['post_per_page'] );
		
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form($instance) {
		
		/* Set up some default widget settings. */
		$defaults = array (
				'title' => __ ( 'Categories', widget_title ),
				'post_per_page' => __ ( 7, post_per_page )
		);
		$instance = wp_parse_args ( ( array ) $instance, $defaults );
		?>

		<!-- Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'widget_title'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width: 100%;" />
		</p>
		
		<!-- Post Per Page -->
		<p>
			<label for="<?php echo $this->get_field_id( 'post_per_page' ); ?>"><?php _e('Category Per Page:', 'post_per_page'); ?></label>
			<input id="<?php echo $this->get_field_id( 'post_per_page' ); ?>" name="<?php echo $this->get_field_name( 'post_per_page' ); ?>" value="<?php echo $instance['post_per_page']; ?>" style="width: 100%;" />
		</p>
		<?php
	}
}

/**
 * Blog Categories Widget End
 */ 
 
/**
 * Popular Post Widget
 */
class Popular_post_widget extends WP_Widget {
	// setup widget
	function Popular_post_widget() {
		
		// widget settings
		$widget_ops = array (
				'classname' => 'popular_post_widget',
				'description' => __ ( 'Popular post widget', 'popular_post_widget' ) 
		);
		
		// widget control settings
		$control_ops = array (
				//'width' => 388,
				//'height' => 327,
				'id_base' => 'popular_post_widget' 
		);
		
		// create widget
		$this->WP_Widget ( 'popular_post_widget', __ ( 'Popular post widget', 'popular_post_widget' ), $widget_ops, $control_ops );
	}
	
	/**
	 * How to display the widget on the screen.
	 */
	function widget($args, $instance) {
		// Widget output
		extract ( $args );
		
		/* Our variables from the widget settings. */
		$title = $instance ['title'];
		$postPerPage = $instance['post_per_page'];
		
		/* Before widget (defined by themes). */
		echo $before_widget;
	
			wp_reset_query();
			$title = $title == "" ? "Popular Posts" : $title;
			$postPerPage = $postPerPage == "" ? 4 : $postPerPage;
			$args = array( 'post_type'=>'blog','posts_per_page' => $postPerPage, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  );
			query_posts($args);
			if(have_posts()) :
		?>
		<div class="sideFindRelatedContent sideFindRelatedContentNoBorder">
			<input class="popularPostPage" type="hidden" value="<?php echo $postPerPage;?>" />
			<input type="hidden" class="pageNo" value="1" />
			<h3 class="popularPostTitle"><?php echo $title;?></h3>
			<ul class="relatedContentList">
			<?php	
				while ( have_posts() ) : the_post();
					$post;
					
					$postId = $post->ID;
					$imageMobile = wp_get_attachment_image_src( get_post_thumbnail_id( $postId ), 'thumbnail' );
					if($imageMobile!=null) $imageUrlMobile = $imageMobile[0];
					else $imageUrlMobile = get_bloginfo('stylesheet_directory')."/i/content-thumb.png";
					
					?>
					<li>
						<a class="contentLink" href="<?php the_permalink() ?>">
						<img class="contentThumb" src="<?php echo $imageUrlMobile; ?>" alt="<?php the_title(); ?>">
						<?php the_title(); ?>
						</a> <span class="contentBrief"><?php echo wrap_content_strip_html(wpautop(get_the_content()), 70, true,'\n\r','...') ?></span>
					</li>
					<?php
				endwhile;
			?>
			</ul>
			<div class="showMoreWrapper">
				<a id="popularShowMore" href="javascript:;" class="btn jsShowMoreArchiveStories">Show More</a>
				<span class="morePostLoading">&nbsp;</span>
				<span class="noMorePostExist">No more post exist!</span>
			</div>
		</div>
		<!-- /.popular post-->
		<?php endif; ?>

	<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	/**
	 * Update the widget settings.
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance ['title'] = strip_tags ( $new_instance ['title'] );
		$instance ['post_per_page'] = strip_tags ( $new_instance ['post_per_page'] );
		
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form($instance) {
		
		/* Set up some default widget settings. */
		$defaults = array (
				'title' => __ ( 'Popular Posts', widget_title ),
				'post_per_page' => __ ( 7, post_per_page )
		);
		$instance = wp_parse_args ( ( array ) $instance, $defaults );
		?>

		<!-- Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'widget_title'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width: 100%;" />
		</p>
		
		<!-- Post Per Page -->
		<p>
			<label for="<?php echo $this->get_field_id( 'post_per_page' ); ?>"><?php _e('Popular Post Per Page:', 'post_per_page'); ?></label>
			<input id="<?php echo $this->get_field_id( 'post_per_page' ); ?>" name="<?php echo $this->get_field_name( 'post_per_page' ); ?>" value="<?php echo $instance['post_per_page']; ?>" style="width: 100%;" />
		</p>
		<?php
	}
}

/**
 * Popular Post Widget End
 */  
 
/**
 * Subscribe Widget
 */
class Subscribe_widget extends WP_Widget {
	// setup widget
	function Subscribe_widget() {
		
		// widget settings
		$widget_ops = array (
				'classname' => 'subscribe_widget',
				'description' => __ ( 'Subscribe widget', 'subscribe_widget' ) 
		);
		
		// widget control settings
		$control_ops = array (
				'width' => 388,
				'height' => 327,
				'id_base' => 'subscribe_widget' 
		);
		
		// create widget
		$this->WP_Widget ( 'subscribe_widget', __ ( 'Subscribe widget', 'subscribe_widget' ), $widget_ops, $control_ops );
	}
	
	/**
	 * How to display the widget on the screen.
	 */
	function widget($args, $instance) {
		// Widget output
		extract ( $args );
		
		/* Our variables from the widget settings. */
		$title = $instance ['title'];
		$title = $title == "" ? "Subscribe" : $title;
		
		/* Before widget (defined by themes). */
		echo $before_widget;
		?>
		<div class="subscribeBox">
			<h3><?php echo $title;?></h3>
			<div class="group">
				<input type="email" class="text isBlured subscribeInput" placeholder="Enter Your Email Address : " />
				<span class="errorInput"></span>
				<p class="subscribeSuccess">Thanks for subscription our blog</p>
			</div>
			<div class="showMoreWrapper"><a class="subscribeButton btn" href="javascript:;">Subscribe</a></div>	
		</div>

	<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	/**
	 * Update the widget settings.
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance ['title'] = strip_tags ( $new_instance ['title'] );
		
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form($instance) {
		
		/* Set up some default widget settings. */
		$defaults = array (
				'title' => __ ( 'Subscribe', event_widget ) 
		);
		$instance = wp_parse_args ( ( array ) $instance, $defaults );
		?>

		<!-- Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'event_widget'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width: 100%;" />
		</p>
		<?php
	}
} 

/**
 * Subscribe Widget end
 */
 
/**
 * Download Widget
 */
class Download_banner_widget extends WP_Widget {
	// setup widget
	function Download_banner_widget() {
		
		// widget settings
		$widget_ops = array (
				'classname' => 'download_banner_widget',
				'description' => __ ( 'Download banner widget', 'download_banner_widget' ) 
		);
		
		// widget control settings
		$control_ops = array (
				'width' => 388,
				'height' => 327,
				'id_base' => 'download_banner_widget' 
		);
		
		// create widget
		$this->WP_Widget ( 'download_banner_widget', __ ( 'Download banner widget', 'download_banner_widget' ), $widget_ops, $control_ops );
	}
	
	/**
	 * How to display the widget on the screen.
	 */
	function widget($args, $instance) {
		// Widget output
		extract ( $args );
		
		/* Our variables from the widget settings. */
		$downloadLink = $instance ['download_link'];
		$downloadLink = $downloadLink == "" ? "javascript:;" : $downloadLink;
		$html_content = $instance ['html_content'];
		$html_content = trim($html_content) == "" ? 
		'
		<a class="downloadWidget" href="javascript:;">
			<p class="download">download :</p>
			<p class="para1">THE TALENT WAR SURVIVAL GUIDE:</p>
			<p class="para2">MASTERING APPLICATION</p>
			<p class="para3">DEVELOPMENT</p>
		</a>
		' : $html_content;
		
		$html_content = str_replace("site_url", get_bloginfo("stylesheet_directory"), $html_content);
		
		/* Before widget (defined by themes). */
		echo $before_widget;
		echo $html_content;
		?>

	<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	/**
	 * Update the widget settings.
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance ['download_link'] = strip_tags ( $new_instance ['download_link'] );
		$instance ['html_content'] = $new_instance['html_content'];
		
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form($instance) {
		
		/* Set up some default widget settings. */
		$defaults = array (
				'html_content' => __ ( 
				'<a class="downloadWidget" href="">
						<img class="banner" src="site_url/i/download-bg.png" width="319" height="171" alt="" />
						<p class="download">download :</p>
						<p class="para1">THE TALENT WAR SURVIVAL GUIDE:</p>
						<p class="para2">MASTERING APPLICATION</p>
						<p class="para3">DEVELOPMENT</p>
					</a>
				', event_widget )
		);
		$instance = wp_parse_args ( ( array ) $instance, $defaults );
		?>

		<!-- Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'html_content' ); ?>"><?php _e('HTML Content:', 'event_widget'); ?></label>
			<p><strong>Note:</strong> site_url will automatic change to the host ip/domain name, e,g: href=site_url/i/download-bg.png</p>
			<textarea id="<?php echo $this->get_field_id( 'html_content' ); ?>" name="<?php echo $this->get_field_name( 'html_content' ); ?>" rows="10" value="" style="width: 100%;">
				<?php echo $instance['html_content']; ?>
			</textarea>
		</p>
		<?php
	}
} 

/**
 * Download Widget end
 */ 
 
?>