    </main>
        <footer>
            <div class="container-fluid">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col-xl-5">
                            <div class="logo-footer">
                                <?php hongtq_logo('logo','img-logo-footer'); ?>
                            </div>
                            <div class="des-footer">
                                <?php echo get_bloginfo('description'); ?>
                            </div>

                            <p class="mb-0 text-dark"><i class="fa-solid fa-location-dot mr-3 mb-0"></i> <?php pll_e('footer_text_1'); ?></p>
                            <?php /* Hai Linh v2: lay tu Theme Options > TALK TO US */
                            foreach (hl_sales_contacts() as $hl_row) { ?>
                            <div class="mb-0 d-flex">
                                <i class="fa-solid fa-phone mr-3"></i>
                                <div>
                                    <label class="mb-0"><?php echo esc_html($hl_row['label']); ?></label>
                                    <?php if ($hl_row['phone']) { ?>
                                        <div>WhatsApps: <a class="text-dark" href="tel:+<?php echo esc_attr($hl_row['tel']); ?>"><?php echo esc_html($hl_row['phone']); ?></a></div>
                                    <?php } ?>
                                    <?php foreach ($hl_row['emails'] as $hl_i => $hl_email) { ?>
                                        <div<?php echo $hl_i ? ' class="hl-email-more"' : ''; ?>><?php echo $hl_i ? '' : 'Email: '; ?><a class="text-dark" href="mailto:<?php echo esc_attr($hl_email); ?>"><?php echo esc_html($hl_email); ?></a></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="col-xl-2 col-6">
                            <strong class="mb-3"><?php pll_e("footer_text_2"); ?></strong>
                            <?php
                                 wp_nav_menu( array(
                                    'theme_location'  => 'footer_menu_company',
                                    'depth'           => 1,
                                    'container_id'    => '',
                                    'container_class' => ''
                                 ));
                              ?>
                        </div>
                        <div class="col-xl-2 col-6">
                            <strong class="mb-3"><?php pll_e("footer_text_3"); ?></strong>
                            <?php
                                 wp_nav_menu( array(
                                    'theme_location'  => 'footer_menu_services',
                                    'depth'           => 1,
                                    'container_id'    => '',
                                    'container_class' => ''
                                 ));
                              ?>
                        </div>
                        <div class="col-xl-3 col-12">
                            <div class="footer-follow-us text-right">
                                <strong><?php pll_e("footer_text_4"); ?></strong>
                            </div>
                            <div class="mb-3">
                                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fnhuahailinh&tabs=timeline&width=340&height=72px&small_header=true&adapt_container_width=false&hide_cover=false&show_facepile=false&appId=744716923110543" width="340" height="72px" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                            </div>
                            <?php hl_social_links(); /* Hai Linh v2: Zalo / WhatsApp / Facebook / LinkedIn / YouTube - sua trong Theme Options */ ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copy-right"><?php pll_e('2021 Copyright Hai Linh Plastic. All Rights Reserved'); ?></div>
        </footer>
        <div id="top" class="btn-scroll-to-top"><i class="micon-top"></i></div>
        <div class="menu-right-switch-language">
            <?php
                 wp_nav_menu( array(
                    'theme_location'  => 'switch_language_menu',
                    'depth'           => 1,
                    'container_id'    => '',
                    'container_class' => ''
                 ));
              ?>
        </div>
        <?php wp_footer();?>
    </body>
</html>
