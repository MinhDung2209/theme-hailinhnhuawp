<?php
/* ------------------ */
/* cactus_blog */
/* ------------------ */
function blog($atts,$content=NULL)
{
	wp_enqueue_style('blog.css', ''.get_template_directory_uri().'/shortcodes/includes/css/blog.css');
	extract(shortcode_atts(array(
		'count' => '5',
		'cat' => '',
		'tag' => '',
		'posts' => '',
		'order' => 'DESC',
		'orderby' => 'date',
		'meta_key' => '',
		'show_readmore' => true,
		'show_commentcount' => true,
		'show_categories' => true,
		'show_author' => true,
		'show_date' => true,
		'show_icon' => true,
		'show_title' => true,
		'title_has_link' => true
	),$atts));

	if($count == '' or $count < 1) $count = 5;
	$show_readmore = convertStrToBool($show_readmore);
	$show_commentcount = convertStrToBool($show_commentcount);
	$show_categories = convertStrToBool($show_categories);
	$show_author = convertStrToBool($show_author);
	$show_date = convertStrToBool($show_date);
	$show_icon = convertStrToBool($show_icon);
	$show_title = convertStrToBool($show_title);
	$title_has_link = convertStrToBool($title_has_link);

	$args = array(
		'post_type' => array('post'),
		'post_status' => array('publish'),
		'posts_per_page' => (int)$count,
	);

	if($posts != '')
	{
		$cat = '';
		$tag = '';
		$posts = explode(',',$posts);
		$post_in = array();
		foreach($posts as $post)
		{
			$post_in[] = $post;
		}
		$args['post__in'] = $post_in;
	}

	if($cat != '' and $posts == '')
	{
		if(is_int((int)$cat))
			$args['cat'] = $cat;
		else
			$args['category_name'] = trim($cat);
	}

	if($tag != '' and $posts == '')
	{
		if(is_int($tag))
			$args['tag_id'] = $tag;
		else
			$args['tag'] = trim($tag);
	}

	if($meta_key != '')
	{
		$args['meta_key'] = $meta_key;
	}

	$args['order'] = $order;
	$args['orderby'] = $orderby;

	$id = rand(1,100);

	$query = new WP_Query($args);

	if($query->have_posts()):

		$html .= '
	<div class="wrapper_section">
		<div id="sc-blog">
								<div id="owl-blog-'.$id .'" class="owl-carousel sc-blog">';

	while($query->have_posts()) : $query->the_post();

	$p_format = get_post_format(get_the_id());

		if(has_post_thumbnail())
			$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(),'thumb_360x264',true);
		else
			$thumbnail[0] = get_template_directory_uri()."/images/default-thumbnail.jpg";

		$html .= '
						            <div class="items">
						            	<div class="img_bt">
											<span class="gradient_blog"></span>
								            <a href="'.get_permalink().'">
								            	<img class="bn" class="bn" src="'.$thumbnail[0].'" alt="'.get_the_title().'"></a>';

					if((bool)$show_title == true)
					{
						if((bool)$title_has_link == true)
						{
							$html .= '
											<a href="'.get_permalink().'">
												<h5 class="title">
								            		'.get_the_title().'
								            	</h5>
										';

							$html .= '<span class="overlay_blog">
								';

					if($p_format == false or $p_format != 'video')
						$html .= '<i class="fa fa-search"></i> ';
					if($p_format == 'video')
						$html .= '<i class="fa fa-play-circle-o"></i>';

					$html .= '
												</span>';

							$html .= '
								            </a>';
						}
						else
						{
							$html .= '
												<h5 class="title">
								            		'.get_the_title().'
								            	</h5>';
							$html .= '
											<a href="'.get_permalink().'">';

							$html .= '<span class="overlay_blog">
										';

							if($p_format == false or $p_format != 'video')
								$html .= '<i class="fa fa-search"></i> ';
							if($p_format == 'video')
								$html .= '<i class="fa fa-play-circle-o"></i>';

							$html .= '
														</span>

													</a>';
						}
					}

					$html .= '
				                            <ul class="btn">
											';
		if($show_commentcount == true)
		{
			$html .='
						<li class="left"><div><a href="">'.get_comments_number(get_the_id()).'</a> <i class="fa fa-comments"></i></div> </li>';
		}

		if($show_categories == true)
		{
			$index = 0;
			$category = get_the_category(get_the_id());
			$html .= '<li class="right"><div>';
			foreach($category as $cate)
			{
				$index++;
				if(count(get_the_category(get_the_id()))>1)
				{
					if($index==count(get_the_category(get_the_id())))
					{
						$html .= '<a class="multi-cat" href="'.get_category_link($cate->cat_ID).'">'.$cate->name.'</a>';
					}
					else
					{
						$html .= '<a class="multi-cat" href="'.get_category_link($cate->cat_ID).'">'.$cate->name.',</a>&nbsp;';
					}

				}
				else
					$html .='
						<a href="'.get_category_link($cate->cat_ID).'">'.$cate->name.'</a>

		';
			}
			$html .= '</div></li>';
		}

		$html .= '</ul>';

		$html .='
						            	</div>
						            	<div class="text_sec">
										<div class="preview">
						            		<p class="content">
												'.get_the_excerpt().'
						            		</p>';

			if($show_readmore == true)
			{
				$html .= '
					<p class="readmore">
						<a href="'.get_permalink().'">read more<i class="fa fa-chevron-right"></i></a>
					</p>
				</div><!-- end preview -->
			';
			}

			if($show_author==true or $show_date==true)
			{
				$html .= '
					<ul class="blog_bto">';

			if($show_author == true)
			{
				$html .= '
							<li class="left">
								<a href>'.get_the_author().'</a>
							</li>';
			}

						$html .='
						            			<li class="right">	';

										if($show_date == true)
									{
										$html .= '
															<a class="date" href>'.get_the_date('d M Y').'</a>';
									}

										$html .='
						            			</li>
						            		</ul>';
			}
						            $html.=	'</div>

			                         </div>
	';

	endwhile;

	$html .= '
						</div>
				</div><!--End-blog-->
			</div><!-- end wrapper -->
	';

	endif;

	$html .= "<p>$content</p>";

	$html .= "
		<script type='text/javascript'>
			jQuery(document).ready(function() {
			jQuery('#owl-blog-".$id ."').owlCarousel({
				autoPlay: 100000,
				itemsCustom : [
				[0, 1],
				[450, 2],
				[600, 2],
				[700, 3],
				[1000, 3],
				[1200, 3],
				[1400, 3],
				[1600, 3]
			  ],
				responsive: true,
				responsiveRefreshRate : 200,
				responsiveBaseWidth: window,
			});

			});
		</script>
	";

	return $html;
}
add_shortcode( 'blog', 'blog' );

add_action( 'after_setup_theme', 'reg_blog' );
function reg_blog(){
	if(function_exists('wpb_map')){
	wpb_map( array(
	   "name" => __("Blog"),
	   "base" => "blog",
	   "class" => "",
	   "controls" => "full",
	   "category" => __('Content'),
	   "params" => array(
	      array(
			"type" => "textfield",
			"heading" => __("Total Posts", "cactusthemes"),
			"param_name" => "count",
			"value" => "",
			"description" => __("Total posts that you want to get."),
		  ),
		  array(
			"type" => "textfield",
			"heading" => __("Category", "cactusthemes"),
			"param_name" => "cat",
			"value" => "",
			"description" => __("The category id or category slug."),
		  ),
		  array(
			"type" => "textarea",
			"heading" => __("Tag", "cactusthemes"),
			"param_name" => "tag",
			"value" => "",
			"description" => __("The tag id or tag slug."),
		  ),
		  array(
			"type" => "textarea",
			"heading" => __("Post In", "cactusthemes"),
			"param_name" => "posts",
			"value" => "",
			"description" => __("Specifies the posts that you want to get."),
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Order By", 'cactusthemes'),
			 "param_name" => "orderby",
			 "value" => array(
			 	__('Date', 'cactusthemes') => 'date',
				__('None', 'cactusthemes') => 'none',
				__('ID', 'cactusthemes') => 'id',
				__('Author', 'cactusthemes') => 'author',
				__('Title', 'cactusthemes') => 'title',
				__('Name', 'cactusthemes') => 'name',
				__('Modified', 'cactusthemes') => 'modified',
				__('Parent', 'cactusthemes') => 'parent',
				__('Rand', 'cactusthemes') => 'rand',
				__('Comment Count', 'cactusthemes') => 'comment_count',
				__('Menu Order', 'cactusthemes') => 'menu_order',
				__('Meta Value', 'cactusthemes') => 'meta_value',
				__('Meta Value Number', 'cactusthemes') => 'meta_value_num',
				__('Post In', 'cactusthemes') => 'post__in',
			 ),
			 "description" => 'Order by'
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Order", 'cactusthemes'),
			 "param_name" => "order",
			 "value" => array(
			 	__('ASC', 'cactusthemes') => 'ASC',
			 	__('DESC', 'cactusthemes') => 'DESC',
			 ),
			 "description" => 'Order'
		  ),
		  array(
			"type" => "textarea",
			"heading" => __("Meta Key", "cactusthemes"),
			"param_name" => "meta_key",
			"value" => "",
			"description" => __("Name of metadata, just for ordering."),
		  ),
		   array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Show Readmore", 'cactusthemes'),
			 "param_name" => "show_readmore",
			 "value" => array(
			 	__('Show', 'cactusthemes') => 'true',
			 	__('Hide', 'cactusthemes') => 'false',
			 ),
			 "description" => 'Show/Hide readmore button.'
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Show Comment Count", 'cactusthemes'),
			 "param_name" => "show_commentcount",
			 "value" => array(
			 	__('Show', 'cactusthemes') => 'true',
			 	__('Hide', 'cactusthemes') => 'false',
			 ),
			 "description" => 'Show/Hide comment count.'
		  ),
		   array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Show Categories", 'cactusthemes'),
			 "param_name" => "show_categories",
			 "value" => array(
			 	__('Show', 'cactusthemes') => 'true',
			 	__('Hide', 'cactusthemes') => 'false',
			 ),
			 "description" => 'Show/Hide the categories.'
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Show Author", 'cactusthemes'),
			 "param_name" => "show_author",
			 "value" => array(
			 	__('Show', 'cactusthemes') => 'true',
			 	__('Hide', 'cactusthemes') => 'false',
			 ),
			 "description" => 'Show/Hide the author.'
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Show Date", 'cactusthemes'),
			 "param_name" => "show_date",
			 "value" => array(
			 	__('Show', 'cactusthemes') => 'true',
			 	__('Hide', 'cactusthemes') => 'false',
			 ),
			 "description" => 'Show/Hide the date.'
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Show Icon", 'cactusthemes'),
			 "param_name" => "show_icon",
			 "value" => array(
			 	__('Show', 'cactusthemes') => 'true',
			 	__('Hide', 'cactusthemes') => 'false',
			 ),
			 "description" => 'Show/Hide the icon.'
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Show Title", 'cactusthemes'),
			 "param_name" => "show_title",
			 "value" => array(
			 	__('Show', 'cactusthemes') => 'true',
			 	__('Hide', 'cactusthemes') => 'false',
			 ),
			 "description" => 'Show/Hide the title.'
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title Link", 'cactusthemes'),
			 "param_name" => "title_has_link",
			 "value" => array(
			 	__('Show', 'cactusthemes') => 'true',
			 	__('Hide', 'cactusthemes') => 'false',
			 ),
			 "description" => 'Set the link for the title or not.'
		  ),
	   )
	));
	}
}
?>