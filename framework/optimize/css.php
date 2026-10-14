<?php 
/* ---------------------------------
26 January, 2008 - 2:55pm:
<!-- http://websitetips.com/articles/optimization/css/crunch/ -->
Adapted for WebsiteTips.com by Shirley Kaiser, SKDesigns skdesigns.com.

1. The cache-control and gzip compression is adapted from 
The Definitive Post on Gzipping your CSS
by Mike Papageorge, Fiftyfoureleven.com
<!-- http://www.fiftyfoureleven.com/weblog/web-development/css/the-definitive-css-gzip-method-->
2. Function compress is adapted from 
<!-- http://www.webmasterworld.com/php/3361456.htm -->
which removes extraneous whitespace: line breaks, carriage returns,
plus CSS comments.

This PHP code goes at the very TOP of the PHP-enabled style sheet 
above EVERYTHING else.
--------------------------------- */
/* initialize ob_gzhandler to send and compress data */
ob_start ("ob_gzhandler");
/* initialize compress function for whitespace removal */
ob_start("compress");
/* required header info and character set */
header("Content-type: text/css;charset: UTF-8");
/* cache control to process */
header("Cache-Control: must-revalidate");
/* duration of cached content (1 hour) */
$offset = 60 * 60 ; 
/* expiration header format */
$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s",time() + $offset) . " GMT";
/* send cache expiration header to broswer */
header($ExpStr);
/* Begin function compress */
function compress($buffer) {
    /* remove comments */
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    /* remove tabs, spaces, new lines, etc. */        
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    /* remove unnecessary spaces */        
    $buffer = str_replace('{ ', '{', $buffer);
    $buffer = str_replace(' }', '}', $buffer);
    $buffer = str_replace('; ', ';', $buffer);
    $buffer = str_replace(', ', ',', $buffer);
    $buffer = str_replace(' {', '{', $buffer);
    $buffer = str_replace('} ', '}', $buffer);
    $buffer = str_replace(': ', ':', $buffer);
    $buffer = str_replace(' ,', ',', $buffer);
    $buffer = str_replace(' ;', ';', $buffer);
    
    return $buffer;
}