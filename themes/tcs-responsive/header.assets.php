<!-- meta -->
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes" />

<!-- Favicons -->
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" />

<!-- Main CSS -->
<link href="http://fonts.googleapis.com/css?family=Lato:400,300,700,i,300i" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/base.css" />
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/style.css" />
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/style-profile.css" />
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/base-responsive.css" />
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/style-responsive.css" />
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/coder.css" />
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/profileBadges.css" />
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/register-login.css" />


<!-- External JS -->
<!--[if lt IE 9]>
  <script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/html5shiv.js" type="text/javascript"></script>
  <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/ie.css" />
<![endif]-->

<!--[if IE 7]>
  <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/ie7.css" />
<![endif]-->

<!--[if IE]>
  <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/ie_all.css" />
<![endif]-->


<script>
	var base_url = '<?php echo bloginfo( 'stylesheet_directory' ); ?>';
	var siteURL = '<?php echo get_bloginfo('siteurl');?>';
	var wpUrl = "<?php bloginfo('wpurl')?>";
	var ajaxUrl = wpUrl+"/wp-admin/admin-ajax.php";		
</script>
	
<?php fixIERoundedCorder(); ?>
<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.bxslider.js" type="text/javascript"></script>

<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.mousewheel.js" type="text/javascript"></script>

<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.customSelect.min.js" type="text/javascript"></script>
<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/swipe.js" type="text/javascript"></script>
<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.inputhints.js" type="text/javascript"></script>

<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/scripts.js" type="text/javascript"></script>
<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/register-login.js" type="text/javascript"></script>
<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/init-header.js" type="text/javascript"></script>

<!-- auth -->
<script id="auth0" src="https://sdk.auth0.com/auth0.js#client=<?php echo auth0_client_id;?>"></script>

<script src="https://d19p4zemcycm7a.cloudfront.net/w2/auth0-1.2.2.min.js"></script>



