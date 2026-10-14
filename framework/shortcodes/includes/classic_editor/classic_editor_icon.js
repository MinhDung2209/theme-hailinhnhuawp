(function() {
    tinymce.create('tinymce.plugins.Cactus_classic_editor_icon', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */

		init : function(ed, url) {

			/* Icon */
			ed.addButton( 'icon', {
				text: '',
				tooltip: 'Icon',
				image: url + '/images/messagebox.png',
				onclick: function() {
					ed.windowManager.open({
						title: 'Icon',
						body: [
							{type: 'textbox', name: 'name', label: 'Font Awesome Icon'},
							{type: 'listbox',
								name: 'type',
								label: 'Type',
								'values': [
									{text: 'Squared', value: 'squared'},
									{text: 'Rounded', value: 'rounded'},
								]
							},
							{type: 'textbox', name: 'color', label: 'Icon Color', value:"#", id: 'newcolorpicker_iconcolor'},
							{type: 'textbox', name: 'hover_color', label: 'Icon Hover Color', value:"#", id: 'newcolorpicker_iconhvcolor'}
						],
						onsubmit: function(e) {
							var uID =  Math.floor((Math.random()*100)+1);
							// Insert content when the window form is submitted
							ed.insertContent('[icon id="icon_'+uID+'" name="'+e.data.name+'" color="'+e.data.color+'" hover_color="'+e.data.hover_color+'" type="'+e.data.type+'"]<br class="nc"/>');
						}
					});
				}
			});

        },


    });

    // Register plugin
    tinymce.PluginManager.add( 'cactus_shortcode_button_icon', tinymce.plugins.Cactus_classic_editor_icon );
})();