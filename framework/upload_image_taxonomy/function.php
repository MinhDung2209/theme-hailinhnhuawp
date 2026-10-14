<?php
// taxonomy product-cat
add_action('product-cat_add_form_fields', 'add_term_image', 10, 2);
function add_term_image($taxonomy){
    ?>
    <div class="form-field term-group">
        <label for="">Upload and Image</label>
        <input type="text" name="txt_upload_image" id="txt_upload_image" value="" style="width: 77%">
        <input type="button" id="upload_image_btn" class="button" value="Upload an Image" />
    </div>
    <?php
}

add_action('created_product-cat', 'save_term_image', 10, 2);
function save_term_image($term_id, $tt_id) {
    if (isset($_POST['txt_upload_image']) && '' !== $_POST['txt_upload_image']){
        $group = $_POST['txt_upload_image'];
        add_term_meta($term_id, 'term_image', $group, true);
    }
}

add_action('product-cat_edit_form_fields', 'edit_image_upload', 10, 2);
function edit_image_upload($term, $taxonomy) {
    // get current group
    $txt_upload_image = get_term_meta($term->term_id, 'term_image', true);
?>
    <div class="form-field term-group">
        <label for="">Upload and Image</label>
        <input type="text" name="txt_upload_image" id="txt_upload_image" value="<?php echo $txt_upload_image ?>" style="width: 77%">
        <input type="button" id="upload_image_btn" class="button" value="Upload an Image" />
    </div>
<?php
}

add_action('edited_product-cat', 'update_image_upload', 10, 2);
function update_image_upload($term_id, $tt_id) {
    if (isset($_POST['txt_upload_image']) && '' !== $_POST['txt_upload_image']){
        $group = $_POST['txt_upload_image'];
        update_term_meta($term_id, 'term_image', $group);
    }
}

add_action( 'admin_enqueue_scripts', 'image_uploader_enqueue' );
function image_uploader_enqueue() {
    global $typenow;
    if( ($typenow == 'product') ) {
        wp_enqueue_media();

        wp_register_script( 'meta-image', get_template_directory_uri() . '/framework/upload_image_taxonomy/media-uploader.js', array( 'jquery' ) );
        wp_localize_script( 'meta-image', 'meta_image',
            array(
                'title' => 'Upload an Image',
                'button' => 'Use this Image',
            )
        );
        wp_enqueue_script( 'meta-image' );
    }
}