(function() {
    tinymce.create('tinymce.plugins.Catus_classic_editor_mesage_box', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */

		init : function(ed, url) {

			/* Message box */
			ed.addButton( 'message', {
				text: '',
				tooltip: 'Message Box',
				image: url + '/images/messagebox.png',
				onclick: function() {
					ed.windowManager.open({
						title: 'Message Box',
						body: [
							{type: 'textbox', name: 'content', label: 'Content'},
							{type: 'textbox', name: 'icon', label: 'Font Awesome Icon'},
							{type: 'textbox', name: 'color', label: 'Icon Color', value:"#", id: 'newcolorpicker_iconcolor'},
							{type: 'checkbox', name: 'border', label: 'Set border for the message box'}
						],
						onsubmit: function(e) {
							var uID =  Math.floor((Math.random()*100)+1);
							// Insert content when the window form is submitted
							ed.insertContent('[message id="message_'+uID+'" icon="'+e.data.icon+'" color="'+e.data.color+'" border="'+e.data.border+'"]'+e.data.content+'[/message]<br class="nc"/>');
						}
					});
				}
			});

        },


    });

    // Register plugin
    tinymce.PluginManager.add( 'cactus_shortcode_button_message_box', tinymce.plugins.Catus_classic_editor_mesage_box );
})();