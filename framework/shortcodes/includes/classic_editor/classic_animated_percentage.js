(function() {
    tinymce.create('tinymce.plugins.CactusShortcode_animation_percentage', {
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
			ed.addButton( 'animation-percentage', {
				text: '',
				tooltip: 'Animation Percentage',
				image: url + '/images/percentage.png',
				onclick: function() {
					ed.windowManager.open({
						title: 'Animation Percentage',
						body: [
							{type: 'textbox', name: 'value', label: 'Value',value:"75"},
							{type: 'textbox', name: 'full_color', label: 'Full Color', value:"#fff", id: 'newcolorpicker_full_color'},
							{type: 'textbox', name: 'part_color', label: 'Part Color', value:"#", id: 'newcolorpicker_part_color'},
							{type: 'textbox', name: 'text_color', label: 'Text Color', value:"#", id: 'newcolorpicker_text_color'},
							{type: 'textbox', name: 'num_color', label: 'Number Color', value:"#", id: 'newcolorpicker_number_color'},
							{type: 'textbox', name: 'title', label: 'Title'},
							{type: 'textbox', name: 'content', label: 'Content'}
						],
						onsubmit: function(e) {
							var uID =  Math.floor((Math.random()*100)+1);
							// Insert content when the window form is submitted
							ed.insertContent('[percentage value="'+e.data.value+'" full_color="'+e.data.full_color+'" part_color="'+e.data.part_color+'" text_color="'+e.data.text_color+'" num_color="'+e.data.num_color+'" title="'+e.data.title+'"]'+e.data.content+'[/percentage]<br class="nc"/>');
						}
					});
				}
			});
			
			
        },
 
        
    });
 
    // Register plugin
    tinymce.PluginManager.add( 'cactus_shortcode_animation_percentage', tinymce.plugins.CactusShortcode_animation_percentage );
})();