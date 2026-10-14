<?php
add_action('widgets_init', 'hongtq_product_by_cate_home');
function hongtq_product_by_cate_home() {
        register_widget('hongtq_product_by_cate_home');
}
class hongtq_product_by_cate_home extends WP_Widget {
	/*-----------------------------------------------------------------------------------*/
	/*	Widget Setup
	/*-----------------------------------------------------------------------------------*/

    function __construct() {
        $widget_ops = array(
            'classname' => 'list-product',
            'description' => __('HongTQ: Bài đăng đấu giá theo chuyên mục - Content Home', 'hongtq_dev')
        );
        parent::__construct('hongtq_product_by_cate_home', __('HongTQ: Bài đăng đấu giá theo chuyên mục - Content Home', 'hongtq_dev'), $widget_ops);
        // Upload
        add_action('admin_enqueue_scripts', array($this, 'ew_script'));
        // Color Picker
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts') );
		add_action('admin_footer-widgets.php', array($this, 'print_scripts'), 9999 );
    }

    public function ew_script() {
        wp_enqueue_media();
        wp_enqueue_script('script', get_template_directory_uri() . '/framework/widgets/module/js/script.js', null, null, true);
    }

    public function enqueue_scripts($hook_suffix ) {
		if ('widgets.php' !== $hook_suffix ) {
			return;
		}

		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_script('underscore');
	}

	public function print_scripts() { ?>
		<script>
			( function($ ){
				function initColorPicker( widget ) {
					widget.find('.color-picker').wpColorPicker( {
						change: _.throttle( function() { // For Customizer
							$(this).trigger('change');
						}, 3000 )
					});
				}

				function onFormUpdate( event, widget ) {
					initColorPicker( widget );
				}

				$( document ).on('widget-added widget-updated', onFormUpdate );

				$( document ).ready( function() {
					$('#widgets-right .widget:has(.color-picker)').each( function () {
						initColorPicker($( this ) );
					} );
				} );
			}( jQuery ) );
		</script>
		<?php
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Display Widget
	/*-----------------------------------------------------------------------------------*/

    function widget($args, $instance) {
        extract($args);
        global $post;
        $title = apply_filters('widget_title', $instance['title']);
        $cat = $instance['cats'];
        $number = $instance['number'];
        $image = $instance['image'];
        $cat_id = +$cat[0];
        $location = $instance['location'];

        $taxonomy_name = 'product-cat';
        echo $before_widget;?>
		 <section class="sec-estate wow <?php if($location == 0) echo 'slideInLeft'; else echo 'slideInRight'; ?>" data-wow-time="1s" data-wow-delay="1s">
		   <div class="row">
		      <div class="col-md-3">
		         <div class="card text-center">
		            <img loading="lazy" class="card-img-top" src="<?php echo $image; ?>" alt="<?php echo $title;?>" width="100%" height="300px">
		            <div class="card-img-overlay">
		               <h2 class="card-title"><strong><?php echo $title;?></strong></h2>
		               <a href="<?php echo get_term_link($cat_id, $taxonomy_name); ?>" class="btn btn-primary btn-custom">Xem tất cả</a>
		            </div>
		         </div>
		      </div>
		      <div class="col-md-9">
		         <div class="row">
		            <?php
		            $tax_post_args = array(
		               'post_type' => 'product',
		               'order' => 'ASC',
		               'showposts' => $number,
		               'tax_query' => array(
		                  array(
		                     'taxonomy' => $taxonomy_name,
		                     'field' => 'term_id',
		                     'terms' => $cat_id
		                     )
		                  )
		               );
		            $tax_post_qry = new WP_Query($tax_post_args);
		            if($tax_post_qry->have_posts()) {
		               while($tax_post_qry->have_posts()) {
		               $tax_post_qry->the_post();
		               $time_start = get_post_meta(get_the_ID(), 'time_start', true );
		               $price_start = get_post_meta(get_the_ID(), 'price_start', true );
		               $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>
		               <div class="col-md-6">
		                  <div class="media border">
		                     <a href="<?php the_permalink(); ?>">
		                        <img loading="lazy" src="<?php echo $featured_img_url; ?>" alt="<?php the_title(); ?>" class="mr-3 object-fit-cover">
		                     </a>
		                     <div class="media-body">
		                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		                        <?php
		                        if ($price_start) {
		                           echo '<p>Giá khởi điểm:</p>';
		                           echo '<p class="card-prince">'.$price_start.'</p>';
		                        } else {
		                            echo '<p>&nbsp;</p>';
		                            echo '<p>&nbsp;</p>';
		                        }

		                        if ($time_start) {
		                           echo '<p>Thời gian: '.$time_start.'</p>';
		                        } else {
		                           echo '<p>&nbsp;</p>';
		                        } ?>
		                     </div>
		                  </div>
		               </div>
		               <?php }
		            } ?>
		         </div>
		      </div>
		   </div>
		</section>
        <?php echo $after_widget;?>
	<?php }

	/*-----------------------------------------------------------------------------------*/
	/*	Update Widget
	/*-----------------------------------------------------------------------------------*/
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['cats'] = $new_instance['cats'];
        $instance['number'] = $new_instance['number'];
        $instance['image'] = $new_instance['image'];
        $instance['location'] = $new_instance['location'];
        delete_transient($this->id);

		return $instance;
	}
	/*-----------------------------------------------------------------------------------*/
	/*	Widget Settings (Displays the widget settings controls on the widget panel)
	/*-----------------------------------------------------------------------------------*/

	function form($instance) {
		// Defaults
		$instance = wp_parse_args(
			$instance
		);

		$location = isset($instance['location']) ? absint($instance['location']) : 0;
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 4;
        $image = $instance['image'];
        $img_style    = ( !empty($image) ) ? 'style="max-width:100%; display: block"' : 'style="display:none"';
        $button_style = ( !empty($image) ) ? '' : 'style="display:none"';
        $no_img_style = ( !empty($image) ) ? 'style="display:none;"' : 'style="border: 1px solid #ddd; padding: 10px; text-align: center; border-radius: 2px; margin: 10px 0; display: block"';
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title</label></br>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
        <p>
        	<label>Vị trí bắt đầu chạy hiệu ứng:</label><br>
        	<?php
        	$locations = array(0,1);
        	foreach ($locations as $item) {
        		if (isset($instance['location'])) $location = $instance['location']; ?>
        		<input type="radio" id="<?php echo $this->get_field_id('location'); ?>" name="<?php echo $this->get_field_name('location'); ?>" value="<?php echo $item; ?>" <?php if($location == $item) echo 'checked'; ?> >
        		<?php if($item == 0) echo 'Trái'; else echo 'Phải'; echo '&nbsp;&nbsp;&nbsp;';
        	} ?>
        </p>
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>">Số bài viết</label><br>
			<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" value="<?php echo $number; ?>" size="3" />
		</p>
        <p>
            <label>Banner hiển thị: </label>
            <img id="<?php echo $this->get_field_id('image'); ?>-preview" src="<?php echo esc_attr($instance['image']); ?>" <?php echo $img_style; ?> />
            <span id="<?php echo $this->get_field_id('image'); ?>-noimg" <?php echo $no_img_style; ?>>No image selected</span>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('image'); ?>">URL banner: </label>
            <input id="<?php echo $this->get_field_id('image'); ?>-url" type="text" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $image; ?>" class="widefat" readonly/>
        </p>
        <p>
            <?php $button_text = ($instance['image'] != '') ? 'Đổi ảnh' : 'Chọn ảnh'; ?>
            <input type="button" value="<?php echo $button_text; ?>" class="button custom_media_upload" id="<?php echo $this->get_field_id('image'); ?>-button"/>
            <input type="button" value="Remove" class="button ew-media-remove" id="<?php echo $this->get_field_id('image'); ?>-remove" <?php echo $button_style; ?> />
        </p>
		<p>
			<label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e('Lựa chọn danh mục', 'hongtq_dev'); ?>
				<?php
				$args = array(
                    'orderby' => 'count',
                );
                $terms = get_terms('product-cat', $args);
				echo "<br/>";
				$i=1;
				foreach ($terms as $cat) {
					$option = '<input type="radio" id="' . $this->get_field_id('cats') . '[]" name="' . $this->get_field_name('cats') . '[]"';
					if (isset($instance['cats'])) {
						foreach ($instance['cats'] as $cats) {
							if ($cats == $cat->term_id) {
								$option = $option . ' checked="checked"';
							}
						}
					}else{
						if($i == 1){
							$option = $option . ' checked="checked"';
						}
					}
					$option .= ' value="' . $cat->term_id . '" />';
					$option .= '&nbsp;';
					$option .= $cat->name;
					$option .= '&nbsp;('.$cat->count.' bài viết)';
					$option .= '<br />';
					echo $option;
					$i++;
				}
				?>
			</label>
		</p>
		<?php
	}
}