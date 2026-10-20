<?php
/**
 * Hai Linh v2 - Bo sung giao dien moi (10/2026)
 *
 * - 7 dong san pham (product-cat) + bang ma hang (product); dong Filler co 7 muc con
 * - Hero trang chu, dai so lieu, nut noi Profile / Contact
 * - Quality & Certificates, Library, Contact & Map, mang xa hoi
 *
 * Moi noi dung deu nhap trong wp-admin:
 *   + Theme Options  > tab "Hai Linh - Trang chu & lien he"
 *   + Products       > Product categories (dong san pham)
 *   + Products       > All products (tung ma hang)
 *   + Languages      > Translations (chu tren giao dien, nhom "Hai Linh v2")
 */

if (!defined('ABSPATH')) exit;

define('HL_V2_VERSION', '2.2.0');

/*-----------------------------------------------------------------------------------*/
/*  Chu tren giao dien (dich qua Polylang > Translations, nhom "Hai Linh v2")
/*-----------------------------------------------------------------------------------*/
function hl_strings() {
    return array(
        'hero_title'        => 'HAI LINH PLASTIC CO.,LTD',
        'hero_subtitle'     => 'Filler & Additive Masterbatch Manufacturer from Vietnam',
        'hero_desc'         => 'Breathable-film compound, Talc, White masterbatch, Bio filler and PE/PP/HDPE CaCO3 filler - consistent quality for export customers.',
        'hero_question'     => 'Do you want to know more about filler masterbatch?',
        'hero_question_text' => 'In the world of plastics, the term "filler masterbatch" has gained significant importance. But what exactly is filler masterbatch? In simple terms, filler masterbatch, also known as plastic filler, is a composite material made by combining CaCO3 (calcium carbonate) powder with virgin resin and specific additives.',
        'btn_view_products' => 'View Products',
        'btn_request_quote' => 'Request a Quote',
        'btn_quote_short'   => 'Request quote',
        'btn_profile'       => 'Profile',
        'btn_contact'       => 'Contact',
        'btn_view_grades'   => 'View grades',
        'btn_send_inquiry'  => 'Send inquiry',
        'btn_download_profile' => 'Download Profile / Catalog',
        'btn_back_to_line'  => 'Back to product line',
        'btn_ask_quote'     => 'ASK FOR A QUOTE',
        'btn_view_details'  => 'View details',
        'related_products'  => 'Related products',
        'sub_items_title'   => 'Applications',
        'products_title'    => 'Our Products',
        'products_desc'     => 'Seven product lines for film, fiber, injection, hygiene and engineering plastics.',
        'filler_ratio'      => 'Filler ratio range (0-100%)',
        'grade_code'        => 'Grade code',
        'grade_resin'       => 'Base resin',
        'grade_filler'      => 'Filler loading',
        'other_grades'      => 'Other grades in this line',
        'products_note'     => 'Listed in priority order 1-7. Filler ratio = % filler by weight in the masterbatch.',
        'other_products'    => 'Other products',
        'factory_title'     => 'Our factory',
        'factory_desc'      => 'Compounding lines, raw-material storage and packing under one roof in Mai Village, Dan Chu Commune, Phu Tho Province.',
        'cert_title'        => 'Quality you can verify',
        'cert_desc'         => 'Our quality management system is certified to ISO 9001:2015 for the production of plastic additives. Check the certificate online with the retrieval code on the document.',
        'cert_more'         => 'Certificates & test reports',
        'btn_verify_cert'   => 'Verify certificate',
        'click_to_enlarge'  => 'Click to enlarge',
        'export_title'      => 'Packed for export',
        'export_desc'       => "25 kg bags on wooden pallets, stretch-wrapped, loaded into 20' and 40' containers at our factory. We send loading photos before the container leaves.",
        'library_title'     => 'Library',
        'library_videos'    => 'Videos',
        'library_photos'    => 'Photos: Factory - Products - Team',
        'contact_title'     => 'Contact & Location',
        'contact_address'   => 'Address',
        'contact_email'     => 'Email',
        'contact_phone'     => 'Tel / WhatsApp / Zalo',
        'company_name'      => 'HAI LINH PLASTIC CO.,LTD',
        'sales_domestic'    => 'Contact for domestic sales:',
        'sales_intl'        => 'Contact for international sales:',
    );
}

/**
 * Lay chu theo ngon ngu hien tai. Neu chua dich thi hien chu mac dinh (tieng Anh).
 */
function hl_t($key) {
    $strings = hl_strings();
    $text = isset($strings[$key]) ? $strings[$key] : $key;
    return function_exists('pll__') ? pll__($text) : $text;
}

function hl_e($key) {
    echo esc_html(hl_t($key));
}

add_action('init', function () {
    if (is_admin() && function_exists('pll_register_string')) {
        foreach (hl_strings() as $key => $text) {
            pll_register_string('hl_' . $key, $text, 'Hai Linh v2', strlen($text) > 60);
        }
    }
});

/*-----------------------------------------------------------------------------------*/
/*  CSS / JS
/*-----------------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('hailinh-v2', THEME_URL . '/css/hailinh-v2.css', array('style'), HL_V2_VERSION);
    wp_enqueue_script('hailinh-v2', THEME_URL . '/js/hailinh-v2.js', array(), HL_V2_VERSION, true);
}, 20);

/*-----------------------------------------------------------------------------------*/
/*  Theme options (tab moi trong Theme Options)
/*-----------------------------------------------------------------------------------*/
add_action('init', function () {
    if (function_exists('ot_settings_id')) {
        add_filter(ot_settings_id() . '_args', 'hl_theme_options');
    }
}, 1);

function hl_theme_options($settings) {
    $section = 'hl_v2_settings';
    $settings['sections'][] = array(
        'id'    => $section,
        'title' => 'Hai Linh - Trang chủ & liên hệ',
    );

    $fields = array(
        array(
            'id'    => 'hl_info_tab',
            'label' => 'Hướng dẫn',
            'desc'  => '<p>Các mục dưới đây điều khiển giao diện mới (Hero, số liệu, chứng chỉ, Library, bản đồ, nút Profile/Contact, mạng xã hội).</p><p>Chữ trên giao diện (tiêu đề, nút bấm...) sửa và dịch tại <b>Languages &gt; Translations</b>, nhóm <b>Hai Linh v2</b>.</p>',
            'type'  => 'textblock-titled',
        ),
        array(
            'id'    => 'hl_hero_bg',
            'label' => 'Ảnh nền Hero trang chủ',
            'desc'  => 'Ảnh ngang, tối thiểu 1600px chiều rộng. Bỏ trống = dùng ảnh nhà máy mặc định.',
            'type'  => 'upload',
        ),
        array(
            'id'       => 'hl_stats',
            'label'    => 'Dải số liệu dưới Hero',
            'desc'     => 'Mỗi dòng: Tiêu đề = con số lớn (VD: 20+), Nhãn = chữ nhỏ bên dưới (VD: Grade codes). Bỏ trống = dùng số mặc định.',
            'type'     => 'list-item',
            'settings' => array(
                array('id' => 'label', 'label' => 'Nhãn (chữ nhỏ)', 'type' => 'text'),
            ),
        ),
        array(
            'id'    => 'hl_profile_url',
            'label' => 'Link nút "Profile"',
            'desc'  => 'Link trang giới thiệu hoặc file PDF profile. Bỏ trống = về trang chủ.',
            'type'  => 'text',
        ),
        array(
            'id'    => 'hl_contact_url',
            'label' => 'Link nút "Contact" / "Request quote"',
            'desc'  => 'Bỏ trống = tự động dùng trang Contact của web.',
            'type'  => 'text',
        ),
        array(
            'id'    => 'hl_profile_file',
            'label' => 'File Profile / Catalog (PDF)',
            'desc'  => 'Upload file PDF. Hiện nút "Download Profile / Catalog" ở mục Contact & Location.',
            'type'  => 'upload',
        ),
        array(
            'id'    => 'hl_factory_photos',
            'label' => 'Our factory - Ảnh nhà máy (6 ảnh)',
            'desc'  => 'Chọn ảnh theo thứ tự muốn hiện. Chú thích dưới ảnh = ô "Caption" (Chú thích) của ảnh trong Media. Không có ảnh = ẩn mục này.',
            'type'  => 'gallery',
        ),
        array(
            'id'    => 'hl_cert_image',
            'label' => 'Quality - Ảnh chứng chỉ chính (ISO)',
            'desc'  => 'Ảnh scan/chụp chứng chỉ. Bấm vào ảnh trên web sẽ phóng to. Không có ảnh và không có chứng chỉ phụ = ẩn mục Quality.',
            'type'  => 'upload',
        ),
        array(
            'id'    => 'hl_cert_points',
            'label' => 'Quality - Các dòng có dấu tích',
            'desc'  => 'Mỗi dòng 1 ý. VD: Certificate No. ..., Valid until ...',
            'type'  => 'textarea-simple',
            'rows'  => 4,
        ),
        array(
            'id'    => 'hl_cert_verify_url',
            'label' => 'Quality - Link nút "Verify certificate"',
            'desc'  => 'Trang tra cứu chứng chỉ của đơn vị cấp. Bỏ trống = ẩn nút.',
            'type'  => 'text',
        ),
        array(
            'id'       => 'hl_certificates',
            'label'    => 'Quality - Chứng chỉ / test report khác',
            'desc'     => 'Mỗi dòng 1 chứng chỉ: Tiêu đề + ảnh. Hiện thành lưới dưới chứng chỉ chính.',
            'type'     => 'list-item',
            'settings' => array(
                array('id' => 'image', 'label' => 'Ảnh chứng chỉ', 'type' => 'upload'),
            ),
        ),
        array(
            'id'    => 'hl_export_photos',
            'label' => 'Packed for export - Ảnh đóng hàng (2 ảnh)',
            'desc'  => 'Không có ảnh = ẩn mục này.',
            'type'  => 'gallery',
        ),
        array(
            'id'    => 'hl_export_points',
            'label' => 'Packed for export - Các dòng có dấu tích',
            'desc'  => 'Mỗi dòng 1 ý.',
            'type'  => 'textarea-simple',
            'rows'  => 3,
        ),
        array(
            'id'       => 'hl_library_videos',
            'label'    => 'Library - Video (YouTube)',
            'desc'     => 'Mỗi dòng 1 video: Tiêu đề + link YouTube. Video nên up lên YouTube, không up thẳng lên web.',
            'type'     => 'list-item',
            'settings' => array(
                array('id' => 'youtube', 'label' => 'Link YouTube', 'type' => 'text'),
            ),
        ),
        array(
            'id'    => 'hl_library_photos',
            'label' => 'Library - Ảnh nhà máy / sản phẩm / đội ngũ',
            'desc'  => 'Chọn nhiều ảnh cùng lúc. Không có ảnh và video = ẩn mục Library.',
            'type'  => 'gallery',
        ),
        array(
            'id'    => 'hl_address',
            'label' => 'Địa chỉ (mục Contact & Location)',
            'desc'  => 'Bỏ trống = dùng địa chỉ ở footer.',
            'type'  => 'textarea-simple',
            'rows'  => 2,
        ),
        array(
            'id'    => 'hl_email',
            'label' => 'Email liên hệ xuất khẩu',
            'type'  => 'text',
            'std'   => 'info@hailinhplastic.com',
        ),
        array(
            'id'    => 'hl_phone',
            'label' => 'Số Tel / WhatsApp / Zalo',
            'desc'  => 'Ghi dạng quốc tế, VD: +84 358 918 210',
            'type'  => 'text',
            'std'   => '+84 358 918 210',
        ),
        array(
            'id'    => 'hl_map_embed',
            'label' => 'Google Map',
            'desc'  => 'Google Maps > Chia sẻ > Nhúng bản đồ > Sao chép HTML, dán vào đây. Bỏ trống = tự tạo bản đồ theo địa chỉ.',
            'type'  => 'textarea-simple',
            'rows'  => 3,
        ),
        array(
            'id'    => 'hl_talk_tab',
            'label' => 'TALK TO US',
            'desc'  => '<p>Các ô dưới đây là phần <b>TALK TO US</b> (trang Contact, cuối trang sản phẩm). Ô trống = ẩn dòng đó.</p>',
            'type'  => 'textblock-titled',
        ),
        array('id' => 'hl_domestic_whatsapp', 'label' => 'Bán hàng trong nước - WhatsApp', 'type' => 'text', 'std' => '(+84) 84378680868', 'desc' => 'Ghi đúng như muốn hiện trên web.'),
        array('id' => 'hl_domestic_email',    'label' => 'Bán hàng trong nước - Email', 'type' => 'text', 'std' => 'info@hailinhplastic.com'),
        array('id' => 'hl_intl_whatsapp',     'label' => 'Bán hàng quốc tế - WhatsApp', 'type' => 'text', 'desc' => 'Chưa có thì để trống (ẩn dòng WhatsApp).'),
        array('id' => 'hl_intl_emails',       'label' => 'Bán hàng quốc tế - Email', 'type' => 'textarea-simple', 'rows' => 2, 'std' => "sales02@hailinhplastic.com\nsales03@hailinhplastic.com", 'desc' => 'Mỗi dòng 1 email.'),
        array('id' => 'hl_social_zalo',     'label' => 'Link Zalo',     'type' => 'text', 'desc' => 'VD: https://zalo.me/84358918210. Bỏ trống = ẩn nút.'),
        array('id' => 'hl_social_facebook', 'label' => 'Link Facebook', 'type' => 'text', 'std' => 'https://www.facebook.com/nhuahailinh'),
        array('id' => 'hl_social_linkedin', 'label' => 'Link LinkedIn', 'type' => 'text'),
        array('id' => 'hl_social_youtube',  'label' => 'Link YouTube',  'type' => 'text'),
        array('id' => 'hl_social_whatsapp', 'label' => 'Số WhatsApp (chỉ số, VD: 84358918210)', 'type' => 'text'),
    );

    foreach ($fields as $field) {
        $field['section']  = $section;
        $field['operator'] = 'and';
        $settings['settings'][] = $field;
    }
    return $settings;
}

function hl_option($id, $default = '') {
    $value = function_exists('ot_get_option') ? ot_get_option($id, $default) : $default;
    return ($value === '' || $value === null) ? $default : $value;
}

function hl_contact_url() {
    $url = hl_option('hl_contact_url');
    return $url ? $url : get_page_url('tpl-contact');
}

function hl_profile_url() {
    $url = hl_option('hl_profile_url');
    return $url ? $url : home_url('/');
}

function hl_products_url() {
    $url = get_page_url('tpl-products');
    return $url === get_bloginfo('url') ? home_url('/#hl-products') : $url;
}

function hl_stats() {
    $stats = hl_option('hl_stats', array());
    if (!empty($stats) && is_array($stats)) {
        return $stats;
    }
    return array(
        array('title' => '7',      'label' => 'Product lines'),
        array('title' => '20+',    'label' => 'Grade codes'),
        array('title' => '40-85%', 'label' => 'Filler loading'),
        array('title' => 'ISO 9001:2015', 'label' => 'Certified by ISOCERT'),
    );
}

/** Danh sach id anh tu o "gallery" cua OptionTree */
function hl_gallery_ids($option) {
    return array_values(array_filter(array_map('absint', explode(',', (string) hl_option($option)))));
}

/** O nhieu dong -> mang, bo dong trong */
function hl_text_lines($option) {
    return array_values(array_filter(array_map('trim', preg_split('/
|
|
/', (string) hl_option($option)))));
}

/** Cac danh muc cu (khong thuoc 5 dong moi, khong phai danh muc con) co anh -> muc "Other products" */
function hl_get_other_lines() {
    $terms = hl_get_terms_lang(array('taxonomy' => 'product-cat', 'hide_empty' => false, 'parent' => 0));
    if (is_wp_error($terms)) return array();
    return array_values(array_filter($terms, function ($term) {
        return !hl_is_product_line($term) && get_term_meta($term->term_id, 'term_image', true) && get_term_children($term->term_id, 'product-cat') === array();
    }));
}

function hl_youtube_id($url) {
    if (preg_match('~(?:youtu\.be/|youtube\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/))([A-Za-z0-9_-]{11})~', $url, $m)) {
        return $m[1];
    }
    return '';
}

/*-----------------------------------------------------------------------------------*/
/*  Ma hang (post type "product"): o nhap rieng
/*-----------------------------------------------------------------------------------*/
add_action('admin_init', function () {
    if (!function_exists('ot_register_meta_box')) return;

    ot_register_meta_box(array(
        'id'       => 'hl-grade-info',
        'title'    => 'Thông số mã hàng (Hai Linh)',
        'pages'    => array('product'),
        'context'  => 'normal',
        'priority' => 'high',
        'fields'   => array(
            array(
                'id'    => 'hl_grade_code',
                'label' => 'Mã hàng',
                'desc'  => 'VD: HL-TE704',
                'type'  => 'text',
            ),
            array(
                'id'    => 'hl_grade_resin',
                'label' => 'Loại / nền nhựa',
                'desc'  => 'VD: PE Talc, LDPE/LLDPE + CaCO3',
                'type'  => 'text',
            ),
            array(
                'id'    => 'hl_filler_min',
                'label' => 'Tỷ lệ filler thấp nhất (%)',
                'desc'  => 'Chỉ ghi số, VD: 40',
                'type'  => 'text',
            ),
            array(
                'id'    => 'hl_filler_max',
                'label' => 'Tỷ lệ filler cao nhất (%)',
                'desc'  => 'Chỉ ghi số, VD: 80',
                'type'  => 'text',
            ),
            array(
                'id'    => 'hl_grade_order',
                'label' => 'Thứ tự hiển thị',
                'desc'  => 'Số nhỏ hiện trước. VD: 1, 2, 3...',
                'type'  => 'text',
            ),
        ),
    ));
});

/*-----------------------------------------------------------------------------------*/
/*  Dong san pham (taxonomy "product-cat"): thu tu, mo ta ngan, anh phu
/*-----------------------------------------------------------------------------------*/
function hl_term_fields($term = null) {
    $order    = $term ? get_term_meta($term->term_id, 'hl_line_order', true) : '';
    $sub      = $term ? get_term_meta($term->term_id, 'hl_sub_order', true) : '';
    $subtitle = $term ? get_term_meta($term->term_id, 'hl_line_subtitle', true) : '';
    $image    = $term ? get_term_meta($term->term_id, 'hl_line_image', true) : '';
    $gallery  = $term ? get_term_meta($term->term_id, 'hl_line_gallery', true) : '';
    $related  = $term ? array_map('intval', (array) get_term_meta($term->term_id, 'hl_line_related', true)) : array();
    $lang     = ($term && function_exists('pll_get_term_language')) ? pll_get_term_language($term->term_id) : '';
    $lines    = array_filter(hl_get_product_lines(), function ($t) use ($term, $lang) {
        if (!$term) return true;
        return $t->term_id !== $term->term_id && (!$lang || pll_get_term_language($t->term_id) === $lang);
    });
    ?>
    <tr class="form-field">
        <th scope="row"><label for="hl_line_order">Hai Linh: Số thứ tự dòng sản phẩm</label></th>
        <td>
            <input type="number" min="0" name="hl_line_order" id="hl_line_order" value="<?php echo esc_attr($order); ?>" style="width:120px">
            <p class="description">1 đến 7. <b>Chỉ những dòng có số thứ tự mới hiện ở trang Products và trang chủ.</b> Để trống = ẩn (danh mục cũ, hoặc mục con của 1 dòng).</p>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row"><label for="hl_sub_order">Hai Linh: Thứ tự mục con</label></th>
        <td>
            <input type="number" min="0" name="hl_sub_order" id="hl_sub_order" value="<?php echo esc_attr($sub); ?>" style="width:120px">
            <p class="description">Chỉ dùng cho mục con (VD: Film Bags, Woven... trong Filler Masterbatch). Ô "Parent" ở trên chọn dòng cha.</p>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row"><label for="hl_line_subtitle">Hai Linh: Mô tả 1 dòng</label></th>
        <td>
            <input type="text" name="hl_line_subtitle" id="hl_line_subtitle" value="<?php echo esc_attr($subtitle); ?>">
            <p class="description">VD: LDPE/LLDPE + CaCO3 for breathable backsheet film. Bài viết đầy đủ nhập ở ô "Description" phía trên.</p>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row"><label for="hl_line_image">Hai Linh: Ảnh chính</label></th>
        <td>
            <input type="text" name="hl_line_image" id="hl_line_image" value="<?php echo esc_attr($image); ?>">
            <p><button type="button" class="button hl-media-btn" data-target="hl_line_image" data-multiple="0">Chọn ảnh chính</button></p>
            <p class="description">Bỏ trống = dùng ảnh ở ô "Upload and Image" ở trên.</p>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row"><label for="hl_line_gallery">Hai Linh: Ảnh ứng dụng</label></th>
        <td>
            <textarea name="hl_line_gallery" id="hl_line_gallery" rows="4"><?php echo esc_textarea($gallery); ?></textarea>
            <p><button type="button" class="button hl-media-btn" data-target="hl_line_gallery" data-multiple="1">Chọn ảnh ứng dụng</button></p>
            <p class="description">Ảnh nhỏ hiện dưới ảnh chính (nên 2 ảnh). Mỗi dòng 1 link ảnh.</p>
        </td>
    </tr>
    <?php if ($lines) { ?>
    <tr class="form-field">
        <th scope="row">Hai Linh: Sản phẩm liên quan</th>
        <td>
            <input type="hidden" name="hl_line_related_sent" value="1">
            <?php foreach ($lines as $line) { ?>
                <label style="display:block;margin-bottom:4px"><input type="checkbox" name="hl_line_related[]" value="<?php echo esc_attr($line->term_id); ?>" <?php checked(in_array($line->term_id, $related, true)); ?>> <?php echo esc_html($line->name); ?></label>
            <?php } ?>
            <p class="description">Hiện ở cuối bài viết.</p>
        </td>
    </tr>
    <?php } ?>
    <?php
}

/* Bai viet dong san pham nam o "Description": cho phep HTML nhu noi dung bai viet (tieu de, danh sach), khong loc het */
add_action('init', function () {
    if (has_filter('pre_term_description', 'wp_filter_kses')) {
        remove_filter('pre_term_description', 'wp_filter_kses');
        add_filter('pre_term_description', 'wp_filter_post_kses');
    }
});

add_action('product-cat_add_form_fields', function () {
    echo '<table class="form-table" role="presentation">';
    hl_term_fields();
    echo '</table>';
}, 20);

add_action('product-cat_edit_form_fields', function ($term) {
    hl_term_fields($term);
}, 20);

function hl_save_term_fields($term_id) {
    if (!current_user_can('manage_categories')) return;
    foreach (array('hl_line_order', 'hl_sub_order') as $key) {
        if (isset($_POST[$key])) {
            $value = trim(wp_unslash($_POST[$key]));
            $value === '' ? delete_term_meta($term_id, $key) : update_term_meta($term_id, $key, absint($value));
        }
    }
    if (isset($_POST['hl_line_subtitle'])) {
        update_term_meta($term_id, 'hl_line_subtitle', sanitize_text_field(wp_unslash($_POST['hl_line_subtitle'])));
    }
    if (isset($_POST['hl_line_image'])) {
        update_term_meta($term_id, 'hl_line_image', esc_url_raw(trim(wp_unslash($_POST['hl_line_image']))));
    }
    if (isset($_POST['hl_line_gallery'])) {
        $urls = array_filter(array_map('esc_url_raw', array_map('trim', explode("\n", wp_unslash($_POST['hl_line_gallery'])))));
        update_term_meta($term_id, 'hl_line_gallery', implode("\n", $urls));
    }
    if (isset($_POST['hl_line_related_sent'])) {
        $ids = isset($_POST['hl_line_related']) ? array_map('absint', (array) $_POST['hl_line_related']) : array();
        update_term_meta($term_id, 'hl_line_related', array_values(array_filter($ids)));
    }
}
add_action('created_product-cat', 'hl_save_term_fields');
add_action('edited_product-cat', 'hl_save_term_fields');

add_action('admin_footer', function () {
    $screen = get_current_screen();
    if (!$screen || $screen->taxonomy !== 'product-cat') return;
    ?>
    <script>
    jQuery(function ($) {
        $('.hl-media-btn').on('click', function (e) {
            e.preventDefault();
            if (!window.wp || !wp.media) return;
            var box = $('#' + $(this).data('target')), multiple = $(this).data('multiple') == 1;
            var frame = wp.media({ title: $(this).text(), button: { text: 'Dùng ảnh này' }, library: { type: 'image' }, multiple: multiple });
            frame.on('select', function () {
                var urls = frame.state().get('selection').map(function (att) { return att.toJSON().url; });
                if (!multiple) { box.val(urls[0] || ''); return; }
                var lines = $.trim(box.val()) ? $.trim(box.val()).split('\n') : [];
                box.val(lines.concat(urls).join('\n'));
            });
            frame.open();
        });
    });
    </script>
    <?php
});

/*-----------------------------------------------------------------------------------*/
/*  Lay du lieu
/*-----------------------------------------------------------------------------------*/

/** 5 dong san pham moi, theo so thu tu */
/** Chi lay danh muc cua ngon ngu dang xem (Polylang) */
function hl_lang_args($args) {
    if (function_exists('pll_current_language') && pll_current_language()) {
        $args['lang'] = pll_current_language();
    }
    return $args;
}

/** get_terms + loc lai theo ngon ngu dang xem (tham so "lang" cua Polylang khong phai luc nao cung chay -> tranh hien lan dong EN/VI) */
function hl_get_terms_lang($args) {
    $terms = get_terms(hl_lang_args($args));
    if (is_wp_error($terms) || !function_exists('pll_current_language') || !function_exists('pll_get_term_language')) return $terms;
    $lang = pll_current_language();
    if (!$lang) return $terms;
    return array_values(array_filter($terms, function ($t) use ($lang) {
        $l = pll_get_term_language(is_object($t) ? $t->term_id : (int) $t);
        return !$l || $l === $lang;
    }));
}

function hl_get_product_lines() {
    $terms = hl_get_terms_lang(array(
        'taxonomy'   => 'product-cat',
        'hide_empty' => false,
        'meta_query' => array(array(
            'key'     => 'hl_line_order',
            'value'   => 0,
            'compare' => '>',
            'type'    => 'NUMERIC',
        )),
    ));
    if (is_wp_error($terms) || empty($terms)) return array();

    usort($terms, function ($a, $b) {
        return (int) get_term_meta($a->term_id, 'hl_line_order', true) - (int) get_term_meta($b->term_id, 'hl_line_order', true);
    });
    return $terms;
}

function hl_is_product_line($term) {
    return $term && !empty($term->term_id) && (int) get_term_meta($term->term_id, 'hl_line_order', true) > 0;
}

/** Cac ma hang thuoc 1 dong san pham, theo thu tu hien thi */
function hl_get_grades($term_id) {
    $posts = get_posts(array(
        'post_type'        => 'product',
        'post_status'      => 'publish',
        'posts_per_page'   => 50,
        'suppress_filters' => false,
        'tax_query'        => array(array(
            'taxonomy'         => 'product-cat',
            'field'            => 'term_id',
            'terms'            => $term_id,
            'include_children' => false,
        )),
    ));

    // Chi lay bai co ma hang (bai san pham cu trong danh muc, VD Color Masterbatch, khong hien thanh 1 dong ma)
    $posts = array_values(array_filter($posts, function ($p) {
        return get_post_meta($p->ID, 'hl_grade_code', true) !== '';
    }));
    usort($posts, function ($a, $b) {
        $oa = (int) get_post_meta($a->ID, 'hl_grade_order', true);
        $ob = (int) get_post_meta($b->ID, 'hl_grade_order', true);
        $oa = $oa ? $oa : 999;
        $ob = $ob ? $ob : 999;
        return $oa === $ob ? strcmp($a->post_title, $b->post_title) : $oa - $ob;
    });
    return $posts;
}

function hl_grade_data($post) {
    $min = get_post_meta($post->ID, 'hl_filler_min', true);
    $max = get_post_meta($post->ID, 'hl_filler_max', true);
    $min = is_numeric($min) ? max(0, min(100, (float) $min)) : null;
    $max = is_numeric($max) ? max(0, min(100, (float) $max)) : null;
    if ($min !== null && $max !== null && $min > $max) {
        list($min, $max) = array($max, $min);
    }
    $code = get_post_meta($post->ID, 'hl_grade_code', true);

    return array(
        'code'  => $code ? $code : $post->post_title,
        'resin' => get_post_meta($post->ID, 'hl_grade_resin', true),
        'min'   => $min,
        'max'   => $max,
        'url'   => get_permalink($post),
    );
}

function hl_line_images($term) {
    $main = get_term_meta($term->term_id, 'hl_line_image', true);
    $main = $main ? $main : get_term_meta($term->term_id, 'term_image', true);
    if (!$main && $term->parent && ($parent = hl_parent_line($term))) { // muc con chua co anh -> tam dung anh dong cha
        $main = get_term_meta($parent->term_id, 'hl_line_image', true);
    }
    $gallery = array_filter(array_map('trim', explode("\n", (string) get_term_meta($term->term_id, 'hl_line_gallery', true))));
    return array('main' => $main, 'gallery' => array_values($gallery));
}

/** Dong san pham cha cua 1 muc con (VD: Woven -> Filler Masterbatch), null neu khong phai muc con */
function hl_parent_line($term) {
    if (!$term || empty($term->parent)) return null;
    $parent = get_term($term->parent, 'product-cat');
    return ($parent && !is_wp_error($parent) && hl_is_product_line($parent)) ? $parent : null;
}

/** Cac muc con cua 1 dong san pham, theo "Thu tu muc con" */
function hl_get_sub_items($term) {
    $terms = hl_get_terms_lang(array('taxonomy' => 'product-cat', 'hide_empty' => false, 'parent' => $term->term_id));
    if (is_wp_error($terms) || empty($terms)) return array();
    usort($terms, function ($a, $b) {
        $oa = (int) get_term_meta($a->term_id, 'hl_sub_order', true);
        $ob = (int) get_term_meta($b->term_id, 'hl_sub_order', true);
        return ($oa ? $oa : 999) - ($ob ? $ob : 999);
    });
    return $terms;
}

/** San pham lien quan (chon trong trang sua danh muc) */
function hl_get_related_lines($term) {
    $out = array();
    foreach (array_filter(array_map('intval', (array) get_term_meta($term->term_id, 'hl_line_related', true))) as $id) {
        $t = get_term($id, 'product-cat');
        if ($t && !is_wp_error($t)) $out[] = $t;
    }
    return $out;
}
/*-----------------------------------------------------------------------------------*/
/*  Hien thi
/*-----------------------------------------------------------------------------------*/

/** Thanh ty le filler */
function hl_render_ratio_bar($min, $max) {
    if ($min === null && $max === null) return;
    $min = $min === null ? $max : $min;
    $max = $max === null ? $min : $max;
    $label = ($min == $max) ? $max . '%' : $min . '-' . $max . '%';
    ?>
    <span class="hl-ratio-value"><?php echo esc_html($label); ?></span>
    <span class="hl-ratio-bar" role="img" aria-label="<?php echo esc_attr(hl_t('grade_filler') . ': ' . $label); ?>">
        <span style="left: <?php echo esc_attr($min); ?>%; width: <?php echo esc_attr(max(1.5, $max - $min)); ?>%;"></span>
    </span>
    <?php
}

/** 1 the dong san pham (dung o trang Products va trang dong san pham) */
function hl_render_product_line($term, $index = 0, $heading = 'h2') {
    $images   = hl_line_images($term);
    $subtitle = get_term_meta($term->term_id, 'hl_line_subtitle', true);
    $number   = (int) get_term_meta($term->term_id, 'hl_line_order', true);
    $number   = $number ? $number : $index + 1;
    $subs     = hl_get_sub_items($term);
    $on_line  = is_tax('product-cat', $term->term_id); // dang o trang cua chinh dong nay
    ?>
    <article class="hl-line" id="<?php echo esc_attr($term->slug); ?>">
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="hl-line-media">
                    <?php if ($images['main']) { ?>
                        <a href="<?php echo esc_url($images['main']); ?>" class="hl-line-main hl-lightbox">
                            <img src="<?php echo esc_url($images['main']); ?>" alt="<?php echo esc_attr($term->name); ?>" loading="lazy">
                        </a>
                    <?php } else { ?>
                        <div class="hl-line-main hl-line-noimg"><i class="fa-regular fa-image"></i></div>
                    <?php } ?>
                    <?php if ($images['gallery']) { ?>
                        <div class="hl-line-gallery">
                            <?php foreach (array_slice($images['gallery'], 0, 4) as $img) { ?>
                                <a href="<?php echo esc_url($img); ?>" class="hl-lightbox"><img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($term->name); ?>" loading="lazy"></a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-6">
                <<?php echo $heading; ?> class="hl-line-title">
                    <span class="hl-line-num"><?php echo esc_html($number); ?></span>
                    <?php if ($on_line) { ?>
                        <span><?php echo esc_html($term->name); ?></span>
                    <?php } else { ?>
                        <a href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a>
                    <?php } ?>
                </<?php echo $heading; ?>>
                <?php if ($subtitle) { ?><p class="hl-line-sub"><?php echo esc_html($subtitle); ?></p><?php } ?>

                <?php /* Ma hang + thanh ty le filler: nha may khong muon cong khai (note Check web 20/10) -> ty le filler da co trong bai viet */ ?>

                <?php if ($subs && !$on_line) { ?>
                    <div class="hl-sub-chips">
                        <?php foreach ($subs as $sub) { ?>
                            <a href="<?php echo esc_url(get_term_link($sub)); ?>"><?php echo esc_html($sub->name); ?></a>
                        <?php } ?>
                    </div>
                <?php } ?>

                <div class="hl-line-actions">
                    <?php if ($on_line) { ?>
                        <a class="hl-btn hl-btn-primary" href="<?php echo esc_url(hl_contact_url()); ?>"><?php hl_e('btn_quote_short'); ?></a>
                    <?php } else { ?>
                        <a class="hl-btn hl-btn-primary" href="<?php echo esc_url(get_term_link($term)); ?>"><?php hl_e('btn_view_details'); ?> <i class="fa-solid fa-arrow-right"></i></a>
                        <a class="hl-btn hl-btn-ghost" href="<?php echo esc_url(hl_contact_url()); ?>"><?php hl_e('btn_quote_short'); ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </article>
    <?php
}

/** Bai viet cua dong san pham / muc con (o "Description" cua danh muc) + nut ASK FOR A QUOTE */
function hl_render_article($term) {
    $desc = term_description($term->term_id, 'product-cat');
    if (!trim(wp_strip_all_tags($desc))) return;
    ?>
    <div class="hl-article">
        <?php echo wp_kses_post($desc); ?>
        <p class="hl-article-cta">
            <a class="hl-btn hl-btn-quote" href="<?php echo esc_url(hl_contact_url()); ?>"><i class="fa-solid fa-envelope"></i> <?php hl_e('btn_ask_quote'); ?></a>
        </p>
    </div>
    <?php
}

/** Luoi the anh + ten danh muc (muc con, san pham lien quan) */
function hl_render_term_cards($terms, $current_id = 0) {
    if (!$terms) return;
    ?>
    <div class="hl-term-cards">
        <?php foreach ($terms as $t) {
            $img = hl_line_images($t); ?>
            <a class="hl-term-card<?php echo $t->term_id === $current_id ? ' is-active' : ''; ?>" href="<?php echo esc_url(get_term_link($t)); ?>">
                <span class="hl-term-card-img">
                    <?php if ($img['main']) { ?><img src="<?php echo esc_url($img['main']); ?>" alt="<?php echo esc_attr($t->name); ?>" loading="lazy"><?php } ?>
                </span>
                <strong><?php echo esc_html($t->name); ?></strong>
            </a>
        <?php } ?>
    </div>
    <?php
}

/*-----------------------------------------------------------------------------------*/
/*  Nut noi Profile / Contact (moi trang)
/*-----------------------------------------------------------------------------------*/
add_action('wp_footer', function () {
    ?>
    <div class="hl-float-actions">
        <a class="hl-float-btn" href="<?php echo esc_url(hl_profile_url()); ?>"><?php hl_e('btn_profile'); ?></a>
        <a class="hl-float-btn" href="<?php echo esc_url(hl_contact_url()); ?>"><?php hl_e('btn_contact'); ?></a>
    </div>
    <?php
}, 5);

/**
 * Lien he ban hang trong nuoc / quoc te (TALK TO US, footer).
 * Tra ve: array(array('label', 'phone', 'tel', array(email...)), ...), bo dong khong co gi.
 */
function hl_sales_contacts() {
    $rows = array(
        array(hl_t('sales_domestic'), hl_option('hl_domestic_whatsapp', '(+84) 84378680868'), hl_option('hl_domestic_email', 'info@hailinhplastic.com')),
        array(hl_t('sales_intl'), hl_option('hl_intl_whatsapp'), hl_option('hl_intl_emails', "sales02@hailinhplastic.com\nsales03@hailinhplastic.com")),
    );
    $out = array();
    foreach ($rows as $row) {
        list($label, $phone, $emails) = $row;
        $emails = array_values(array_filter(array_map('trim', preg_split('/[\r\n,;]+/', (string) $emails))));
        if (!$phone && !$emails) continue;
        // "(+84) 84378680868" -> tel:+84378680868 (bo so 84 lap lai sau ma nuoc)
        $tel = preg_replace('/^8484/', '84', preg_replace('/\D/', '', $phone));
        $out[] = array('label' => $label, 'phone' => $phone, 'tel' => $tel, 'emails' => $emails);
    }
    return $out;
}

/** Cac nut mang xa hoi */
function hl_social_links() {
    $whatsapp = preg_replace('/\D/', '', hl_option('hl_social_whatsapp'));
    $links = array(
        'zalo'     => array(hl_option('hl_social_zalo'), 'Zalo', '<span class="hl-zalo">Zalo</span>'),
        'whatsapp' => array($whatsapp ? 'https://wa.me/' . $whatsapp : '', 'WhatsApp', '<i class="fa-brands fa-whatsapp"></i>'),
        'facebook' => array(hl_option('hl_social_facebook', 'https://www.facebook.com/nhuahailinh'), 'Facebook', '<i class="fa-brands fa-facebook-f"></i>'),
        'linkedin' => array(hl_option('hl_social_linkedin'), 'LinkedIn', '<i class="fa-brands fa-linkedin-in"></i>'),
        'youtube'  => array(hl_option('hl_social_youtube'), 'YouTube', '<i class="fa-brands fa-youtube"></i>'),
    );
    $out = '';
    foreach ($links as $key => $link) {
        if (empty($link[0])) continue;
        $out .= '<a class="hl-social-btn hl-social-' . $key . '" href="' . esc_url($link[0]) . '" target="_blank" rel="noopener" title="' . esc_attr($link[1]) . '">' . $link[2] . '</a>';
    }
    if ($out) {
        echo '<div class="hl-social">' . $out . '</div>';
    }
}

/*-----------------------------------------------------------------------------------*/
/*  Danh muc cu (khong co so thu tu, khong phai muc con) van dung giao dien cu (archive.php)
/*-----------------------------------------------------------------------------------*/
add_filter('taxonomy_template', function ($template) {
    $term = get_queried_object();
    if (is_tax('product-cat') && !hl_is_product_line($term) && !hl_parent_line($term)) {
        return get_template_directory() . '/archive.php';
    }
    return $template;
});

/*
 * Link danh muc cu -> dong san pham moi (301) de giu link Google da luu.
 * Danh sach o option "hl_term_redirects" (id cu => id moi), do cong cu nhap du lieu ghi.
 */
add_action('template_redirect', function () {
    // Trang ma hang (product co hl_grade_code) khong con cong khai -> ve trang dong san pham
    if (is_singular('product') && get_post_meta(get_queried_object_id(), 'hl_grade_code', true)) {
        $terms = get_the_terms(get_queried_object_id(), 'product-cat');
        if ($terms && !is_wp_error($terms)) {
            wp_safe_redirect(get_term_link($terms[0]), 301);
            exit;
        }
    }
    if (!is_tax('product-cat')) return;
    $map = get_option('hl_term_redirects', array());
    $id  = get_queried_object_id();
    if (empty($map[$id])) return;
    $link = get_term_link((int) $map[$id], 'product-cat');
    if (!is_wp_error($link)) {
        wp_safe_redirect($link, 301);
        exit;
    }
});
