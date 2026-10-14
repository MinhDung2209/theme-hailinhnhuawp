<?php
/*-----------------------------------------------------------------------------------*/
/*  Plugin polylang: Registration translate string
/*-----------------------------------------------------------------------------------*/
add_action('init', function() {
    if(is_admin()) {
        if (function_exists('pll_register_string')) {
            $strings = [
                "inline" => [

                ],
                "multiline" => [
                    "text_common_1",
                    "text_common_2",
                    "text_common_3",
                    "text_common_4",
                    "tpl_home_page_text_1",
                    "tpl_home_page_text_2",
                    "tpl_home_page_text_3",
                    "tpl_home_page_text_4",
                    "tpl_home_page_text_5",
                    "tpl_home_page_text_6",
                    "tpl_home_page_text_7",
                    "tpl_home_page_text_8",
                    "tpl_home_page_text_9",
                    "tpl_home_page_text_10",
                    "tpl_about_us_page_text_1",
                    "tpl_about_us_page_text_2",
                    "tpl_blogs_text_1",
                    "tpl_blogs_text_2",
                    "tpl_blogs_text_3",
                    "tpl_contact_text_1",
                    "tpl_contact_text_2",
                    "sec_animation_home_page_text_1",
                    "sec_animation_home_page_text_2",
                    "sec_application_text_1",
                    "sec_application_text_2",
                    "sec_application_text_3",
                    "sec_application_text_4",
                    "sec_application_text_5",
                    "sec_application_text_6",
                    "sec_hl_service_text_1", 
                    "sec_hl_service_text_2", 
                    "sec_hl_service_text_3",
                    "sec_hl_service_text_4",
                    "sec_media_text_1",
                    "sec_media_text_2",
                    "sec_media_text_3",
                    "sec_out_parter_text_1",
                    "sec_out_parter_text_2",
                    "sec_talk_to_us_text_1",
                    "sec_talk_to_us_text_2",
                    "sec_talk_to_us_text_3",
                    "sec_what_we_do_text_1",
                    "sec_what_we_do_text_2",
                    "sec_what_we_do_text_3",
                    "sec_why_choose_us_text_1",
                    "sec_why_choose_us_text_2",
                    "sec_why_choose_us_text_3",
                    "sec_why_choose_us_text_4",
                    "sec_why_choose_us_text_5",
                    "sec_why_choose_us_text_6",
                    "sec_why_choose_us_text_7",
                    "sec_why_choose_us_text_8",
                    "sec_why_choose_us_text_9",
                    "sec_why_choose_us_text_10",
                    "sec_why_choose_us_text_11",
                    "footer_text_1",
                    "footer_text_2",
                    "footer_text_3",
                    "footer_text_4",
                    "footer_text_5",
                    "footer_text_6"
                ]
            ];
            foreach($strings['inline'] as $string) {
                pll_register_string($string, $string);
            }
            foreach($strings['multiline'] as $string) {
                pll_register_string($string, $string, 'hong.tran', true);
            }
        }
    }
});
