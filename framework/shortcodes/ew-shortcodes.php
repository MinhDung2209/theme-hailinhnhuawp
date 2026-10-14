<?php
global $shortcodes;
$shortcodes = array(
	'button','banner','heading','blog','icon',
	'iconbox','highlight','pricing','counter',
	'progress','percentage','dropcap','divider',
	'timeline','message','text','client','testimonials'
);

function convertStrToBool($str)
{
	if(is_string($str) and trim($str) === 'true')
		return true;
	elseif(is_string($str) and trim($str) === 'false')
		return false;
	elseif(is_int($str) and trim($str) === 1 or trim($str)==='1')
		return true;
	elseif(is_int($str) and trim($str) === 0 or trim($str)==='0')
		return false;
	elseif(is_bool($str) and $str === true)
		return true;
	elseif(is_bool($str) and $str === false)
		return false;
}

foreach($shortcodes as $shortcode)
{
	if($shortcode=='counter' or $shortcode=='progress' or $shortcode=='percentage')
	{
		include_once('animated-'.$shortcode.'.php');
		continue;
	}
	if($shortcode=='pricing')
	{
		include_once($shortcode.'-table.php');
		continue;
	}
	if($shortcode=='message')
	{
		include_once($shortcode.'box.php');
		continue;
	}
	include_once($shortcode.'.php');
}

// if(!defined(TEMPLATE_URL))
	// define('TEMPLATE_URL',get_bloginfo('template_url'));



/* ------------------------ */

// function social_chanels($atts,$content='')
// {
	// extract(shortcode_atts(array(
		// 'title'=>'SOCIAL CHANNELS',
		// 'facebook'=>'http://facebook.com',
		// 'twitter'=>'http://twitter.com',
		// 'youtube'=>'http://youtube.com'
	// ),$atts));

	// $html = '
		// <div class="soicial">
									// <div class="channels">
										// <h2>
											// <a href="">
												// '.$title.'
											// </a>
										// </h2>
										// <p>
										// '.$content.'
										// </p>
										// <ul class="icon">
											// <li>
												// <a href="'.$twitter.'">
													// <i class="fa fa-twitter"></i>
												// </a>
											// </li>
											// <li>
												// <a href="'.$facebook.'">
													// <i class="fa fa-facebook"></i>
												// </a>
											// </li>
											// <li>
												// <a href="'.$youtube.'">
													// <i class="fa fa-youtube"></i>
												// </a>
											// </li>
										// </ul>
									// </div><!--End-channels-->
		// </div>
	// ';

	// return $html;
// }
// add_shortcode('socialchanels','social_chanels');

// function simpletext($atts,$content='')
// {
	// extract(shortcode_atts(array(
		// 'title'=>'SIMPLE TEXT',
		// 'img'=>'http://demo.cactusthemes.com/signals/html/images/img_simple.jpg',
	// ),$atts));

	// $html = '
	// <div class="soicial">
		// <div class="simple">
										// <h2>
											// <a href="javascript:void()">
												// '.$title.'
											// </a>
										// </h2>
										// <div class="text">

												// <a href="javascript:void()">
													// <img src="'.$img.'">
												// </a>


												// <p>
													// '.$content.'
												// </p>

										// </div>
									// </div>
								// </div>
	// ';

	// return $html;
// }
// add_shortcode('simpletext','simpletext');


?>