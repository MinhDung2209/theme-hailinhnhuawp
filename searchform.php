<form role="search" method="get" class="woocommerce-product-search input-group search-bar search_form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="search" class="form-control rounded" placeholder="Tìm kiếm dự án" value="<?php echo get_search_query(); ?>" name="s" />
		<span class="input-group-text border-0" id="search-addon">
		    <i class="fas fa-search"></i>
		 </span>
	<input type="hidden" name="post_type" value="product" />
</form>
