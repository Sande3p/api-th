<nav>
            <a href="<?php bloginfo('siteurl');?>	" class="logo"></a>
				<?php 
				$meta = get_cookie();
				if ( $meta->handle_name == '' || $meta->handle_id == '' )
				{
					$welcome = "hide";
					$reg = "";
				}
				else
				{
					$welcome = "";
					$reg = "hide";
				}
				?>
             <div class="welcomeSection <?php echo $welcome;?>">
				Welcome [<a href="http://community.topcoder.com/tc?module=MemberProfile&tab=des&cr=<?php echo $meta->handle_id;?>" class='handle'><?php echo $meta->handle_name;?></a>]  <br /><a class="logoutLink" href="javascript:;">Logout</a>
			 </div>
			 <div class="registerSection <?php echo $reg;?>">
				 <a class="redBtn registerBtn" href="javascript:;">
					 <span class="buttonMask"><span class="text">LOGIN</span></span>
				 </a>
			</div>	 
            <?php wp_nav_menu( 
				array(
					'container' => false,
					'theme_location' => '',
					'menu' => 'top_menu',
					'walker' => new Top_walker_nav_menu
				) 
			); ?>
        </nav>