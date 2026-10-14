<?php
get_header();?>
<main class="content bg-custom">
    <div class="container-fluid content-letter">
        <div class="container py-4">
            <div class="text-center">
                <h2 class="sub-title"><?php the_title(); ?></h2>
                <hr>
            </div>
            <article>
                <?php the_content(); ?>
            </article>
        </div>
    </div>
</main>
<?php get_footer();?>