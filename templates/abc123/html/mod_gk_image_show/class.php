<?php

if(!class_exists('GKImageShowTemplate')){
	class GKImageShowTemplate{
		// 
		var $ID;
		// 
		var $config;
		// 
		var $path;
	 	// 
		var $settings;
		// 
		var $slides;
		// 
		function GKImageShowTemplate( $module_id, $settings, $base_path, $group_settings, $slide_data ){
			$this->ID = $module_id;
			$this->path = $base_path;
			$this->settings = $group_settings;
			$this->slides = $slide_data;
			//
			$this->parse($settings);
			$this->generate();
		}
		// 
		function returnJSData(){
			return array(
				"animation_speed" => $this->config['animation_speed'],
				"animation_interval" => $this->config['animation_interval'],
				"autoanimation" => $this->config['autoanimation'],
				"animation_type" => $this->config['animation_type'],
				"preloading" => $this->config['preloading'],
				"slide_links" => $this->config['slide_links']
			);
		}
		// 
		function parse($settings){
			// creating configuration array (hash)
			$this->config = array(
										"thumbs" => true,
										"thumbs_top" => 20,
										"thumbs_left" => 20,
										"pagination_left" => 20,
										"pagination_top" => 350,
										"text_block" => true,
										"text_width" => 500,
										"text_height" => 150,
										"text_left" => 0,
										"text_top" => 200,
										"show_title" => true, // true|false
										"title_link" => true, // true |false
										"clean_xhtml" => true,
										"wordcount" => 40,
										"slide_links" => true, // true |false
										"preloading" => true, // true |false
										"animation_speed" => 500,
										"animation_interval" => 5000,
										"autoanimation" => true, // true |false
										"animation_type" => 'opacity' // top|bottom|right|left|opacity
									);
			// exploding settings
			$settings = preg_replace("/\n$/", '', $settings);
			$exploded_settings = explode(';', $settings);
			// parsing
			for( $i = 0; $i < count($exploded_settings) - 1; $i++ )
			{
				// preparing pair key-value
				$pair = explode('=', trim($exploded_settings[$i]));
				// extracting key and value from pair	
				$key = $pair[0];
				$value = $pair[1];	
				// checking existing of key in config array
				if(isset($this->config[$key]))
				{
					// setting value for key
					$this->config[$key] = $value;
				}
			}	
		}
		// 
		function generate(){
			require(JModuleHelper::getLayoutPath('mod_gk_image_show', 'content'));
		}
	}
}

?>