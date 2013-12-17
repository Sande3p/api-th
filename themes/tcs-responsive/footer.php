<article id="aboutContent">
	<div class="container">
	<?php 
	$footer = get_page_by_path ( 'footer', OBJECT, 'page' );
	if ($footer->post_content != ''):
	?>
		<?php echo do_shortcode($footer->post_content);?>
	<?php endif; ?>
	</div>
</article>
<!-- /#aboutContent -->
</div>
<!-- /#main -->
<footer id="footer">
<?php
// footer nav 
$footerNav = array (
	'menu' => 'Main Navigation',
	'menu_class' => '',
	'container'       => '',
	'menu_class'      => 'root',
	'items_wrap'      => '%3$s',
	'walker' => new footer_menu_walker ()
);
?>
	<div class="container">
	<ul class="footerNav">
	<?php wp_nav_menu($footerNav); ?>
	</ul>
		<div class="connected">
			<section class="updates">
				<h4>Get Updates</h4>
				<div class="row">
					<form method="post" action="http://www.topcoder.com/newsletter/" onsubmit="return newsletter_check(this)" name="FeedBlitz_9feab01d431311e39e69002590771423" style="display:block" method="POST" action="http://www.feedblitz.com/f/f.fbz?AddNewUserDirect">
						<input type="email" class="email" name="EMAIL" placeholder="Your email address" maxlength="64" />
						<input name="FEEDID" type="hidden" value="926643" /> 
						<input name="PUBLISHER" type="hidden" value="34610190" />
						<!--<a onclick="FeedBlitz_9feab01d431311e39e69002590771423s(this.form);" class="btn">Submit</a> -->
						<a type="button" class="btn" value="Submit" onclick="FeedBlitz_9feab01d431311e39e69002590771423s(this.form);" />Submit</a>
						<input type="hidden" name="na" value="s"/>
						<input type="hidden" name="nr" value="widget"/>
					</form> 
					<script language="Javascript">function FeedBlitz_9feab01d431311e39e69002590771423i(){var x=document.getElementsByName('FeedBlitz_9feab01d431311e39e69002590771423');for(i=0;i<x.length;i++){x[i].EMAIL.style.display='block'; x[i].action='http://www.feedblitz.com/f/f.fbz?AddNewUserDirect';}} function FeedBlitz_9feab01d431311e39e69002590771423s(v){v.submit();}FeedBlitz_9feab01d431311e39e69002590771423i();</script>

				</div>
			</section>
			<section class="social">
				<h4>Get Connected</h4>
				<ul>
					<li><a class="fb" href="<?php echo get_option('facebookURL'); ?>">FB</a></li>
					<li><a class="tw" href="<?php echo get_option('twitterURL'); ?>">TW</a></li>
					<li><a class="gp" href="<?php echo get_option('gPlusURL'); ?>">GP</a></li>
					<li><a class="in" href="<?php echo get_option('linkedInURL'); ?>">IN</a></li>
				</ul>
			</section>
		</div>
		<div class="clear"></div>
	</div>
</footer>
<!-- /#footer -->
</div>
	<!-- /.content -->
	</div>
	<!-- /#wrapper -->		
<?php wp_footer(); ?>


<div id="bgModal"></div><!-- background modal -->
	<div id="thanks" class="modal">
		<a href="javascript:;" class="closeBtn closeModal"></a>
		<div class="content">
			<h2>Thanks for registering</h2>
			<p>We have sent you an email with a activation instructions.<br />If you do not receive that email within 1 hour, please email <a href="mailto:support@topcoder.com">support@topcoder.com</a></p>
			<div>
				<a href="javascript:;" class="btn closeModal">Close</a>
			</div>
		</div>
	</div><!-- END #thanks -->
	<div id="register" class="modal">
		<a href="javascript:;" class="btnClose closeModal"></a>
		<div class="content">
			<h2>Register Using An Existing Account</h2>
			<div id="socials">
				<a class="signin-facebook" href="#"><span class="animeButton shareFacebook"><span class="shareFacebookHover animeButtonHover"></span></span></a>
				<a class="signin-google" href="#"><span class="animeButton shareGoogle"><span class="shareGoogleHover animeButtonHover"></span></span></a>
				<a class="signin-twitter" href="#"><span class="animeButton shareTwitter"><span class="shareTwitterHover animeButtonHover"></span></span></a>
				<a class="signin-github" href="#"><span class="animeButton shareGithub"><span class="shareGithubHover animeButtonHover"></span></span></a>
				<p>Using an existing account is quick and easy.<br />Select the account you would like to use and we'll do the rest for you</p>
				<div class="clear"></div>
			</div><!-- END .socials -->
			<h2>Or Register Using Your Email</h2>
			<form class="register" id="registerForm">
				<p class="row">
					<label>Username</label>
					<input type="text" class="name" placeholder="Username"/>
					<span class="err1">Required field</span>
					<span class="err2">Username already exists</span>
					<span class="valid"></span>
				</p>
				<p class="row">
					<label>Email</label>
					<input type="text" class="email" placeholder="Email"/>
					<span class="err1">Required field</span>
					<span class="err2">Invalid email address</span>
					<span class="valid"></span>
				</p>
				<p class="row">
					<label>Password</label>
					<input type="password" class="pwd" placeholder="Password"/>
					<span class="err1">Required field</span>
					<span class="err2">Password strength is weak</span>
					<span class="valid">Strong</span>
				</p>
				<p class="row info lSpace">
					<span class="strength">
						<span class="field"></span>
						<span class="field"></span>
						<span class="field"></span>
						<span class="field"></span>
						<span class="field"></span>
						<span class="field"></span>
					</span>
					8 characters with letters &amp; numbers
				</p>
				<p class="row">
					<label>Password Confirmation</label>
					<input type="password" class="confirm" placeholder="Password Confirmation"/>
					<span class="err1">Required field</span>
					<span class="err2">Password confirmation different from above field</span>
					<span class="valid"></span>
				</p>
				
				<p class="row lSpace">
					<label><input type="checkbox" />I agree to the <a href="/customers/how-it-works/terms/" target="_blank">terms of service</a> and <a href="/customers/how-it-works/privacy-policy/" target="_blank">privacy policy</a>*</label>
					<span class="err1">You must agree to the terms</span>
					<span class="err2">You must agree to the terms</span>
				</p>
				
			</form><!-- END .form register -->
			<h3>Planning to compete?</h3>
			<div class="options">
				<div class="person blue">
					<label>
						<span class="checkBox"><input type="checkbox" />I'm a designer</span>
						<span class="animeMan manBlue"><span class="manBlueHover animeManHover"></span></span>
						
					</label>
				</div><!-- END .person -->
				<div class="person green">
					<label>
						<span class="checkBox"><input type="checkbox" />I'm a developer</span>
						<span class="animeMan manGreen"><span class="manGreenHover animeManHover"></span></span>					
					</label>
				</div><!-- END .person -->
				<div class="person yellow">
					<label>
						<span class="checkBox"><input type="checkbox" />I'm a algorithmist</span>
						<span class="animeMan manYellow"><span class="manYellowHover animeManHover"></span></span>
					</label>
				</div><!-- END .person -->
				<div class="person grey">
					<label>
						<span class="checkBox"><input type="checkbox" />I'm a not sure yet</span>
						<span class="animeMan manGrey"><span class="manGreyHover animeManHover"></span></span>
					</label>
				</div><!-- END .person -->
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<p class="submitBtn">
				<a href="javascript:;" class="btn btnSubmit">Sign Up</a>
			</p>
		</div>
	</div><!-- END #register -->
	<div id="login" class="modal">
		<a href="javascript:;" class="btnClose closeModal"></a>
		<div class="content">
			<h2>Login Using An Existing Account</h2>
			<div id="socials">
				<a class="signin-facebook" href="#"><span class="animeButton shareFacebook"><span class="shareFacebookHover animeButtonHover"></span></span></a>
				<a class="signin-google" href="#"><span class="animeButton shareGoogle"><span class="shareGoogleHover animeButtonHover"></span></span></a>
				<a class="signin-twitter" href="#"><span class="animeButton shareTwitter"><span class="shareTwitterHover animeButtonHover"></span></span></a>
				<a class="signin-github" href="#"><span class="animeButton shareGithub"><span class="shareGithubHover animeButtonHover"></span></span></a>
				<p>Using an existing account is quick and easy.<br />Select the account you would like to use and we'll do the rest for you</p>
				<div class="clear"></div>
			</div><!-- END .socials -->
			<h2>Login With a TopCoder Account</h2>
			<form class="login" id="loginForm">
				<p class="row">
					<label>Username</label>
					<input id="username" type="text" class="name" placeholder="Username" />
					<span class="err1">Your username or password are incorrect</span>
					<span class="err2">Please input your password</span>
				</p>
				<p class="row">
					<label>Password</label>
					<input id="password" type="password" class="pwd" placeholder="Password"/>
				</p>
				
				<p class="row lSpace">
					<label><input type="checkbox" />Remember me</label>
				</p>
				<p class="row lSpace btns">
					<a href="javascript:;" class="signin-db btn btnSubmit">Login</a>
					<a href="http://community.topcoder.com/tc?module=FindUser" target="_blank" class="forgotPwd">Forgot password?</a>
				</p>
				<div class="clear"></div>
			</form><!-- END .form login -->
		</div>
	</div><!-- END #login -->


	<script>
  var auth0 = new Auth0({
    domain:         'topcoder.auth0.com',
    clientID:       '6ZwZEUo2ZK4c50aLPpgupeg5v2Ffxp9P',
    callbackURL:    'https://www.topcoder.com/reg2/callback.action',
    state:			'http://beta.topcoder.com/',
    redirect_uri:   'http://beta.topcoder.com/'
  });
 
  $('.signin-google').on('click', function() {
    auth0.login({
		connection: 'google-oauth2'}); 
	});
 
  $('.signin-facebook').on('click', function() {
    auth0.login({connection: 'facebook'}); 
  });
 
  $('.signin-twitter').on('click', function() {
    auth0.login({connection: 'twitter'}); 
  });
 
  $('.signin-github').on('click', function() {
    auth0.login({connection: 'github'}); 
  });
 
  $('.signin-etc').on('click', function() {
    auth0.login({connection: 'connection-name'}); 
  });
 
  $('.signin-db').on('click', function() {
    auth0.login({
      connection: 'LDAP', 
      state:      'http://beta.topcoder.com/', // this tells Auth0 to send the user back to the main site after login. Please replace the var for current page URL.
      username: document.getElementById('username').value, 
      password: document.getElementById('password').value
    },
    function (err) {
      // invalid user/password
    });
  });
</script>












</body>

</html>