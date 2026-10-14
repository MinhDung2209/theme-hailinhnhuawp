// jQuery Clients
jQuery(document).ready(function(e) {
	jQuery(".client-item").hover(
		function () {
			jQuery(this).children(".item").addClass("current-item");
			jQuery(".item").removeClass( "item-1" )
		},
		function () {
			jQuery(".client-item .item").removeClass("current-item");
			jQuery(".item").addClass("item-1");
		}
	);
})
