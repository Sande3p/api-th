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

<?php
	$postObj = get_post($post->ID);
	$twitterText = urlencode(wrap_content_strip_html(wpautop($postObj->post_content), 130, true,'\n\r',''));
	$title = htmlspecialchars($postObj->post_title);
	$subject = htmlspecialchars(get_bloginfo('name')).' : '.$title;
	$body = htmlspecialchars($postObj->post_content);
	$emailBody = get_permalink();
	$email_article = 'mailto:?subject='.rawurlencode($subject).'&amp;body='.$emailBody;
	$twitterShare = "http://twitter.com/home?status=".$twitterText;
	$fbShare = "http://www.facebook.com/sharer/sharer.php?s=100&amp;p[url]=".get_permalink()."&amp;p[images][0]=".$imageUrl."&amp;p[title]=".get_the_title()."&amp;p[summary]=".$twitterText;
	$gplusShare = "https://plus.google.com/share?url=".get_permalink();
	$linkedShare = "http://www.linkedin.com/shareArticle?mini=true&url=".get_permalink()."&title=".get_the_title()."&summary=".$twitterShare."&source=";
?>
<div class="socialShare">
	<a href="<?php echo $twitterShare;?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/i/shareb-twitter.png" width="30" height="32" alt="" /></a>
	<a href="<?php echo $fbShare;?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/i/shareb-fb.png" width="30" height="32" alt="" /></a>
	<a href="<?php echo $linkedShare;?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/i/shareb-linked.png" width="30" height="32" alt="" /></a>
	<a href="<?php echo $gplusShare;?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/i/shareb-gplus.png" width="30" height="32" alt="" /></a>
	<a href="<?php echo $email_article;?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/i/shareb-email.png" width="30" height="32" alt="" /></a>
</div>	

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
					<form id="emailForm" method="post" action="http://www.topcoder.com/newsletter/" onsubmit="return newsletter_check(this)" name="FeedBlitz_9feab01d431311e39e69002590771423" style="display:block" method="POST" action="http://www.feedblitz.com/f/f.fbz?AddNewUserDirect">
						<input type="email" class="email" name="EMAIL" placeholder="Your email address" maxlength="64" />
						<input name="FEEDID" type="hidden" value="926643" /> 
						<input name="PUBLISHER" type="hidden" value="34610190" />
						<a class="btn" id="btnGetUpdates">Submit</a>
						<input onclick="FeedBlitz_9feab01d431311e39e69002590771423s(this.form);" type="button" class="btn btnSubmit" value="Submit"/>
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
					<label>First Name</label>
					<input type="text" class="name firstName" placeholder="First Name"/>
					<span class="err1">Required field</span>
					<span class="valid"></span>
				</p>
				<p class="row">
					<label>Last Name</label>
					<input type="text" class="name lastName" placeholder="Last Name"/>
					<span class="err1">Required field</span>
					<span class="valid"></span>
				</p>
				<p class="row">
					<label>Handle</label>
					<input type="text" class="handle name" placeholder="Handle"/>
					<span class="err1">Required field</span>
					<span class="err2">Handle already exists</span>
					<span class="valid"></span>
				</p>
				<p class="row">
					<label>Country</label>
					<select name="user.country" id="selCountry">
						<option value="">Please Select</option>
					<option value="Afganistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bonaire">Bonaire</option>
<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
<option value="Brunei">Brunei</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Canary Islands">Canary Islands</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Channel Islands">Channel Islands</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos Island">Cocos Island</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cote DIvoire">Cote D'Ivoire</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Curaco">Curacao</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor">East Timor</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands">Falkland Islands</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Ter">French Southern Ter</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Great Britain">Great Britain</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Hawaii">Hawaii</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Isle of Man">Isle of Man</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Korea North">Korea North</option>
<option value="Korea Sout">Korea South</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Laos">Laos</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libya">Libya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macau">Macau</option>
<option value="Macedonia">Macedonia</option>
<option value="Madagascar">Madagascar</option>
<option value="Malaysia">Malaysia</option>
<option value="Malawi">Malawi</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Midway Islands">Midway Islands</option>
<option value="Moldova">Moldova</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Nambia">Nambia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherland Antilles">Netherland Antilles</option>
<option value="Netherlands">Netherlands (Holland, Europe)</option>
<option value="Nevis">Nevis</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau Island">Palau Island</option>
<option value="Palestine">Palestine</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Phillipines">Philippines</option>
<option value="Pitcairn Island">Pitcairn Island</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Republic of Montenegro">Republic of Montenegro</option>
<option value="Republic of Serbia">Republic of Serbia</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russia">Russia</option>
<option value="Rwanda">Rwanda</option>
<option value="St Barthelemy">St Barthelemy</option>
<option value="St Eustatius">St Eustatius</option>
<option value="St Helena">St Helena</option>
<option value="St Kitts-Nevis">St Kitts-Nevis</option>
<option value="St Lucia">St Lucia</option>
<option value="St Maarten">St Maarten</option>
<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
<option value="Saipan">Saipan</option>
<option value="Samoa">Samoa</option>
<option value="Samoa American">Samoa American</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syria</option>
<option value="Tahiti">Tahiti</option>
<option value="Taiwan">Taiwan</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Erimates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States of America">United States of America</option>
<option value="Uraguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Vatican City State">Vatican City State</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Vietnam</option>
<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
<option value="Wake Island">Wake Island</option>
<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
<option value="Yemen">Yemen</option>
<option value="Zaire">Zaire</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
					</select>
					<span class="err1">Required field</span>
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
					<label><input type="checkbox">I agree to the <a target="_blank" href="/customers/how-it-works/terms/">terms of service</a> and <a target="_blank" href="/customers/how-it-works/privacy-policy/">privacy policy</a>*</label>
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
		connection: 'google-oauth2',
        state:      'http://beta.topcoder.com/'}); // this tells Auth0 to send the user back to the main site after login. Please replace the var for current page URL.
	});
 
  $('.signin-facebook').on('click', function() {
    auth0.login({connection: 'facebook', 
    state:      'http://beta.topcoder.com/'}); // this tells Auth0 to send the user back to the main site after login. Please replace the var for current page URL.
  });
 
  $('.signin-twitter').on('click', function() {
    auth0.login({connection: 'twitter', 
    state:      'http://beta.topcoder.com/'}); // this tells Auth0 to send the user back to the main site after login. Please replace the var for current page URL.
  });
 
  $('.signin-github').on('click', function() {
    auth0.login({connection: 'github',
    state:      'http://beta.topcoder.com/'});  // this tells Auth0 to send the user back to the main site after login. Please replace the var for current page URL.
  });
 
  $('.signin-etc').on('click', function() {
    auth0.login({connection: 'connection-name', 
    state:      'http://beta.topcoder.com/'}); // this tells Auth0 to send the user back to the main site after login. Please replace the var for current page URL.
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