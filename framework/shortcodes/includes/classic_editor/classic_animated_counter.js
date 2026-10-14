(function() {
    tinymce.create('tinymce.plugins.CactusShortcode_animation_counter', {
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
			ed.addButton( 'animation-counter', {
				text: '',
				tooltip: 'Animated Counter',
				image: url + '/images/counter.png',
				onclick: function() {
					ed.windowManager.open({
						title: 'Animated Counter',
						body: [
							{type: 'textbox', name: 'value', label: 'Value',value:"6789"},
							{type: 'textbox', name: 'title', label: 'Title'},							
							{type: 'textbox', name: 'num_color', label: 'Number Color', value:"#", id: 'newcolorpicker_num_color'},
							{type: 'textbox', name: 'text_color', label: 'Text Color', value:"#", id: 'newcolorpicker_text_color'},
							{type: 'textbox', name: 'content', label: 'Content'}
						],
						onsubmit: function(e) {
							var uID =  Math.floor((Math.random()*100)+1);
							// Insert content when the window form is submitted
							ed.insertContent('[counter value="'+e.data.value+'" title="'+e.data.title+'" num_color="'+e.data.num_color+'" text_color="'+e.data.text_color+'"]'+e.data.content+'[/counter]<br class="nc"/>');
						}
					});
				}
			});
			
			
        },
 
        
    });
 
    // Register plugin
    tinymce.PluginManager.add( 'cactus_shortcode_animation_counter', tinymce.plugins.CactusShortcode_animation_counter );
})();