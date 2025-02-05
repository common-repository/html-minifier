<?php
/*
This is a utility class that interfaces with HTMLMinifier_Manager to upgrade the DB entries in HTML Minifier.
*/
require_once HTML_MINIFIER__PLUGIN_DIR . 'inc/src/HTMLMinifier.php';
class HTMLMinifier_Upgrader {
	
	// This will run the $options variable through all the upgrading functions.
	// It will get longer and longer as there are more and more upgrades.
	static function run($options) {
		
		// Stop executing if $options is wrong.
		if(!is_array($options))
			$options = HTMLMinifier_Manager::$Defaults;
		
		// Do the upgrading.
		if(!isset($options['version'])) $options = self::to_1($options);
		if($options['version'] <= 1) $options = self::from_1_to_2($options);
		if($options['version'] <= 2) $options = self::from_2_to_3($options);
		if($options['version'] <= 4) $options = self::from_3_to_5($options);
		if($options['version'] <= 5) $options['version'] = 6;
		
		return $options;
	}
	
	// From no versioning to version 1.
	private static function to_1($options) {
		$minify_wp_admin = $options['minify_wp_admin'];
		unset($options['minify_wp_admin']); // Unnecessary actually because HTMLMinifier_Manager::update_options() automatically sanitizes.
		$arr = array(
			'core' => $options,
			'manager' => array(
				'minify_wp_admin' => $minify_wp_admin,
				'minify_frontend' => 1
			),
			'version' => 1
		);
		return $arr;
	}
	
	// Nests some of the attributes in options inside their dependent attributes.
	private static function from_1_to_2($options) {
		if(isset($options['core']['remove_comments_with_cdata_tags'])) {
			$options['core']['clean_js_comments'] = array('remove_comments_with_cdata_tags_js' => $options['core']['remove_comments_with_cdata_tags']);
			unset($options['core']['remove_comments_with_cdata_tags']);
		}
		
		if(isset($options['core']['combine_style_tags'])) {
			$options['core']['shift_style_tags_to_head'] = array('combine_style_tags' => $options['core']['combine_style_tags']);
			unset($options['core']['combine_style_tags']);
		}
		
		if(isset($options['core']['combine_javascript_in_script_tags'])) {
			$options['core']['shift_script_tags_to_bottom'] = array('combine_javascript_in_script_tags' => $options['core']['combine_javascript_in_script_tags']);
			unset($options['core']['combine_javascript_in_script_tags']);
		}
		
		$options['version'] = 2;
		
		// Set default values for new attributes.
		$options['core']['merge_multiple_head_tags'] = true;
		$options['core']['merge_multiple_body_tags'] = true;
		$options['core']['shift_meta_tags_to_head'] = array('ignore_meta_schema_tags' => true);
		if(!empty($options['core']['shift_link_tags_to_head']))
			$options['core']['shift_link_tags_to_head'] = array('ignore_link_schema_tags' => true);
		if(!empty($options['core']['shift_script_tags_to_bottom'])) {
			if(is_array($options['core']['shift_script_tags_to_bottom'])) $options['core']['shift_script_tags_to_bottom']['ignore_async_and_defer_tags'] = true;
			else $options['core']['shift_script_tags_to_bottom'] = array('ignore_async_and_defer_tags' => true);
		}

		return $options;
	}
	
	// Adds the caching sub-option.
	private static function from_2_to_3($options) {
		if(!isset($options['caching']) || !is_array($options['caching']))
			$options['caching'] = HTMLMinifier_Manager::$CachingDefaults;
		$options['version'] = 3;
		return $options;
	}
	
	private static function from_3_to_5($options) {
		$options['core']['compression_ignored_tags'] = array('textarea','pre');
		if(!empty($options['core']['compression_ignore_script_tags'])) {
			$options['core']['compression_ignored_tags'][] = 'script';
			unset($options['core']['compression_ignore_script_tags']);
		}
		$options['version'] = 5;
		return $options;
	}
	
}
?>