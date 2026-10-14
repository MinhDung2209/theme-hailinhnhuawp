(function() {
    tinymce.create('tinymce.plugins.CactusShortcode_animation_divider', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */

		init : function(ed, url) {

			/* Animated Counter */
			ed.addButton( 'divider', {
				text: '',
				tooltip: 'Divider',
				image: url + '/images/divider.png',
				onclick: function() {
					ed.windowManager.open({
						title: 'Divider',
						body: [
							{type: 'listbox',
								name: 'align',
								label: 'Type',
								'values': [
									{text: 'Center', value: 'center'},
									{text: 'Right', value: 'right'},
									{text: 'Left', value: 'left'},
								]
							},
							{type: 'textbox', name: 'icon', label: 'Name of font-awesome icon',value:"fa-"},
							{type: 'textbox', name: 'text', label: 'Text',value:""},
							{type: 'textbox', name: 'color', label: 'Color', value:"#", id: 'newcolorpicker_color'},
						],
						onsubmit: function(e) {
							var uID =  Math.floor((Math.random()*100)+1);
							// Insert content when the window form is submitted
							ed.insertContent('[divider align="'+e.data.align+'" icon="'+e.data.icon+'" text="'+e.data.text+'" color="'+e.data.color+'"]<br class="nc"/>');
						}
					});
				}
			});


        },


    });

    // Register plugin
    tinymce.PluginManager.add( 'cactus_shortcode_animation_divider', tinymce.plugins.CactusShortcode_animation_divider );
})();