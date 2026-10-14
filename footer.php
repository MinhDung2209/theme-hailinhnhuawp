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
                            <div class="mb-0 d-flex">
                                <i class="fa-solid fa-phone mr-3"></i>
                                <div>
                                    <label class="mb-0"><?php pll_e('footer_text_6'); ?></label>
                                    <div>WhatsApps: <a class="text-dark" href="tel:+84378680868">(+84) 84378680868</a></div>
                                    <div>Email: <a class="text-dark" href="mailto:info@hailinhplastic.com">info@hailinhplastic.com</a></div>
                                </div>
                            </div>
                            
                            <div class="mb-0 d-flex">
                                <i class="fa-solid fa-phone mr-3"></i>
                                <div>
                                    <label class="mb-0"><?php pll_e('footer_text_5'); ?></label>
                                    <div>WhatsApps: <a class="text-dark" href="tel:+84358918210">(+84) 358918210</a></div>
                                    <div>Email: <a class="text-dark" href="mailto:Annathu.do707@gmail.com">Annathu.do707@gmail.com</a></div>
                                </div>
                            </div>
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
                            <div class="d-flex mb-3 justify-content-end">
                                <a href="https://www.facebook.com/nhuahailinh" target="_blank" title="Facebook" class="mr-3">
                                    <img src="<?php echo THEME_URL; ?>/img/icon-fb.png" title="Facebook">
                                </a>
                                <a href="#" title="linkedin" target="_blank">
                                    <img src="<?php echo THEME_URL; ?>/img/icon-linkedin.png" title="linkedin">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copy-right"><?php pll_e('2023 Copyright Hai Linh Plastic. All Rights Reserved'); ?></div>
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
