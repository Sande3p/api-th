<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php bloginfo('name'); ?><?php wp_title(' - ', true, 'left'); ?></title>
<meta name="description" content="">
<meta name="author" content="">

	<?php wp_head(); ?>	
	<script type="text/javascript">
		var ajaxUrl = "<?php  bloginfo('wpurl')?>/wp-admin/admin-ajax.php";		
	</script>
	
<script src="https://d19p4zemcycm7a.cloudfront.net/w2/auth0-widget-2.3.6.min.js"></script>

<script id="auth0" src="https://sdk.auth0.com/auth0.js#client=6ZwZEUo2ZK4c50aLPpgupeg5v2Ffxp9P&amp;state=http://cloudspokes.wpengine.com/&amp;redirect_uri=https://www.topcoder.com/reg2/callback.action"></script>

   <script>
     $(function () {
           $('.actionLogin').click( function () {
                 window.Auth0.signIn({ onestep: true, 
                 						title: "TopCoder", 
                 						icon: 'http://www.topcoder.com/i/24x24_brackets.png', 
                 						showIcon: true,
                 						showForgot: true,
    									forgotText: "Forgot Password?",
    									forgotLink: "https://www.topcoder.com/..."
                 					});
           });
       });
                          
   </script>	
	
	<?php get_template_part('header.assets'); ?>
  </head>

<body>
<?php
$nav = array (
		'menu' => 'Main Navigation',
		'menu_class' => '',
		'container'       => '',		
		'menu_class'      => 'root',
		'items_wrap'      => '%3$s',
		'walker' => new nav_menu_walker () 
);


$cookie = get_cookie();

global $coder;
$handle = get_query_var ( 'handle' );
// just for testing if handle is blank
if($handle==null || $handle == ""){
	$handle = "lunarkid";
}
if ( $cookie->handle_name == '' || $cookie->handle_id == '' )
{
	$user = "";
	$welcome = "hide";
	$reg = "";
}
else
{
	$user = "newUser";
	$welcome = "";
	$reg = "hide";
}

global $coder;
$coder = get_raw_coder($handle);
$memberSince = explode(" ",$coder->memberSince);
$memberSince = explode(".",$memberSince[0]);
$memberEarning = '$'.$coder->overallEarning;
$photoLink = 'http://community.topcoder.com'.$coder->photoLink;
?>

<div id="wrapper">
		<nav class="sidebarNav mainNav onMobi <?php echo $user; ?>">
		 <ul class="root"><?php wp_nav_menu ( $nav );	?>
			 <li class="notLogged"><a href="javascript:;" class="actionLogin"><i></i>Log In</a></li>
			 <li class="notLogged"><a href="javascript:;"><i></i>REGISTER</a></li>
			 <li class="userLi isLogged">
				<div class="userInfo">
					<div class="userPic">
						<img src="<?php echo $photoLink;?>" alt="<?php echo $coder->handle; ?>">
					</div>
					<div class="userDetails">
						<a href="<?php bloginfo('wpurl');?>/member-profile/<?php echo $coder->handle;?>" class="coder"><?php echo $coder->handle;?></a>
						<p class="country"><?php echo $coder->country; ?></p>
						<a href="#" class="link">My Profile</a>
						<a href="#" class="link">My Dashboard </a>
						<a href="javascript:;" class="link actionLogout">Log Out </a>	
					</div>
				</div>
			</li>
		 </ul>
		</nav>
		<!-- /.sidebarNav -->
		<header id="navigation" class="<?php echo $user; ?>">
			<div class="container">
				<h1 class="logo">
					<a href="<?php bloginfo('wpurl');?>" title="<?php bloginfo('name'); ?>"></a>
				</h1>
				<nav id="mainNav" class="mainNav">
					
					<ul class="root">
						<?php wp_nav_menu ( $nav );	?>
						<li class="onReg"><a href="javascript:;" class="actionLogout">Log Out</a></li>
						<li class="noReg"><a href="javascript:;" class="actionLogin">Log In</a></li>
					</ul>
				</nav>
				<a href="javascript:;" class="onMobi onReg linkLogout actionLogout">Log Out</a>
				<a href="javascript:;" class="onMobi noReg linkLogin actionLogin">Log In</a>
				<span class="btnRegWrap noReg"><a href="javascript:;" class="btn btnRegister">Register</a> </span> <span class="btnAccWrap onReg"><a href="javascript:;" class="btn btnAlt btnMyAcc">
						My Account<i></i>
					</a></span>
				<div class="userWidget">
					<div class="details">
						<div class="userPic">
							<img alt="<?php echo $coder->handle; ?>" src="<?php echo $photoLink;?>">
						</div>
						<div class="userDetails">
							<?php echo get_handle($coder->handle); ?>
							<p class="country"><?php echo $coder->country; ?></p>
							<p class="lbl">Member Since:</p>
							<p class="val"><?php echo $memberSince[2] ?></p>
							<p class="lbl">Total Earnings :</p>
							<p class="val"><?php echo $memberEarning?></p>
						</div>
					</div>
					<div class="action">
						<a href="#">My Profile</a>
						<a href="#">My Dashboard </a>
						<a href="javascript:;" class="linkAlt actionLogout">Log Out</a>
					</div>
				</div>
				<!-- /.userWidget -->	
			</div>
		</header>
		<!-- /#header -->