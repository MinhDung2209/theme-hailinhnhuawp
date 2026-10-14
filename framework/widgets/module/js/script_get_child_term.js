jQuery(document).ready(function(){
	jQuery('select[name="widget-eweb_product_by_term[6][term_ids]"]').change(function() {
        get_child_term();
    });
    get_child_term();
    function get_child_term() {
        var parent_term_id = jQuery('select[name="widget-eweb_product_by_term[6][term_ids]"]').val();
        if (parent_term_id != '' && parent_term_id != null) {
            jQuery.ajax({
                beforeSend: function() {
                    // jQuery('.filter-area .district i').show();
                },
                url: ajaxurl,
                data: {
                    action: 'get_term_by_id',
                    parent_term_id: parent_term_id
                }
            }).done(function(result) {
                // jQuery('.filter-area .district i').hide();
                jQuery('select[name="widget-eweb_product_by_term[6][term_childs]"]').html(result);
            });
        }
    }
});