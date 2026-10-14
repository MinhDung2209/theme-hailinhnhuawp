<?php
// WP 404 ALERTS @ http://wp-mix.com/wordpress-404-email-alerts/

// add_filter( 'wp_mail_content_type', '_change_email_content_type' );
// function _change_email_content_type( $content_type ) {
//     return 'text/html';
// }

// // set status
// header("HTTP/1.1 404 Not Found");
// header("Status: 404 Not Found");

// // site info
// $blog  = get_bloginfo('name');
// $site  = get_bloginfo('url') . '/';
// $email = get_bloginfo('admin_email');

// // theme info
// $theme_data = wp_get_theme();
// $theme = clean($theme_data->Name);
// //}

// // referrer
// if (isset($_SERVER['HTTP_REFERER'])) {
//     $referer = clean($_SERVER['HTTP_REFERER']);
// } else {
//     $referer = "undefined";
// }
// // request URI
// if (isset($_SERVER['REQUEST_URI']) && isset($_SERVER["HTTP_HOST"])) {
//     $request = clean('http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
// } else {
//     $request = "undefined";
// }
// // query string
// if (isset($_SERVER['QUERY_STRING'])) {
//     $string = clean($_SERVER['QUERY_STRING']);
// } else {
//     $string = "undefined";
// }
// // IP address
// if (isset($_SERVER['REMOTE_ADDR'])) {
//     $address = clean($_SERVER['REMOTE_ADDR']);
// } else {
//     $address = "undefined";
// }
// // user agent
// if (isset($_SERVER['HTTP_USER_AGENT'])) {
//     $agent = clean($_SERVER['HTTP_USER_AGENT']);
// } else {
//     $agent = "undefined";
// }
// // identity
// if (isset($_SERVER['REMOTE_IDENT'])) {
//     $remote = clean($_SERVER['REMOTE_IDENT']);
// } else {
//     $remote = "undefined";
// }
// // log time
// $time = clean(date("F jS Y, h:ia", time()));

// // sanitize
// function clean($string) {
//     $string = rtrim($string);
//     $string = ltrim($string);
//     $string = htmlentities($string, ENT_QUOTES);

//     if (get_magic_quotes_gpc()) {
//         $string = stripslashes($string);
//     }
//     return $string;
// }

// $message =
// "Thời gian: "       . $time    . "<br />" .
// "Địa chỉ 404: "     . $request . "<br />" .
// "Địa chỉ blog: "    . $site    . "<br />" .
// "Giao diện: "       . $theme   . "<br />" .
// "REFERRER: "        . $referer . "<br />" .
// "QUERY STRING: "    . $string  . "<br />" .
// "Địa chỉ IP: "  . $address . "<br />" .
// "REMOTE IDENTITY: " . $remote  . "<br />" .
// "Thông tin người dùng: " . $agent   . "<br /><br />";

// wp_mail($email, "404 Alert: " . $blog . " [" . $theme . "]", $message, "From: $email");
header("HTTP/1.1 301 Moved Permanently");
header("Location: ".get_bloginfo('url'));
exit();