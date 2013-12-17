    <footer id="footer">
        <div class="mask">
            <?php
			if ( PORTAL == 'news' ):
			?>
			<section class="otherInfos">
			
			
                <section class="cates">
                    <div class="titleBox">
                        <div class="boxR">
                            <h2>Category</h2>
                        </div>
                    </div>
                    <ul>
                    <?php                     
                     $cat_IDs = get_all_category_ids();
                     foreach ($cat_IDs as $cat_ID) {
                         $cat = get_category($cat_ID);
                         
                         if (is_only_news_category($cat)) {
                             $cat_permalink = get_category_link($cat->cat_ID);
                             echo "<li><a href=\"{$cat_permalink}\">{$cat->name}</a></li>\n";
                         }
                     }
                    ?>
                    </ul>
                </section>
                <section class="news">
                    <div class="titleBox">
                        <div class="boxR">
                            <h2>Popular news</h2>
                        </div>
                    </div>
                    <ul>
                        <?php
                            $args = array(
                                'post_type' => 'pressroom',
                                'order' => 'DESC',
                                'orderby' => 'meta_value_num',
                                'meta_key' => 'post_views_count',
                                'posts_per_page' => 4
                            );
                            
                            $popular_news = new WP_Query($args);
                            if ($popular_news->have_posts()): while ($popular_news->have_posts()): $popular_news->the_post();
                        ?>
                        <li><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php
                        endwhile; endif; 
                        ?>
                    </ul>
                </section>
                <?php dynamic_sidebar('Latest twitter widget sidebar'); ?>
            </section>
            <?php
			endif;
			?>
			<section class="portals">
                <h3>Portals</h3>
                <?php wp_nav_menu( 
					array(
						'container' => false,
						'theme_location' => '',
						'menu' => 'portal',
						'items_wrap' => '<nav>%3$s</nav>',
						'walker' => new Portal_walker_nav_menu
					) 
				); ?>
            </section>
            <section class="customers">
                <h3>Our Customers</h3>
                <p>Find out who else has worked with TopCoder.</p>
                <ul class="carousel">
				<?php
					global $wp_query;
					wp_reset_query();
					query_posts(array(
							'post_type'=>'customer_carousel',
							'posts_per_page'=>'-1'
						));
					$case_page_url = get_permalink(get_page_by_path('case-studies')->ID);	
					if(have_posts()):while(have_posts()): the_post();
						$thumbnailVal = get_post_meta($post->ID,"Image",true);
						$thumbnailImg = wp_get_attachment_image_src( $thumbnailVal, "full" );
						$link = get_post_meta($post->ID,"Link",true);
						$link = ( $link == '') ? $case_page_url:$link;
						$thumbnailImg = $thumbnailImg[0];
						if($thumbnailImg!=null) :
				?>
                    <li>
                        <a href="<?php echo $link;?>" ><img src="<?php echo $thumbnailImg;?>" alt="" width="386" height="73" /></a>
                    </li>
				<?php
						endif;
					endwhile; endif;
				?>

                </ul>
            </section>
            <div class="clear"></div>
            <div class="bottom">
                <nav>
                    <span>Copyright TopCoder, Inc. 2001-<?php echo date('Y');?></span>
                    <?php wp_nav_menu( 
						array(
							'container' => false,
							'theme_location' => '',
							'menu' => 'footer',
							'items_wrap' => '%3$s',
							'before' => '<span class="line"></span>',
							'walker' => new Footer_walker_nav_menu
						) 
					); ?>
                </nav>
                <div class="socials">
					<div id="followUsWidget"><?php dynamic_sidebar('widget_follow_us_footer'); ?></div>
				</div>
            </div>
        </div>
    </footer><!-- End of #footer -->  
	
	<!-- login modal -->
	<div class="" id="loginModal">
		<div class="redTop">
			<div class="loginError hide">Incorrect username or password</div>
		</div>
		<div class="loginContentWrapper">
			<div id="loginUsernameWrapper" class="loginRegisterInputText">
				<input type="text" id="username" />
				<span class="label">Handle</span>
			</div>
			<div id="loginPasswordWrapper" class="loginRegisterInputText checkboxRow">
				<input type="password" id="password" />
				<span class="label">Password</span>
			</div>
			<div class="row">
                <input type="checkbox" id="rememberMe"><span class="rememberMe">Remember me</span>
				<a class="forgotPassword" href="https://www.topcoder.com/tc?module=RecoverPassword">Forgot Password?</a>
            </div>
			<div class="row">
				<a id="loginButton" class="loginBtn"></a>
				<span id="loginLoading" class="loginLoading"><span class="loading"></span></span>
			</div>
			<div class="clearFix"></div>
		</div>
		<div class="loginBottomWrapper">
			<div class="row">
				<span class="dontHaveAccountLabel">Don't have an account?</span>
				<a class="registerTab">Register</a>
			</div>
		</div>
	</div>	
	<!-- end login modal -->
	
	<!-- register modal -->
	<div id="registerModal">
		<form>
		<a href="javascript:;" class="closeRegister"></a>
		<div class="header"></div>
		<div class="registerContentWrapper">
			<div class="row">
				<div id="" class="loginRegisterInputText">
					<input type="text" id="firstName" />
					<span class="label">First Name</span>
				</div>	
				<div class="validCheck"></div>
				<div class="error">Please fill in your first name</div>
			</div>
			<div class="row">
				<div id="" class="loginRegisterInputText">
					<input type="text" id="lastName" />
					<span class="label">Last Name</span>
				</div>	
				<div class="validCheck"></div>
				<div class="error">Please fill in your last name</div>
			</div>
			<div class="row">
				<div id="handleInput" class="loginRegisterInputText">
					<input type="text" id="handle" />
					<span class="label">Handle</span>
				</div>	
				<div href="javascript:;" class="whatsThis">What's This?
					<div class="handleTooltips">
						<div class="handleTooltipsTop"></div>
						<div class="handleTooltipsContent">
							<p><strong>Handle is your desired username.</strong></p>
							<p>It will represent yourself in TopCoder community.</p>
							<p>Once you have completed registeration,your handle can not be changed.</p>
							<div class="caseSensitive">Handle is case senstitive</div>
						</div>
					</div>
				</div>
				<div class="validCheck"></div>
				<div class="error">Please fill your desired handle</div>
			</div>
			<div class="row">
				<div id="" class="loginRegisterInputText">
					<input type="text" id="email" />
					<span class="label">Email</span>
				</div>	
				<div class="validCheck"></div>
				<div class="error">Please fill your email</div>
			</div>			
			<div class="row">
				<div id="" class="loginRegisterInputText">
					<input type="password" id="regPassword" />
					<span class="label">Password</span>
				</div>	
				<div class="validCheck"></div>
				<div class="error">Please fill your password</div>
			</div>
			<div class="row">
				<div id="" class="loginRegisterInputText">
					<input type="password" id="confirmPassword" />
					<span class="label">Confirm Password</span>
				</div>	
				<div class="validCheck"></div>
				<div class="passwordNotMactchErr error"></div>
			</div>
			<div class="row">
				<div id="" class="loginRegisterInputText">
					<input type="text" id="veriCode" />
					<span class="label">Verification Code</span>
				</div>	
				<div class="validCheck"></div>
				<div class="error">Please enter the verification code</div>
			</div>
			<div class="row specialRow checkboxRow">
				<img id="veriImg" alt="" src="http://www.topcoder.com/present/captchaImage.action?t=1343446868914" class="imgCode">
                <a class="tryAnotherCode" href="javascript:;">Try another code</a>
            </div>
			<div id="acceptRow" class="row acceptRow">
				<input id="accPol" name="accPol" type="checkbox"><label for="accPol" class="accept">I have read and accept the <a href="https://www.topcoder.com/reg/privacy_policy.jsp">privacy policy</a></label></input>
            </div>
			<div class="row">
				<span class="error policyErr hide" style="display: none;">Please accept the privacy policy</span>
			</div>
			<div class="row">
				<a href="javascript:;" id="clearRegisterForm">Clear</a>
				<a class="submitBtn" href="javascript:;"></a>
				<span id="registerLoading" class="registerLoading"><span class="loading"></span></span>
            </div>
			<div class="clearFix"></div>
		</div>
		</form>
	</div>
	<!-- end register modal -->
	<?php 
		global $isHome;
		if( $isHome ) get_template_part('questionnaire.asset'); 
	?>
	<?php 
		wp_footer();
	?>
	<div id="greybackground"></div>
	<div id="whiteWrapper">
		<div class="summerThemeBackground bgPopup"></div>
	</div>
	
	<div id="videoPopup" class="questionnairePopup">
        <div class="topWrapper"></div>
        <div class="contentWrapper"></div>
        <div class="bottomWrapper"></div>
        <a href="javascript:;" class="btn_close"></a>
	<!-- put your HTML for modal window here  -->
	</div>
  </body>
  <script>
  <?php if ( is_user_logged_in() ) :?>var loginPopupTop = 74;
  <?php else : ?>var loginPopupTop = 44;<?php endif; ?>
  </script>
  <!--[if IE 7]>
	<style>
		#loginModal .loginRegisterInputText {
			float:left; clear:both;
			height:28px;
			width:196px;
			margin-bottom:0px;
			position:relative;
		}
	</style>	
  <![endif]-->
</html>