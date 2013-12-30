<?php
/*
Template Name: Verify Captcha
*/
    require_once('recaptchalib.php');
    $privatekey = "6Le4KusSAAAAAHxH8ubhbNjT2r4oOYDYxS7bmhpS";
    $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

    if (!$resp->is_valid) {
        // What happens when the CAPTCHA was entered incorrectly
        $host = "http://test.bjc.co.ke/blog";
        header( "Location: $host/contact-us/" );
    } else {
        var_dump($_POST);
        die();
    }
?>