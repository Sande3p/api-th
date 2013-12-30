<?php
/*
Template Name: Contact Us
*/
?>
<?php 
/**
 * Enqueue scripts and styles those where used only on this template
 */
add_action ( 'wp_enqueue_scripts', 'contact_us_inc_style' );
function contact_us_inc_style() {
	wp_register_style ( 'member.css',  get_bloginfo( 'stylesheet_directory' ).'/css/members.css');
	wp_enqueue_style ( 'member.css' );
	wp_register_script ( 'member.js', get_bloginfo( 'stylesheet_directory' ).'/js/member.js');
	wp_enqueue_script ( 'member.js' );
}
?>
<?php get_header(); ?>

        <div class="content contact">
            <div id="main">
                <?php if(have_posts()) : the_post();?>
                        <?php the_content();?>
                <?php endif; wp_reset_query();?>

                <article id="mainContent" class="splitLayout ">
                    <div class="container">
                        <div class="contactForm">
                            <!--<?php /*echo do_shortcode( '[contact-form-7 id="8" title="Contact form 1"]'); */?>-->
                            <form method="post" action="<?php bloginfo('wpurl'); ?>/verify" id="contactForm">
                                <div class="row errormsg hide">
                                <p>Please enter valid details for highlighted field(s).</p>
                                </div>
                                <div class="row">
                                        <label for="fn">First Name</label>
                                        <div class="val">
                                                <input id="fn" name="fn" type="text" />
                                        </div>
                                </div>
                                <div class="row">
                                        <label for="ln">Last Name</label>
                                        <div class="val">
                                                <input id="ln" name="ln" type="text" />
                                        </div>
                                </div>
                                <div class="row">
                                        <label for="ea">Email Address</label>
                                        <div class="val">
                                                <input id="ea" name="ea" type="email" />
                                        </div>
                                </div>
                                <div class="row">
                                        <label for="desc">Description</label>
                                        <div class="val">
                                                <textarea id="desc" name="desc" class="textarea"></textarea>
                                        </div>
                                </div>
                                <div class="row rowCap">
                                        <label for="ca">Captcha</label>
                                    <?php
                                        require_once("recaptchalib.php");
                                        $publickey = "6Le4KusSAAAAAIdEQTPwOIWQZRIWG4efzyuAbGr8";
                                        echo recaptcha_get_html($publickey);
                                    ?>
                                </div>
                                <div class="action">
                                        <a class="btn btnSubmit" href="javascript:;">Submit</a>
                                </div>
                            </form>
                        </div>
                        <!-- /.contactForm -->
                    </div>
                </article>
                <!-- /#mainContent -->

<?php get_footer(); ?>
