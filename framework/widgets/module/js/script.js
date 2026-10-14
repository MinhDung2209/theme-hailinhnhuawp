// JavaScript Document
jQuery(document).ready( function(){
    function media_upload( button_class) {

        var _custom_media = true,
        _orig_send_attachment = wp.media.editor.send.attachment;

        jQuery('body').on('click',button_class, function(e) {

            var button_id ='#'+jQuery(this).attr('id'),
                send_attachment_bkp = wp.media.editor.send.attachment,
                button = jQuery(button_id),
                id = button.attr('id').replace('-button', '');

            _custom_media = true;

            wp.media.editor.send.attachment = function(props, attachment){

                if ( _custom_media  ) {

                    //jQuery('.custom_media_id').val(attachment.id); 
                    jQuery('#' + id + '-url').val(attachment.url);
                    var myArray = [
                        {'display':'block','max-width':'100%'}
                    ];
                    jQuery( '#' + id + '-preview' ).attr( 'src', attachment.url ).css(myArray[0]);
                    jQuery( '#' + id + '-noimg' ).css( 'display', 'none' );

                } else {

                    return _orig_send_attachment.apply( button_id, [props, attachment] );

                }
            }
            wp.media.editor.open(button);
            return false;
        });
    }
    media_upload( '.custom_media_upload');

    // Remove Image
    function ew_image_remove( button_class ) {

        jQuery( 'body' ).on( 'click', button_class, function(e) {

            var button              = jQuery( this ),
                id                  = button.attr( 'id' ).replace( '-remove', '' );

            jQuery( '#' + id + '-preview' ).css( 'display', 'none' );
            jQuery( '#' + id + '-url' ).val( '' );
            jQuery( '#' + id + '-button').val('Select Image');
            //jQuery( '#' + id + '-noimg' ).css( 'display', 'block' );
            button.css( 'display', 'none' );
            //jQuery( '#' + id ).val( '' ).trigger( 'change' );

        });
    }
    ew_image_remove( '.ew-media-remove' );
});