<?php
/**
 * Hai Linh - noi dung 7 dong san pham theo tai lieu 19/10/2026 (CÁC NỘI DUNG DỰ KIẾN THAY ĐỔI + Content viết Product Website).
 * Tu nap khi kich hoat theme (va khi doi HL_NOI_DUNG_VER): 7 dong EN/VI, 7 muc con Filler, anh, SEO (Yoast), menu, chu tieng Viet.
 * Chay lai nhieu lan khong tao trung (tim theo khoa _hl_key). Du lieu: thu muc noi-dung/ (noi_dung.json + anh/).
 */

if (!defined('ABSPATH')) exit;

define('HL_NOI_DUNG_VER', '2026-10-20');
define('HLN_DIR', get_template_directory() . '/noi-dung');

/* ------------------------------------------------------------------ */
/* Du lieu                                                            */
/* ------------------------------------------------------------------ */

function hln_lines() {
    return array(
        // key => thu tu, ten EN, ten VI (giu dung ten trong tai lieu, ca 2 ngon ngu), slug EN, slug VI, mo ta 1 dong EN, VI, anh chinh, anh ung dung, lien quan
        'breathable' => array(1, 'BREATHABLE FILM COMPOUND', 'BREATHABLE FILM COMPOUND', '', '',
            'LDPE/LLDPE + CaCO3 for breathable backsheet film.', 'LDPE/LLDPE + CaCO3 cho màng đáy thoáng khí tã bỉm.',
            'breathable-main', array('breathable-app-1', 'breathable-app-2'), array()),
        'talc' => array(2, 'TRANSPARENT (TACL)', 'TRANSPARENT (TACL)', 'talc-filler-masterbatch', '',
            'Talc filler masterbatch for PE, PP, HIPS and GPPS.', 'Hạt độn Talc cho PE, PP, HIPS và GPPS.',
            'talc-main', array('talc-app'), array('filler', 'white')),
        'white' => array(3, 'WHITE MASTERBATCH', 'WHITE MASTERBATCH', 'white-masterbatch', '',
            'TiO2 whiteness & opacity; TiO2 + CaCO3 economy grades.', 'Độ trắng & độ che phủ TiO2; dòng tiết kiệm TiO2 + CaCO3.',
            'white-main', array('white-app-1', 'white-app-2'), array('talc', 'filler')),
        'bio' => array(4, 'BIODEGRADABLE FILLER MASTERBATCH', 'BIODEGRADABLE FILLER MASTERBATCH', 'bio-filler-masterbatch', '',
            'PBAT/PLA + CaCO3 for compostable film.', 'PBAT/PLA + CaCO3 cho màng phân hủy sinh học.',
            'bio-main', array('bio-bag', 'bio-app-2'), array('filler')),
        'filler' => array(5, 'FILLER MASTERBATCH', 'FILLER MASTERBATCH', 'caco3-filler-masterbatch', '',
            'CaCO3 filler for film, woven, non-woven, injection, tarpaulin, lamination and pipe.', 'Hạt độn CaCO3 cho màng, bao dệt, vải không dệt, ép phun, bạt, tráng phủ và ống.',
            'filler-main', array('sub-film-bags', 'sub-woven'), array('talc', 'white')),
        'color' => array(6, 'COLOR MASTERBATCH', 'COLOR MASTERBATCH', '', '', // danh muc cu tren web: giu slug de khong hong link cu
            'Custom color matching to your Pantone / RAL sample.', 'Pha màu theo mẫu Pantone / RAL của khách.',
            'color-main', array('color-app'), array()),
        'compound' => array(7, 'COMPOUND', 'COMPOUND', 'compound', 'hat-nhua-compound',
            'Ready-to-use compound made to your formula: PE, PP, PS, ABS...', 'Hạt compound dùng ngay, phối theo công thức của khách: PE, PP, PS, ABS...',
            'compound-main', array('compound-app'), array()),
    );
}

/** 7 muc con cua Filler Masterbatch: key => ten EN, ten VI, slug EN, slug VI, anh */
function hln_subs() {
    return array(
        'film-bags'  => array('Film Bags', 'Film Bags', 'film-bags', 'mang-tui', 'sub-film-bags'),
        'injection'  => array('Injections', 'Injections', 'injection', 'ep-phun', 'sub-injection'),
        'lamination' => array('Lamination', 'Lamination', 'lamination', 'trang-phu', 'sub-lamination'),
        'non-woven'  => array('Non-woven', 'Non-woven', 'non-woven', 'vai-khong-det', 'sub-non-woven'),
        'woven'      => array('Woven', 'Woven', 'woven', 'bao-det', 'sub-woven'),
        'tarpaulin'  => array('Tarpaulin', 'Tarpaulin', 'tarpaulin', 'bat-tarpaulin', ''),
        'hdpe-pipe'  => array('HDPE Pipe', 'HDPE Pipe', 'hdpe-pipe', 'ong-hdpe', ''),
    );
}

/** Danh muc cu -> dong moi (chuyen huong 301 khi bat giao dien moi). slug EN cu => key moi */
function hln_old_terms() {
    return array(
        'filler-masterbatch' => 'filler',
        'film-bags-en-en'    => 'film-bags',
        'injections-en-en'   => 'injection',
        'lamination-en-en'   => 'lamination',
        'non-woven-en-en'    => 'non-woven',
        'woven-en-en'        => 'woven',
        'transparent-tacl'   => 'talc',
        'white-master-batch' => 'white',
    );
}

/** Chu giao dien tieng Viet (Polylang > Translations, nhom "Hai Linh v2") */
function hln_vi_strings() {
    return array(
        'Do you want to know more about filler masterbatch?' => 'Bạn có muốn biết thêm về filler masterbatch?',
        'In the world of plastics, the term "filler masterbatch" has gained significant importance. But what exactly is filler masterbatch? In simple terms, filler masterbatch, also known as plastic filler, is a composite material made by combining CaCO3 (calcium carbonate) powder with virgin resin and specific additives.'
            => 'Trong thế giới nhựa, thuật ngữ “filler masterbatch” đã đạt được tầm quan trọng đáng kể. Nhưng chính xác thì filler masterbatch là gì? Nói một cách đơn giản, filler masterbatch hay còn gọi là hạt độn nhựa là loại vật liệu composite được tạo ra bằng cách kết hợp bột CaCO3 (canxi cacbonat) với nhựa nguyên chất và các chất phụ gia đặc trưng.',
        'ASK FOR A QUOTE' => 'YÊU CẦU BÁO GIÁ',
        'View details' => 'Xem chi tiết',
        'Related products' => 'Sản phẩm liên quan',
        'Applications' => 'Ứng dụng',
        'Seven product lines for film, fiber, injection, hygiene and engineering plastics.' => 'Bảy dòng sản phẩm cho màng, sợi, ép phun, sản phẩm vệ sinh và nhựa kỹ thuật.',
        'Listed in priority order 1-7. Filler ratio = % filler by weight in the masterbatch.' => 'Xếp theo thứ tự ưu tiên 1-7. Tỷ lệ filler = % chất độn theo khối lượng trong hạt masterbatch.',
        'Filler & Additive Masterbatch Manufacturer from Vietnam' => 'Nhà sản xuất hạt phụ gia và filler masterbatch tại Việt Nam',
        'Breathable-film compound, Talc, White masterbatch, Bio filler and PE/PP/HDPE CaCO3 filler - consistent quality for export customers.' => 'Hạt màng thoáng khí, Talc, White masterbatch, Bio filler và hạt filler CaCO3 PE/PP/HDPE - chất lượng ổn định cho khách hàng xuất khẩu.',
        'View Products' => 'Xem sản phẩm',
        'Request a Quote' => 'Yêu cầu báo giá',
        'Request quote' => 'Yêu cầu báo giá',
        'Profile' => 'Hồ sơ năng lực',
        'Contact' => 'Liên hệ',
        'View grades' => 'Xem mã hàng',
        'Send inquiry' => 'Gửi yêu cầu',
        'Download Profile / Catalog' => 'Tải hồ sơ năng lực / Catalog',
        'Back to product line' => 'Quay lại dòng sản phẩm',
        'Our Products' => 'Sản phẩm',
        'Filler ratio range (0-100%)' => 'Tỷ lệ filler (0-100%)',
        'Grade code' => 'Mã hàng',
        'Base resin' => 'Nhựa nền',
        'Filler loading' => 'Tỷ lệ chất độn',
        'Other grades in this line' => 'Mã hàng khác trong dòng này',
        'Other products' => 'Sản phẩm khác',
        'Our factory' => 'Nhà máy',
        'Quality you can verify' => 'Chất lượng có thể kiểm chứng',
        'Our quality management system is certified to ISO 9001:2015 for the production of plastic additives. Check the certificate online with the retrieval code on the document.' => 'Hệ thống quản lý chất lượng của chúng tôi đạt chứng nhận ISO 9001:2015 cho sản xuất phụ gia nhựa. Tra cứu chứng chỉ trực tuyến bằng mã tra cứu in trên giấy chứng nhận.',
        'Certificates & test reports' => 'Chứng chỉ & phiếu kiểm nghiệm',
        'Verify certificate' => 'Tra cứu chứng chỉ',
        'Click to enlarge' => 'Bấm để phóng to',
        'Library' => 'Thư viện',
        'Videos' => 'Video',
        'Photos: Factory - Products - Team' => 'Ảnh: Nhà máy - Sản phẩm - Đội ngũ',
        'Contact & Location' => 'Liên hệ & Bản đồ',
        'Address' => 'Địa chỉ',
        'Tel / WhatsApp / Zalo' => 'Điện thoại / WhatsApp / Zalo',
    );
}

/* ------------------------------------------------------------------ */
/* Ham phu                                                            */
/* ------------------------------------------------------------------ */

function hln_log($msg) {
    $GLOBALS['hln_log'][] = $msg;
    if (defined('WP_CLI') && WP_CLI) WP_CLI::log($msg);
}

/** Anh nam trong theme (noi-dung/anh/), tra ve URL */
function hln_image($key) {
    if (!$key) return '';
    if (!file_exists(HLN_DIR . '/anh/' . $key . '.webp')) { hln_log("! Thieu anh $key"); return ''; }
    return get_template_directory_uri() . '/noi-dung/anh/' . $key . '.webp';
}

function hln_term_by_key($key, $lang) {
    $terms = get_terms(array('taxonomy' => 'product-cat', 'hide_empty' => false, 'meta_key' => '_hl_key', 'meta_value' => $key . ':' . $lang, 'lang' => ''));
    return (!is_wp_error($terms) && $terms) ? $terms[0] : null;
}

/** Tim danh muc san co cho 1 dong (de sua, khong tao trung) */
function hln_find_existing_line($key, $order) {
    if ($key === 'color') {
        $t = get_term_by('slug', 'color-masterbatch', 'product-cat');
        if ($t && pll_get_term_language($t->term_id) === 'en') return $t;
    }
    if ($order <= 5) { // 5 dong da nhap ngay 14/10 (so thu tu 1-5). Loc tieng Anh bang tay: tham so "lang" khong phai luc nao cung chay
        foreach (get_terms(array('taxonomy' => 'product-cat', 'hide_empty' => false, 'lang' => '', 'meta_key' => 'hl_line_order', 'meta_value' => $order)) as $t) {
            if (empty($t->parent) && pll_get_term_language($t->term_id) === 'en' && !get_term_meta($t->term_id, '_hl_key', true)) return $t;
        }
    }
    return null;
}

/** Tao / sua 1 danh muc */
function hln_save_term($existing, $name, $slug, $parent, $lang, $desc) {
    $args = array('name' => $name, 'description' => $desc, 'parent' => $parent);
    if ($slug) $args['slug'] = $slug;
    if ($existing) {
        $r = wp_update_term($existing->term_id, 'product-cat', $args);
        if (is_wp_error($r) && $slug) { // slug da co -> giu slug cu
            unset($args['slug']);
            $r = wp_update_term($existing->term_id, 'product-cat', $args);
        }
        if (is_wp_error($r)) { hln_log("! Loi sua $name: " . $r->get_error_message()); return 0; }
        $id = $existing->term_id;
        hln_log("~ Sua $lang #$id $name");
    } else {
        $r = wp_insert_term($name, 'product-cat', $args);
        if (is_wp_error($r) && $slug) {
            $args['slug'] = $slug . '-' . $lang;
            $r = wp_insert_term($name, 'product-cat', $args);
        }
        if (is_wp_error($r)) { hln_log("! Loi tao $name: " . $r->get_error_message()); return 0; }
        $id = $r['term_id'];
        hln_log("+ Tao $lang #$id $name");
    }
    if (function_exists('pll_set_term_language')) pll_set_term_language($id, $lang);
    return (int) $id;
}

function hln_seo($term_id, $seo) {
    if (empty($seo['title']) && empty($seo['desc'])) return;
    $meta = get_option('wpseo_taxonomy_meta', array());
    $cur = isset($meta['product-cat'][$term_id]) ? $meta['product-cat'][$term_id] : array();
    if (!empty($seo['title'])) $cur['wpseo_title'] = $seo['title'];
    if (!empty($seo['desc'])) $cur['wpseo_desc'] = $seo['desc'];
    if (!empty($seo['focus'])) $cur['wpseo_focuskw'] = $seo['focus'];
    $meta['product-cat'][$term_id] = $cur;
    update_option('wpseo_taxonomy_meta', $meta);
}

/* ------------------------------------------------------------------ */
/* Chay                                                               */
/* ------------------------------------------------------------------ */

function hln_run() {
    $GLOBALS['hln_log'] = array();
    // Ghi lai cac dong cu truoc khi an (de lan chay sau van tim thay trong menu)
    $old = get_terms(array('taxonomy' => 'product-cat', 'hide_empty' => false, 'lang' => '', 'meta_key' => 'hl_line_order', 'fields' => 'ids'));
    update_option('hl_nhap_old_lines', array_values(array_unique(array_merge((array) get_option('hl_nhap_old_lines', array()), array_map('intval', is_wp_error($old) ? array() : $old)))), false);
    if (!function_exists('pll_set_term_language')) { hln_log('! Can Polylang'); return $GLOBALS['hln_log']; }
    $content = json_decode(file_get_contents(HLN_DIR . '/noi_dung.json'), true);
    // Giu the h2/h3/ul trong bai viet (mac dinh WordPress loc bot HTML o mo ta danh muc)
    kses_remove_filters();
    remove_filter('pre_term_description', 'wp_filter_kses');
    add_filter('pre_term_description', 'wp_filter_post_kses'); // van loc an toan nhu noi dung bai viet
    $ids = array('en' => array(), 'vi' => array());

    /* 1. 7 dong san pham */
    foreach (hln_lines() as $key => $l) {
        list($order, $name_en, $name_vi, $slug_en, $slug_vi, $sub_en, $sub_vi, $img, $gallery) = $l;
        $en = hln_term_by_key($key, 'en');
        $en = $en ? $en : hln_find_existing_line($key, $order);
        $vi = hln_term_by_key($key, 'vi');
        if (!$vi && $en && ($vi_id = pll_get_term($en->term_id, 'vi')) && $vi_id != $en->term_id) $vi = get_term($vi_id, 'product-cat');

        $img_url = hln_image($img);
        $gal = implode("\n", array_filter(array_map('hln_image', $gallery)));
        foreach (array('en' => array($en, $name_en, $slug_en, $sub_en), 'vi' => array($vi, $name_vi, $slug_vi, $sub_vi)) as $lang => $x) {
            list($term, $name, $slug, $sub) = $x;
            $c = $content[$key][$lang];
            $id = hln_save_term($term, $name, $slug, 0, $lang, $c['html']);
            if (!$id) continue;
            update_term_meta($id, '_hl_key', $key . ':' . $lang);
            update_term_meta($id, 'hl_line_order', $order);
            update_term_meta($id, 'hl_line_subtitle', $sub);
            update_term_meta($id, 'hl_line_image', $img_url);
            update_term_meta($id, 'hl_line_gallery', $gal);
            delete_term_meta($id, 'hl_sub_order');
            hln_seo($id, $c['seo']);
            $ids[$lang][$key] = $id;
        }
        if (!empty($ids['en'][$key]) && !empty($ids['vi'][$key])) {
            pll_save_term_translations(array('en' => $ids['en'][$key], 'vi' => $ids['vi'][$key]));
        }
    }

    /* San pham lien quan */
    foreach (hln_lines() as $key => $l) {
        foreach (array('en', 'vi') as $lang) {
            if (empty($ids[$lang][$key])) continue;
            $rel = array();
            foreach ($l[9] as $rk) if (!empty($ids[$lang][$rk])) $rel[] = $ids[$lang][$rk];
            update_term_meta($ids[$lang][$key], 'hl_line_related', $rel);
        }
    }

    /* 2. 7 muc con cua Filler */
    $i = 0;
    foreach (hln_subs() as $key => $s) {
        $i++;
        list($name_en, $name_vi, $slug_en, $slug_vi, $img) = $s;
        $img_url = hln_image($img);
        $pair = array();
        foreach (array('en' => array($name_en, $slug_en), 'vi' => array($name_vi, $slug_vi)) as $lang => $x) {
            if (empty($ids[$lang]['filler'])) continue;
            $c = $content[$key][$lang];
            $id = hln_save_term(hln_term_by_key($key, $lang), $x[0], $x[1], $ids[$lang]['filler'], $lang, $c['html']);
            if (!$id) continue;
            update_term_meta($id, '_hl_key', $key . ':' . $lang);
            update_term_meta($id, 'hl_sub_order', $i);
            delete_term_meta($id, 'hl_line_order');
            $img_url ? update_term_meta($id, 'hl_line_image', $img_url) : delete_term_meta($id, 'hl_line_image');
            hln_seo($id, $c['seo']);
            $ids[$lang][$key] = $pair[$lang] = $id;
        }
        if (count($pair) === 2) pll_save_term_translations($pair);
    }

    /* 3. Dong cu khong con dung (VD: trung voi dong moi) -> an */
    foreach (get_terms(array('taxonomy' => 'product-cat', 'hide_empty' => false, 'lang' => '', 'meta_key' => 'hl_line_order')) as $t) {
        if (!in_array((int) $t->term_id, array_merge(array_values($ids['en']), array_values($ids['vi'])), true)) {
            delete_term_meta($t->term_id, 'hl_line_order');
            hln_log("- An dong cu #{$t->term_id} {$t->name}");
        }
    }

    /* 4. Link danh muc cu -> dong moi */
    $map = array();
    foreach (hln_old_terms() as $old_slug => $key) {
        $old = get_term_by('slug', $old_slug, 'product-cat');
        if (!$old) continue;
        if (!empty($ids['en'][$key]) && $old->term_id != $ids['en'][$key]) $map[$old->term_id] = $ids['en'][$key];
        $old_vi = pll_get_term($old->term_id, 'vi');
        if ($old_vi && !empty($ids['vi'][$key]) && $old_vi != $ids['vi'][$key]) $map[$old_vi] = $ids['vi'][$key];
    }
    update_option('hl_term_redirects', $map, false);
    hln_log('Chuyen huong link cu: ' . count($map) . ' danh muc');

    /* 5. Menu: thay cac muc dong san pham cu bang 7 dong */
    hln_menus($ids);

    /* 6. Chu tieng Viet */
    hln_strings();

    update_option('hl_nhap_du_lieu', array('time' => current_time('mysql'), 'ids' => $ids, 'ver' => HL_NOI_DUNG_VER, 'log' => $GLOBALS['hln_log']), false);
    hln_log('XONG');
    return $GLOBALS['hln_log'];
}

function hln_menus($ids) {
    $line_ids = array();
    foreach (array('en', 'vi') as $lang) foreach (hln_lines() as $key => $l) {
        if (!empty($ids[$lang][$key])) $line_ids[$ids[$lang][$key]] = $lang;
    }
    foreach (wp_get_nav_menus() as $menu) {
        $items = wp_get_nav_menu_items($menu->term_id, array('post_status' => 'any'));
        $block = array();
        foreach ($items as $it) {
            if ($it->type === 'taxonomy' && $it->object === 'product-cat' && (isset($line_ids[(int) $it->object_id]) || get_term_meta((int) $it->object_id, '_hl_key', true) || hln_was_line((int) $it->object_id))) {
                $block[] = $it;
            }
        }
        // Chi sua menu cua giao dien moi: menu co muc "Breathable" (dong nay khong co trong menu cu dang chay tren web)
        $has_new = false;
        foreach ($block as $it) {
            if (in_array((int) $it->object_id, array_filter(array($ids['en']['breathable'] ?? 0, $ids['vi']['breathable'] ?? 0)), true)) { $has_new = true; break; }
        }
        if (!$block || !$has_new) continue;
        $parent = (int) $block[0]->menu_item_parent;
        $lang = isset($line_ids[(int) $block[0]->object_id]) ? $line_ids[(int) $block[0]->object_id] : pll_get_term_language((int) $block[0]->object_id);
        $lang = $lang ? $lang : 'en';
        $start = (int) $block[0]->menu_order;
        foreach ($block as $it) wp_delete_post($it->ID, true);

        // don cho cho 7 muc moi
        $after = array_filter(wp_get_nav_menu_items($menu->term_id, array('post_status' => 'any')), function ($it) use ($start) { return (int) $it->menu_order >= $start; });
        foreach ($after as $it) wp_update_post(array('ID' => $it->ID, 'menu_order' => (int) $it->menu_order + 20));

        $pos = $start;
        foreach (hln_lines() as $key => $l) {
            if (empty($ids[$lang][$key])) continue;
            $t = get_term($ids[$lang][$key], 'product-cat');
            wp_update_nav_menu_item($menu->term_id, 0, array(
                'menu-item-title' => $t->name, 'menu-item-object' => 'product-cat', 'menu-item-object-id' => $t->term_id,
                'menu-item-type' => 'taxonomy', 'menu-item-parent-id' => $parent, 'menu-item-status' => 'publish', 'menu-item-position' => $pos++,
            ));
        }
        hln_log("Menu {$menu->name}: thay " . count($block) . ' muc bang 7 dong (' . $lang . ')');
    }
}

/** Danh muc tung la dong san pham (da bi an o buoc 3) */
function hln_was_line($term_id) {
    $saved = get_option('hl_nhap_du_lieu');
    if (!empty($saved['ids'])) foreach ($saved['ids'] as $lang_ids) if (in_array($term_id, $lang_ids, true)) return true;
    return in_array($term_id, (array) get_option('hl_nhap_old_lines', array()), true);
}

function hln_strings() {
    if (!class_exists('PLL_MO') || !function_exists('PLL')) { hln_log('! Khong tim thay PLL_MO, bo qua chu tieng Viet'); return; }
    $lang = PLL()->model->get_language('vi');
    if (!$lang) return;
    $mo = new PLL_MO();
    $mo->import_from_db($lang);
    foreach (hln_vi_strings() as $en => $vi) {
        $cur = $mo->translate($en);
        if ($cur !== '' && $cur !== $en) continue; // da dich trong Polylang > Translations -> giu nguyen
        $mo->add_entry($mo->make_entry($en, $vi));
    }
    $mo->export_to_db($lang);
    hln_log('Chu tieng Viet: ' . count(hln_vi_strings()));
}

/* ------------------------------------------------------------------ */
/* Tu nap khi kich hoat theme                                         */
/* ------------------------------------------------------------------ */

function hln_maybe_run() {
    $last = get_option('hl_nhap_du_lieu');
    if (!empty($last['ver']) && $last['ver'] === HL_NOI_DUNG_VER) return;
    if (!current_user_can('manage_options') || !function_exists('pll_set_term_language')) return;
    if (get_transient('hl_nhap_du_lieu_lock')) return; // tranh 2 tab chay cung luc
    set_transient('hl_nhap_du_lieu_lock', 1, 300);
    @set_time_limit(300);
    hln_run();
    delete_transient('hl_nhap_du_lieu_lock');
    if (function_exists('w3tc_flush_all')) w3tc_flush_all();
}
add_action('admin_init', 'hln_maybe_run');
