<?php /* Template Name: Template Contact Us */
	get_header();?>
	<div class="header-banner header-banner-other-page bg-image" style="background-image: url('<?php echo THEME_URL; ?>/img/bg-contact.png');">
		<div class="container-fluid container-fluid-sub">
			<div class="container position-relative h-100">
				<div class="header-description header-about text-center w-100">
					<h3><?php the_title(); ?></h3>
					<p><?php pll_e('tpl_contact_text_1'); ?></p>
					<a class="btn btn-outline-light btn-get-in-touch margin-0-auto" href="#sec-talk-to-us"><?php pll_e('text_common_1'); ?></a>
				</div>
			</div>
		</div>
	</div>
</header>

<main>
	<section class="tpl-contact">
		<?php
	      	get_template_part('template-parts/sec-talk-to-us');
		?>
	</section>
	
	<section class="bg-image" style="background-image: url('<?php echo THEME_URL; ?>/img/bg-tuvan.jpeg'); background-position-y: center;">
		<div class="container-fluid">
			<div class="container">
				<div class="site-sub-title">
					<p><?php pll_e('tpl_contact_text_2'); ?></p>
				</div>
			</div>
		</div>
	</section>
	<?php get_footer();?>
