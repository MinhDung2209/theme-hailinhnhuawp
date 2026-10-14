<div class="item-post">
   <a title="<?php the_title(); ?>" class='hongtq-image-holder height-240-before' href="<?php the_permalink(); ?>"
        style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>')">
    </a>
    <div class="item-content">
        <div class="item-date"><?php echo get_the_date('j F, Y'); ?></div>
        <div class="item-title webkit-line-clamp webkit-line-clamp-3">
            <?php the_title(); ?>
        </div>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="btn-single-read-more"><?php pll_e('text_common_3'); ?> <i class="fa-solid fa-arrow-right"></i></a>
        <div class="item-tag">
            <div class="webkit-line-clamp webkit-line-clamp-2 list-tag">
                <?php $postCatsItem = get_the_category();
                if ($postCatsItem) {
                     foreach($postCatsItem as $key=>$cat) {
                        if ($key === 0) {
                           echo '<a href="'.get_category_link($cat->term_id).'">'.$cat->name.'</a>';
                        } else {
                           echo '<span class="mx-1">•</span><a href="'.get_category_link($cat->term_id).'">'.$cat->name.'</a>';
                        }
                    }
                } ?>
            </div>
        </div>
    </div>
</div>