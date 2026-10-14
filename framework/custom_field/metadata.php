<?php

/**
 * Initialize the meta boxes. See /option-tree/assets/theme-mode/demo-meta-boxes.php for reference
 *
 */
add_action('admin_init', 'hongtq_dev_meta_boxes');

if (!function_exists('hongtq_dev_meta_boxes')) {

    function hongtq_dev_meta_boxes() {

        // Create metabox
        // $meta_boxes_product = array(
        //     'id' => 'setting-for-product',
        //     'title' => __('Cấu hình thêm', 'hongtq_dev'),
        //     'desc' => '',
        //     'pages' => array('product'),
        //     'context' => 'normal',
        //     'priority' => 'high',
        //     'fields' => array(
        //         array(
        //             'id'          => 'product_code',
        //             'label'       => __('Mã tài sản','hongtq_dev'),
        //             'desc'        => '',
        //             'type'        => 'text',
        //         ),
        //         array(
        //             'id'          => 'time_start',
        //             'label'       => __('Thời gian mở đăng ký:','hongtq_dev'),
        //             'desc'        => '',
        //             'type'        => 'date-picker',
        //         ),
        //         array(
        //             'id'          => 'price_start',
        //             'label'       => __('Giá khởi điểm:','hongtq_dev'),
        //             'desc'        => '',
        //             'type'        => 'text',
        //         ),
        //         array(
        //             'id'          => 'produc_status',
        //             'label'       => __('Trạng thái','hongtq_dev'),
        //             'desc'        => '',
        //             'type'        => 'select',
        //             'std'         => 'new',
        //             'choices'     => array( 
        //               array(
        //                 'value'       => 'new',
        //                 'label'       => __( 'Sắp diễn ra', 'hongtq_dev' ),
        //                 'src'         => ''
        //               ),
        //               array(
        //                 'value'       => 'comming',
        //                 'label'       => __( 'Đang diễn ra', 'hongtq_dev' ),
        //                 'src'         => ''
        //               ),
        //               array(
        //                 'value'       => 'closed',
        //                 'label'       => __( 'Đã đấu giá', 'hongtq_dev' ),
        //                 'src'         => ''
        //               )
        //             )
        //         ),
        //     ),
        // );

        // ot_register_meta_box($meta_boxes_product);

    }

}