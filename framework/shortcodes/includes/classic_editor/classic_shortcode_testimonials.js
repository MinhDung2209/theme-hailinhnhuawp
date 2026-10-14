(function() {
    tinymce.create('tinymce.plugins.CactusShortcode_animation_testimonials', {
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
			ed.addButton( 'testimonials', {
				text: '',
				tooltip: 'Testimonials',
				image: url + '/images/testimonials-icon.png',
				onclick: function() {
					ed.windowManager.open({
						title: 'Testimonials',
						body: [
							{type: 'listbox', 
								name: 'auto_play', 
								label: 'Type', 
								'values': [
									{text: 'True', value: '1'},
									{text: 'False', value: '0'},
								]
							},
						],
						onsubmit: function(e) {
							var uID =  Math.floor((Math.random()*100)+1);
							// Insert content when the window form is submitted
							ed.insertContent('[testimonials auto_play="'+e.data.auto_play+'"][testimonialitem name="john doe" position="Vice Pressident of Sales" img="27"]Their products are the best on the market and they have always been great people to work with. Our relationship has always been important to the success of my business. They are a perfect 5 stars![/testimonialitem][testimonialitem name="john doe" position="Vice Pressident of Sales" img="324"]Their products are the best on the market and they have always been great people to work with. Our relationship has always been important to the success of my business. They are a perfect 5 stars![/testimonialitem][/testimonials]<br class="nc"/>');
						}
					});
				}
			});
			
			
        },
 
        
    });
 
    // Register plugin
    tinymce.PluginManager.add( 'cactus_shortcode_animation_testimonials', tinymce.plugins.CactusShortcode_animation_testimonials );
})();