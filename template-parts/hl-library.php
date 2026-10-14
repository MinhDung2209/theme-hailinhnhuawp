<?php
/* LIBRARY: VIDEO + ANH (Hai Linh v2) - an neu chua co video va anh */
$videos = hl_option('hl_library_videos', array());
$videos = is_array($videos) ? $videos : array();
$photo_ids = array_filter(array_map('absint', explode(',', (string) hl_option('hl_library_photos'))));
if (!$videos && !$photo_ids) return;
?>
<section class="hl-section hl-library" id="library">
    <div class="container">
        <div class="hl-section-head">
            <h2 class="hl-section-title"><?php hl_e('library_title'); ?></h2>
        </div>

        <?php if ($videos) { ?>
            <h3 class="hl-sub-title"><?php hl_e('library_videos'); ?></h3>
            <div class="hl-video-grid">
                <?php foreach ($videos as $video) {
                    $yt = hl_youtube_id(isset($video['youtube']) ? $video['youtube'] : '');
                    if (!$yt) continue; ?>
                    <div class="hl-video">
                        <button type="button" class="hl-video-thumb" data-yt="<?php echo esc_attr($yt); ?>" aria-label="<?php echo esc_attr($video['title']); ?>">
                            <img src="https://i.ytimg.com/vi/<?php echo esc_attr($yt); ?>/hqdefault.jpg" alt="<?php echo esc_attr($video['title']); ?>" loading="lazy">
                            <span class="hl-play"><i class="fa-solid fa-play"></i></span>
                        </button>
                        <a class="hl-video-title" href="https://www.youtube.com/watch?v=<?php echo esc_attr($yt); ?>" target="_blank" rel="noopener"><?php echo esc_html($video['title']); ?></a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <?php if ($photo_ids) { ?>
            <h3 class="hl-sub-title"><?php hl_e('library_photos'); ?></h3>
            <div class="hl-photo-grid">
                <?php foreach ($photo_ids as $id) {
                    $full  = wp_get_attachment_image_url($id, 'full');
                    $thumb = wp_get_attachment_image_url($id, 'medium_large');
                    if (!$full) continue; ?>
                    <a class="hl-photo hl-lightbox" href="<?php echo esc_url($full); ?>">
                        <img src="<?php echo esc_url($thumb ? $thumb : $full); ?>" alt="<?php echo esc_attr(get_post_meta($id, '_wp_attachment_image_alt', true)); ?>" loading="lazy">
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>
