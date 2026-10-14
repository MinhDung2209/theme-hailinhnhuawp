<?php /* Template Name: Template About Us */
	get_header();?>
	<div class="header-banner header-banner-other-page bg-image" style="background-image: url('<?php echo THEME_URL; ?>/img/bg-about-us.png');">
		<div class="container-fluid container-fluid-sub">
			<div class="container position-relative h-100">
				<div class="header-description header-about text-center w-100">
					<h3><?php the_title(); ?></h3>
					<p><?php pll_e('tpl_about_us_page_text_1'); ?></p>
					<a class="btn btn-outline-light btn-get-in-touch margin-0-auto" href="#sec-talk-to-us"><?php pll_e('text_common_1'); ?></a>
				</div>
			</div>
		</div>
	</div>
</header>

<main>
	<section>
		<div class="container-fluid mt-5">
			<div class="container">
				<article class="mx-3"><?php the_content(); ?></article>
			</div>
		</div>
	</section>

	<?php
      	get_template_part('template-parts/sec-why-choose-us');
      	get_template_part('template-parts/sec-out-partner');
      	get_template_part('template-parts/sec-talk-to-us');
	?>
	
	<section class="bg-image" style="background-image: url('<?php echo THEME_URL; ?>/img/bg-tuvan.jpeg'); background-position-y: center;">
		<div class="container-fluid">
			<div class="container">
				<div class="site-sub-title">
					<p><?php pll_e('tpl_about_us_page_text_2'); ?></p>
				</div>
			</div>
		</div>
	</section>
	<?php get_footer();?>
