<?php
if (!function_exists( 'add_action' )) {
	echo 'Hi there!  I\'m just a component of a Wordpress plugin. Not much I can do when called directly.';
	exit;
}
?><noscript class="notice"><i class="dashicons dashicons-editor-help"></i> You have disabled Javascript on your browser. Please enable it as this page cannot work without Javascript.</noscript>
<div class="wrap" id="SettingsView">
	
    <h1>HTML Minifier &mdash; <?= __('Settings','html-minifier'); ?></h1><?php
		$p = HTMLMinifier_Manager::PLUGIN_OPTIONS_PREFIX;
		if(isset($GLOBALS[$p . 'settings_notice_message']) && isset($GLOBALS[$p . 'settings_notice_class']))
			echo '<div class="' . $GLOBALS[$p . 'settings_notice_class'] . '"><p>' . $GLOBALS[$p . 'settings_notice_message'] . '</p></div>';
	?><h2 class="nav-tab-wrapper">
		<a href="#primary-settings" class="nav-tab"><?= __('Primary Settings','html-minifier'); ?></a>
		<a href="#advanced-settings" class="nav-tab"><?= __('Advanced Settings','html-minifier'); ?></a>
		<a href="#caching" class="nav-tab"><?= __('Caching','html-minifier'); ?></a>
		<a href="#feedback-bug-report" class="nav-tab"><?= __('Feedback &amp; Bug Reporting','html-minifier'); ?></a>
		<a href="#about" class="nav-tab"><?= __('About','html-minifier'); ?></a>
	</h2>
	<form method="post" action="#primary-settings" id="primary-settings" class="nav-window">
		<?php wp_nonce_field( HTMLMinifier_Manager::PLUGIN_OPTIONS_PREFIX.'settings_nonce', HTMLMinifier_Manager::PLUGIN_OPTIONS_PREFIX.'settings_nonce',true,true); ?>
		<table class="form-table">
            <tbody>
				<tr>
                    <th scope="row"><?= __('Use Presets','html-minifier'); ?><br/>
						<small class="cat-tooltip"><?= __("Don't know how to setup HTML Minifier? Start off with these presets.",'html-minifier'); ?></small>
					</th>
                    <td valign="top">
						<legend class="screen-reader-text"><span><?= __('Quick Presets','html-minifier'); ?></span></legend>
						<input type="submit" name="super_safe" id="super_safe" value="<?= __('Super Safe','html-minifier'); ?>" class="button-secondary tooltip button-presets" title="<?= __('Only the absolute safest minification options are selected.','html-minifier'); ?>"/>
						<input type="submit" name="safe" id="safe" value="<?= __('Safe (Default)','html-minifier'); ?>" class="button-secondary tooltip button-presets" title="<?= __('Default settings that the plugin comes with.','html-minifier'); ?>"/>
						<input type="submit" name="moderate" id="moderate" value="<?= __('Moderate','html-minifier'); ?>" class="button-secondary tooltip button-presets" title="<?= __('Only the riskiest options are left out.','html-minifier'); ?>"/>
						<input type="submit" name="fully_optimised" id="fully_optimised" value="<?= __('Fully-Optimised','html-minifier'); ?>" class="button-secondary tooltip button-presets" title="<?= __("Optimises everything. 'Nuff said.",'html-minifier'); ?>"/>
                    </td>
                </tr>
				<!--tr class="show-more"><td></td><td><a href="javascript:" data-less="Show less options &uarr;" data-more="Show more options &darr;">Show more options &darr;</a></td></tr-->
				<tr>
                    <th scope="row"><?= __('General Options','html-minifier'); ?><br/><small class="cat-tooltip"><?= __("Mouse over each option for more information.",'html-minifier'); ?></small></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?= __('General Options','html-minifier'); ?></span></legend>
							<p><label for="clean_html_comments" class="tooltip" title="<?= __('Removes all HTML comments, except those with conditional tags.','html-minifier'); ?>">								
								<input type="checkbox" name="clean_html_comments" id="clean_html_comments" value="1"<?php 
									if(isset(HTMLMinifier_Manager::$CurrentOptions['core']['clean_html_comments']) && HTMLMinifier_Manager::$CurrentOptions['core']['clean_html_comments']) echo ' checked="checked"';
								?>/> <?= __('Remove HTML comments','html-minifier'); ?>
							</label></p>
							<p><label for="show_signature" class="tooltip" title="<?= __('Adds a HTML comment about this plugin at the end of the minified source.','html-minifier'); ?>">
								<input type="checkbox" name="show_signature" id="show_signature" value="1"<?php 
									if(isset(HTMLMinifier_Manager::$CurrentOptions['core']['show_signature']) && HTMLMinifier_Manager::$CurrentOptions['core']['show_signature']) echo ' checked="checked"';
								?>/> <?= __('Show signature in source','html-minifier'); ?>
							</label></p>
							<p><label for="merge_multiple_head_tags" class="tooltip" title="<?= __('If there are multiple &lt;head&gt; tags in the document, they will be merged.','html-minifier'); ?>">
								<input type="checkbox" name="merge_multiple_head_tags" id="merge_multiple_head_tags" value="1"<?php 
									if(isset(HTMLMinifier_Manager::$CurrentOptions['core']['merge_multiple_head_tags']) && HTMLMinifier_Manager::$CurrentOptions['core']['merge_multiple_head_tags']) echo ' checked="checked"';
								?>/> <?= __('Merge multiple <code>&lt;head&gt;</code> tags','html-minifier'); ?>
							</label></p>
							<p><label for="merge_multiple_body_tags" class="tooltip" title="<?= __('If there are multiple &lt;body&gt; tags in the document, they will be merged.','html-minifier'); ?>">
								<input type="checkbox" name="merge_multiple_body_tags" id="merge_multiple_body_tags" value="1"<?php 
									if(isset(HTMLMinifier_Manager::$CurrentOptions['core']['merge_multiple_body_tags']) && HTMLMinifier_Manager::$CurrentOptions['core']['merge_multiple_body_tags']) echo ' checked="checked"';
								?>/> <?= __('Merge multiple <code>&lt;body&gt;</code> tags','html-minifier'); ?>
							</label></p>
                        </fieldset>
                    </td>
                </tr>
				<tr>
                    <th scope="row"><?= __('Stylesheet Optimisation','html-minifier'); ?><br/><small class="cat-tooltip"><?= __("Mouse over each option for more information.",'html-minifier'); ?></small></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?= __('Stylesheet Optimisation','html-minifier'); ?></span></legend>
                            <p><label for="clean_css_comments" class="tooltip" title="<?= __('Removes all comments in CSS embedded on the page.','html-minifier'); ?>">
								<input type="checkbox" name="clean_css_comments" id="clean_css_comments" value="1"<?php
									$clean_css_comments = isset(HTMLMinifier_Manager::$CurrentOptions['core']['clean_css_comments']) && HTMLMinifier_Manager::$CurrentOptions['core']['clean_css_comments'];
									if($clean_css_comments) echo ' checked="checked"';
								?>/> <?= __('Remove comments in <code>&lt;style&gt;</code> tags','html-minifier'); ?>
							</label></p>
							<p><label for="remove_comments_with_cdata_tags_css" class="tooltip" title="<?= __('In XHTML, content inside &lt;CSS&gt; tags are encapsulated with opening and closing CDATA tags that are commented out. This makes the document XML-compatible, so comments containing CDATA tags should not be removed.','html-minifier'); ?>" rel="clean_css_comments" style="padding-left:1.7em;<?php
								if(!$clean_css_comments) echo 'display:none;'
							?>">
								<input type="checkbox" name="remove_comments_with_cdata_tags_css" id="remove_comments_with_cdata_tags_css" value="1"<?php 
									if(isset(HTMLMinifier_Manager::$CurrentOptions['core']['clean_css_comments']['remove_comments_with_cdata_tags_css']) && HTMLMinifier_Manager::$CurrentOptions['core']['clean_css_comments']['remove_comments_with_cdata_tags_css']) echo ' checked="checked"';
								?>/> <?= __('Remove <code>&lt;style&gt;</code> comments containing <code>CDATA</code> tags','html-minifier'); ?>
							</label></p>
							<p><label for="shift_link_tags_to_head" class="tooltip" title="<?= __('Includes all &lt;link&gt; tags outside of &lt;head&gt;.','html-minifier'); ?>">
								<input type="checkbox" name="shift_link_tags_to_head" id="shift_link_tags_to_head" value="1"<?php
									$shift_link_tags_to_head = isset(HTMLMinifier_Manager::$CurrentOptions['core']['shift_link_tags_to_head']) && HTMLMinifier_Manager::$CurrentOptions['core']['shift_link_tags_to_head'];
									if($shift_link_tags_to_head) echo ' checked="checked"';
								?>/> <?= __('Shift all <code>&lt;link&gt;</code> tags into <code>&lt;head&gt;</code>','html-minifier'); ?>
							</label></p>
							<p><label for="ignore_link_schema_tags" class="tooltip" title="<?= __('Schema.org tags are tags used by search engines. You are recommended to check this.','html-minifier'); ?>" rel="shift_link_tags_to_head" style="padding-left:1.7em;<?php if(!$shift_link_tags_to_head) echo 'display:none;'?>">
								<input type="checkbox" name="ignore_link_schema_tags" id="ignore_link_schema_tags" value="1"<?php 
									if(isset(HTMLMinifier_Manager::$CurrentOptions['core']['shift_link_tags_to_head']['ignore_link_schema_tags']) && HTMLMinifier_Manager::$CurrentOptions['core']['shift_link_tags_to_head']['ignore_link_schema_tags']) echo ' checked="checked"';
								?>/> <?= __('Ignore all Schema.org <code>&lt;link&gt;</code> tags','html-minifier'); ?>
							</label></p>
							<p><label for="shift_meta_tags_to_head" class="tooltip" title="<?= __('Includes all &lt;meta&gt; tags outside of &lt;head&gt;.','html-minifier'); ?>">
								<input type="checkbox" name="shift_meta_tags_to_head" id="shift_meta_tags_to_head" value="1"<?php
									$shift_meta_tags_to_head = isset(HTMLMinifier_Manager::$CurrentOptions['core']['shift_meta_tags_to_head']) && HTMLMinifier_Manager::$CurrentOptions['core']['shift_meta_tags_to_head'];
									if($shift_meta_tags_to_head) echo ' checked="checked"';
								?>/> <?= __('Shift all <code>&lt;meta&gt;</code> tags into <code>&lt;head&gt;</code>','html-minifier'); ?>
							</label></p>
							<p><label for="ignore_meta_schema_tags" class="tooltip" title="<?= __('Schema.org tags are tags used by search engines. You are recommended to check this.','html-minifier'); ?>" rel="shift_meta_tags_to_head" style="padding-left:1.7em;<?php
								if(!$shift_meta_tags_to_head) echo 'display:none;'
							?>">
								<input type="checkbox" name="ignore_meta_schema_tags" id="ignore_meta_schema_tags" value="1"<?php 
									if(isset(HTMLMinifier_Manager::$CurrentOptions['core']['shift_meta_tags_to_head']['ignore_meta_schema_tags']) && HTMLMinifier_Manager::$CurrentOptions['core']['shift_meta_tags_to_head']['ignore_meta_schema_tags']) echo ' checked="checked"';
								?>/> <?= __('Ignore all Schema.org <code>&lt;meta&gt;</code> tags','html-minifier'); ?>
							</label></p>
							<p><label for="shift_style_tags_to_head" class="tooltip" title="<?= __('Includes all &lt;style&gt; tags outside of &lt;head&gt;.','html-minifier'); ?>">
								<input type="checkbox" name="shift_style_tags_to_head" id="shift_style_tags_to_head" value="1"<?php 
									$shift_style_tags_to_head = isset(HTMLMinifier_Manager::$CurrentOptions['core']['shift_style_tags_to_head']) && HTMLMinifier_Manager::$CurrentOptions['core']['shift_style_tags_to_head'];
									if($shift_style_tags_to_head) echo ' checked="checked"';
								?>/> <?= __('Shift all <code>&lt;style&gt;</code> tags into <code>&lt;head&gt;</code>','html-minifier'); ?>
							</label></p>
							<p><label for="combine_style_tags" class="tooltip" title="<?= __('Combines CSS in the separate &lt;style&gt; tags across the document together. Will not combine tags with different media attributes.','html-minifier'); ?>" rel="shift_style_tags_to_head" style="padding-left:1.7em;<?php
								if(!$shift_style_tags_to_head) echo 'display:none;'
							?>">
								<input type="checkbox" name="combine_style_tags" id="combine_style_tags" value="1"<?php 
									if(isset(HTMLMinifier_Manager::$CurrentOptions['core']['shift_style_tags_to_head']['combine_style_tags']) && HTMLMinifier_Manager::$CurrentOptions['core']['shift_style_tags_to_head']['combine_style_tags']) echo ' checked="checked"';
								?>/> <?= __('Combine CSS in <code>&lt;style&gt;</code> tags','html-minifier'); ?>
							</label></p>
                        </fieldset>
                    </td>
                </tr>
				<tr>
                    <th scope="row"><?= __('Script Optimisation','html-minifier'); ?><br/><small class="cat-tooltip"><?= __("If your code breaks after activating the plugin, try checking only the default options in this section (i.e. remove Javascript comments and don't compress &lt;script&gt; contents).",'html-minifier'); ?></small></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?= __('Script Optimisation','html-minifier'); ?></span></legend>
                            
							<p><label for="clean_js_comments" class="tooltip" title="<?= __('Removes all comments in Javascript embedded on the page.','html-minifier'); ?>">
								<input name="clean_js_comments" type="checkbox" id="clean_js_comments" value="1"<?php
									$clean_js_comments = isset(HTMLMinifier_Manager::$CurrentOptions['core']['clean_js_comments']) && HTMLMinifier_Manager::$CurrentOptions['core']['clean_js_comments'];
									if($clean_js_comments) echo ' checked="checked"';
								?>/> <?= __('Remove Javascript comments','html-minifier'); ?>
							</label></p>
							<p><label for="remove_comments_with_cdata_tags_js" class="tooltip" title="<?= __('In XHTML, content inside &lt;script&gt; tags are encapsulated with opening and closing CDATA tags that are commented out. This makes the document XML-compatible, so comments containing CDATA tags should not be removed.','html-minifier'); ?>" rel="clean_js_comments" style="padding-left:1.7em;<?php
								if(!$clean_js_comments) echo 'display:none;'
							?>">
								<input type="checkbox" name="remove_comments_with_cdata_tags_js" id="remove_comments_with_cdata_tags_js" value="1"<?php 
									if(isset(HTMLMinifier_Manager::$CurrentOptions['core']['clean_js_comments']['remove_comments_with_cdata_tags_js']) && HTMLMinifier_Manager::$CurrentOptions['core']['clean_js_comments']['remove_comments_with_cdata_tags_js']) echo ' checked="checked"';
								?>/> <?= __('Remove Javascript comments containing CDATA tags','html-minifier'); ?>
							</label></p>
							<p><label for="shift_script_tags_to_bottom" class="tooltip" title="<?= __('Moves all existing &lt;script&gt; tags in the page to the bottom. Might cause on-page Javascript to break, depending on how your page is scripted.','html-minifier'); ?>">
								<input name="shift_script_tags_to_bottom" type="checkbox" id="shift_script_tags_to_bottom" value="1"<?php
									$shift_script_tags_to_bottom = isset(HTMLMinifier_Manager::$CurrentOptions['core']['shift_script_tags_to_bottom']) && HTMLMinifier_Manager::$CurrentOptions['core']['shift_script_tags_to_bottom'];
									if($shift_script_tags_to_bottom) echo ' checked="checked"';
								?>/> <?= __('Shift all <code>&lt;script&gt;</code> tags to the end of <code>&lt;body&gt;</code>','html-minifier'); ?>
							</label>
							<i class="dashicons dashicons-editor-help warning-toggle orange tooltip" title="<?= __('This and its child options may break some parts of your site, depending on how your Javascript is written. Test after activating.','html-minifier'); ?>"></i>
							</p>
							<p><label for="combine_javascript_in_script_tags" class="tooltip" title="<?= __('Only applicable for &lt;script&gt; tags with an unspecified MIME type or of MIME type &quot;text/javascript&quot;.','html-minifier'); ?>" rel="shift_script_tags_to_bottom" style="padding-left:1.7em;<?php 
								if(!$shift_script_tags_to_bottom) echo 'display:none;'
							?>">
								<input name="combine_javascript_in_script_tags" type="checkbox" id="combine_javascript_in_script_tags" value="1"<?php 
									if(isset(HTMLMinifier_Manager::$CurrentOptions['core']['shift_script_tags_to_bottom']['combine_javascript_in_script_tags']) && HTMLMinifier_Manager::$CurrentOptions['core']['shift_script_tags_to_bottom']['combine_javascript_in_script_tags']) echo ' checked="checked"';
								?>/> <?= __('Combine Javascript in <code>&lt;script&gt;</code> tags','html-minifier'); ?></label>
							</p>
							<p><label for="ignore_async_and_defer_tags" class="tooltip" title="<?= __('Only applicable for &lt;script&gt; tags with an unspecified MIME type or of MIME type &quot;text/javascript&quot;.','html-minifier'); ?>" rel="shift_script_tags_to_bottom" style="padding-left:1.7em;<?php 
								if(!$shift_script_tags_to_bottom) echo 'display:none;'
							?>">
								<input name="ignore_async_and_defer_tags" type="checkbox" id="ignore_async_and_defer_tags" value="1"<?php 
									if(isset(HTMLMinifier_Manager::$CurrentOptions['core']['shift_script_tags_to_bottom']['ignore_async_and_defer_tags']) && HTMLMinifier_Manager::$CurrentOptions['core']['shift_script_tags_to_bottom']['ignore_async_and_defer_tags']) echo ' checked="checked"';
								?>/> <?= __('Ignore <code>&lt;script&gt;</code> tags labelled <code>async</code> or <code>defer</code>','html-minifier'); ?>
							</label></p>
                        </fieldset>
                    </td>
                </tr>
				<tr>
                    <th scope="row"><label for="compression_mode"><?= __('Compression Mode','html-minifier'); ?></label></th>
                    <td>
                        <fieldset>
							<legend class="screen-reader-text"><span><?= __('Compression Mode','html-minifier'); ?></span></legend>
							<select name="compression_mode" id="compression_mode">
								<?php
								if(class_exists('HTMLMinifier')) 
									foreach(HTMLMinifier::$CompressionMode as $k => $v)
										echo '<option value="'.$k.'"'.(HTMLMinifier_Manager::$CurrentOptions['core']['compression_mode']===$k?' selected="selected"':'').'>'.__($v,'html-minifier').'</option>';
								?>
							</select>
							<i class="dashicons dashicons-editor-help warning-toggle orange tooltip" title="<?= __('Using \'all_whitespace\' may break some parts of Javascript in your site. Test if you are using it.','html-minifier'); ?>"></i>
                        </fieldset>
                    </td>
                </tr>
				<tr>
                    <th scope="row"><?= __('Compression Ignored Tags','html-minifier'); ?><br/><small class="cat-tooltip"><?= __("Specify the tags which have content that shouldn't be compressed.",'html-minifier'); ?></small></th>
                    <td>
                        <fieldset id="compression_ignored_tags">
							<legend class="screen-reader-text"><span><?= __('Compression Ignored Tags','html-minifier'); ?></span></legend>
							<noscript>Please enable Javascript, or this section will not work.</noscript>
							<div>
								<script type="text/template"><fieldset class="ignored-tag">
									<input type="text" placeholder="Fill in tag name" name="compression_ignored_tags[]"/> <a href="javascript:" class="delete-tag"><span class="dashicons dashicons-trash"></span></a>
								</fieldset></script><?php
								foreach(HTMLMinifier_Manager::$CurrentOptions['core']['compression_ignored_tags'] as $tag) {
									?><fieldset class="ignored-tag"><input type="text" placeholder="Fill in tag name" name="compression_ignored_tags[]" value="<?= $tag; ?>"/> <a href="javascript:" class="delete-tag"><span class="dashicons dashicons-trash"></span></a></fieldset><?php
								} ?>
							</div>
							<a href="javascript:" class="add-new-tag">Add a new tag</a>
                        </fieldset>
                    </td>
                </tr>
				<tr>
                    <th scope="row"></th>
                    <td>
                        <input type="submit" name="submit-core" id="submit-core" class="button-primary" value="<?= __('Save Changes','html-minifier'); ?>"/>
					</td>
                </tr>
            </tbody>
        </table>
	</form>
	
	<form method="post" action="#advanced-settings" id="advanced-settings" class="nav-window">
		<?php wp_nonce_field( HTMLMinifier_Manager::PLUGIN_OPTIONS_PREFIX.'settings_nonce', HTMLMinifier_Manager::PLUGIN_OPTIONS_PREFIX.'settings_nonce',true,true); ?>
		<p class="notice"><i class="dashicons dashicons-editor-help"></i> <?= __('The settings below are very powerful, but &mdash; depending on your server configuration &mdash; might also cause errors that lock you of your site. Make sure you know how to restore your site if you try these features.','html-minifier'); ?></p>
		<table class="form-table">
			<tbody>
				<tr>
                    <th scope="row"><?= __('Minify Resource Files','html-minifier'); ?><br/><small class="cat-tooltip"><?= __('Minifies CSS (<em>.css</em>) and Javascript (<em>.js</em>) resource files (themes and plugins usually do not minify their own resource files).','html-minifier'); ?></small></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?= __('Minify CSS files','html-minifier'); ?></span></legend>
                            <p><label for="minify_css_files" class="tooltip" title="<?= __('Minifies CSS files that are served from this Wordpress installation.','html-minifier'); ?>">
								<input type="checkbox" name="minify_css_files" id="minify_css_files" value="1"<?php 
									if(!empty(HTMLMinifier_Manager::$CurrentOptions['manager']['minify_css_files'])) echo ' checked="checked"';
								?>/> <?= __('Minify CSS files (<em>.css</em>)','html-minifier'); ?>
							</label>
							<i class="dashicons dashicons-editor-help warning-toggle red tooltip" title="<?= __('Modifies your .htaccess file. Make sure you know how to work with .htaccess before using this.','html-minifier'); ?>"></i></p>
                        </fieldset>
						<fieldset>
                            <legend class="screen-reader-text"><span><?= __('Minify JS files','html-minifier'); ?></span></legend>
                            <p>
								<label for="minify_js_files" class="tooltip" title="<?= __('Minifies Javascript files that are served from this Wordpress installation.','html-minifier'); ?>">
									<input type="checkbox" name="minify_js_files" id="minify_js_files" value="1"<?php 
										if(!empty(HTMLMinifier_Manager::$CurrentOptions['manager']['minify_js_files'])) echo ' checked="checked"';
									?>/> <?= __('Minify Javascript files (<em>.js</em>)','html-minifier'); ?>
									<br/>
								</label>
								<i class="dashicons dashicons-editor-help warning-toggle orange tooltip" title="<?= __('May also break some of your Javascript if they are not properly truncated. Check your page for errors on your Developer Console after activating.','html-minifier'); ?>"></i>
								<i class="dashicons dashicons-editor-help warning-toggle red tooltip" title="<?= __('Modifies your .htaccess file. Make sure you know how to work with .htaccess before using this.','html-minifier'); ?>"></i>
							</p>
                        </fieldset>
                    </td>
                </tr>
				<tr>
                    <th scope="row">
						<label for="ignore_rsc_minify_regex"><?= __('Browser Resource Caching','html-minifier'); ?></label><br/>
						<small class="cat-tooltip"><?= __('If not 0, tells the client browser to cache minified resource files.','html-minifier'); ?></small>
					</th>
                    <td>
                        <fieldset>
                            <input type="number" name="browser_rsc_caching" id="browser_rsc_caching" step="1" min="0" max="999" value="<?php 
								if(isset(HTMLMinifier_Manager::$CurrentOptions['manager']['browser_rsc_caching']) && HTMLMinifier_Manager::$CurrentOptions['manager']['browser_rsc_caching']) echo HTMLMinifier_Manager::$CurrentOptions['manager']['browser_rsc_caching'];
								else echo '24'
							?>"/> &nbsp;hours
                        </fieldset>
                    </td>
                </tr>
				<tr>
                    <th scope="row">
						<label for="ignore_rsc_minify_regex"><?= __('Don\'t Minify Resources with&hellip;','html-minifier'); ?></label><br/>
						<small class="cat-tooltip"><?= __('PHP regex (<em>preg</em>) string that specifies which files to not minify. By default, the regex matches some files in WP-include.','html-minifier'); ?></small>
					</th>
                    <td>
                        <fieldset>
                            <input type="text" name="ignore_rsc_minify_regex" id="ignore_rsc_minify_regex" value="<?= empty(HTMLMinifier_Manager::$CurrentOptions['manager']['ignore_rsc_minify_regex']) ? '/jquery/i' : HTMLMinifier_Manager::$CurrentOptions['manager']['ignore_rsc_minify_regex']; ?>" style="font-family:monospace;"/>
                        </fieldset>
                    </td>
                </tr>
				<tr>
                    <th scope="row"><?= __('Minify Site Components','html-minifier'); ?><br/><small class="cat-tooltip"><?= __("Avoid changing the settings in this section unless you know what you're doing.",'html-minifier'); ?></small></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?= __('Minify WP-Admin source','html-minifier'); ?></span></legend>
                            <p>
								<label for="minify_wp_admin" class="tooltip" title="<?= __('Minifies the HTML source of WP-Admin pages according to the settings above. WARNING: Might break WP-Admin depending on the theme / plugins installed.','html-minifier'); ?>">
									<input type="checkbox" name="minify_wp_admin" id="minify_wp_admin" value="1"<?php 
										if(!empty(HTMLMinifier_Manager::$CurrentOptions['manager']['minify_wp_admin'])) echo ' checked="checked"';
									?>/> <?= __('Minify WP-Admin source','html-minifier'); ?>
								</label>
								<i class="dashicons dashicons-editor-help warning-toggle red tooltip" title="<?= __('If activating this breaks your site, delete this plugin via FTP and re-install it.','html-minifier'); ?>"></i>
							</p>
                        </fieldset>
						<fieldset>
                            <legend class="screen-reader-text"><span><?= __('Minify WP front-end source','html-minifier'); ?></span></legend>
                            <p><label for="minify_frontend" class="tooltip" title="<?= __('Minifies the HTML source in the front-end pages shown to site visitors. NOTE: HTML Minifier won\'t work if you disable this.','html-minifier'); ?>">
								<input type="checkbox" name="minify_frontend" id="minify_frontend" value="1"<?php 
									if(!isset(HTMLMinifier_Manager::$CurrentOptions['manager']['minify_frontend']) || HTMLMinifier_Manager::$CurrentOptions['manager']['minify_frontend']) echo ' checked="checked"';
								?>/> <?= __('Minify WP front-end source','html-minifier'); ?>
							</label></p>
                        </fieldset>
                    </td>
                </tr>
				<tr>
                    <th scope="row"></th>
                    <td>
                        <input type="submit" name="submit-manager" id="submit-manager" class="button-primary" value="<?= __('Save Changes','html-minifier'); ?>"/>
						<input type="submit" name="restore_defaults_manager" id="restore_defaults_manager" value="<?= __('Restore Defaults','html-minifier'); ?>" class="button-secondary tooltip button-presets" title="<?= __('Restores the settings on this page to their default values.','html-minifier'); ?>"/>
					</td>
                </tr>
            </tbody>
        </table>
    </form>
	
	<form method="post" action="#caching" id="caching" class="nav-window">
		<?php wp_nonce_field( HTMLMinifier_Manager::PLUGIN_OPTIONS_PREFIX.'settings_nonce', HTMLMinifier_Manager::PLUGIN_OPTIONS_PREFIX.'settings_nonce',true,true); ?>
		<p class="notice"><i class="dashicons dashicons-admin-generic"></i> <?= wp_kses(__('Does not cache web pages at the moment. Use in tandem with <a href="https://wordpress.org/plugins/wp-super-cache/" target="_blank">WP Super Cache</a> if you want to cache pages.','html-minifier'), array('a' => array('href' => array(),'target' => array()))); ?></p>
		<table class="form-table">
            <tbody>
				<tr>
                    <th scope="row"><?= __('Server-side Caching','html-minifier'); ?><br/><small class="cat-tooltip"><?= __('Caches files minified by this plugin.','html-minifier'); ?></small></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?= __('Enable Server-side Resource Caching','html-minifier'); ?></span></legend>
                            <p><label for="enable_rsc_caching" class="tooltip" title="<?= __('Caches resource files (.css or .js) that are minified by HTML Minifier.','html-minifier'); ?>">
								<input type="checkbox" name="enable_rsc_caching" id="enable_rsc_caching" value="1"<?php 
									if(!empty(HTMLMinifier_Manager::$CurrentOptions['caching']['enable_rsc_caching'])) echo ' checked="checked"';
								?>/> <?= __('Enable Server-side Resource Caching','html-minifier'); ?>
							</label></p>
                        </fieldset>
                    </td>
                </tr>
				<tr>
                    <th scope="row">Expiration Time<br/><small class="cat-tooltip"><?= __('How long should cached files be stored?','html-minifier'); ?></small></th>
                    <td>
                        <fieldset class="tooltip" title="How long should cached files be stored?">
                            <legend class="screen-reader-text"><span><?= __('Expiration Time','html-minifier'); ?><span></legend>
                            <input type="number" name="expiration_time" id="expiration_time" step="1" min="0" max="999" value="<?php 
								if(isset(HTMLMinifier_Manager::$CurrentOptions['caching']['expiration_time']) && HTMLMinifier_Manager::$CurrentOptions['caching']['expiration_time']) echo HTMLMinifier_Manager::$CurrentOptions['caching']['expiration_time'];
								else echo '24'
							?>"/> &nbsp;hours
                        </fieldset>
                    </td>
                </tr>
				<tr>
                    <th scope="row">Refresh Cache<br/><small class="cat-tooltip"><?= __('Refreshes the caching system by removing all old cached files.','html-minifier'); ?></small></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?= __('Refresh Cache','html-minifier'); ?></span></legend>
                            <input type="submit" name="clear_cache" id="clear_cache" value="Remove Cached Items" class="button-secondary"/>
							<p><small><strong>Size of cache:</strong> <?= round($size/1000,2); ?> kilobytes</small></p>
                        </fieldset>
                    </td>
                </tr>
				<tr>
                    <th scope="row"></th>
                    <td>
                        <input type="submit" name="submit-caching" id="submit-caching" class="button-primary" value="<?= __('Save Changes','html-minifier'); ?>"/>
						<input type="submit" name="restore_defaults_caching" id="restore_defaults_caching" value="<?= __('Restore Defaults','html-minifier'); ?>" class="button-secondary tooltip button-presets" onclick="return confirm('<?= __('Are you sure? Your current settings will be lost.','html-minifier'); ?>');" title="<?= __('Restores the settings on this page to their default values.','html-minifier'); ?>"/>
					</td>
                </tr>
            </tbody>
        </table>
    </form>

	<form method="post" action="#feedback-bug-report" id="feedback-bug-report" class="nav-window">
		<h2 class="title dashicons-before dashicons-admin-comments"> <?= __('We welcome your feedback','html-minifier'); ?></h2>
		<p class="feedback-field"><?= 
			__("HTML Minifier is a plugin that strives to make the web a more efficient place. Help it perform its duties more effectively by notifying us of any bugs you may find, or by giving us feedback on how to make it better.",'html-minifier');
		?></p>
		<?php echo wp_nonce_field( HTMLMinifier_Manager::PLUGIN_OPTIONS_PREFIX.'feedback_nonce', HTMLMinifier_Manager::PLUGIN_OPTIONS_PREFIX.'feedback_nonce',true,true); ?>
        <textarea rows="7" name="feedback-text" id="feedback-text" placeholder="<?= __('Speak away!','html-minifier'); ?>" class="feedback-field"><?php
			if(isset($GLOBALS[HTMLMinifier_Manager::PLUGIN_OPTIONS_PREFIX . 'feedback_error_message']))
				echo esc_textarea($GLOBALS[HTMLMinifier_Manager::PLUGIN_OPTIONS_PREFIX . 'feedback_error_message']);
		?></textarea>
		<p class="submit">
			<input type="submit" name="submit-feedback" id="submit-feedback" class="button button-primary" value="<?= __('Send Your Feedback','html-minifier'); ?>"/>
		</p>
    </form>
	
	<div id="about" class="nav-window">
		<h2 class="title dashicons-before dashicons-info"> <?= __('About HTML Minifier','html-minifier'); ?></h2>
		<p class="feedback-field"><?= __('HTML Minifier is a server-side source code minifier, reorganiser and caching tool and that is available both as a PHP class and as a WordPress plugin. It is designed to optimise HTML, CSS and Javascript output sent out to the client by removing whitespace, and by reorganising and / or merging &lt;link&gt;, &lt;style&gt; and &lt;script&gt; tags scattered across HTML pages that are built dynamically on server-side applications.','html-minifier'); ?></p>
		<p class="feedback-field"><?= __('A variety of optimisation options and minification styles are available in the plugin, and they can be selected from or toggled depending on the user\'s needs. To see more information about what each option does or to download the PHP version, <a href="http://www.terresquall.com/web/html-minifier/" target="_blank">click here</a>.','html-minifier'); ?></p>
		<p class="feedback-field"><?= __('There is also a <a href="https://github.com/terresquall/html-minifier">GitHub repository</a> for the project, if you want to contribute. Alternatively, <a href="https://paypal.me/Terresquall" target="_blank">donations</a> are also always welcome.','html-minifier'); ?></p>
		<table class="about-table">
            <tbody>
				<tr>
                    <th rowspan="6" class="about-logo">
						<img src="<?= HTML_MINIFIER__PLUGIN_URL; ?>assets/icon-256x256.png"/>
					</th>
                    <th scope="row"><?= __('Plugin Version:','html-minifier'); ?></th>
					<td><?php echo HTML_MINIFIER_PLUGIN_VERSION; ?></td>
                </tr>
				<tr>
					<th scope="row"><?= __('Release Date','html-minifier'); ?>:</th>
					<td><?php echo HTML_MINIFIER_PLUGIN_VERSION_DATE; ?></td>
				</tr>
				<tr>
					<th scope="row"><?= __('Minifier Version','html-minifier'); ?>:</th>
					<td><?php echo HTML_MINIFIER_VERSION; ?></td>
				</tr>
				<tr>
					<th scope="row"><?= __('Database Version','html-minifier'); ?>:</th>
					<td><?php echo isset(HTMLMinifier_Manager::$CurrentOptions['version']) ? HTMLMinifier_Manager::$CurrentOptions['version'] : '0'; ?></td>
				</tr>
				<tr>
					<th scope="row"><?= __('Plugin Website:','html-minifier'); ?></th>
					<td><a href="https://www.terresquall.com/web/html-minifier/" target="_blank">https://www.terresquall.com/web/html-minifier/</a></td>
				</tr>
				<tr>
					<th scope="row"><?= __('GitHub','html-minifier'); ?>:</th>
					<td><a href="https://github.com/terresquall/html-minifier" target="_blank">https://github.com/terresquall/html-minifier</a></td>
				</tr>
				<tr class="post-logo-row">
					<td></td>
					<th scope="row"><?= __('Donate','html-minifier'); ?>:</th>
					<td><a href="https://paypal.me/Terresquall" target="_blank">https://paypal.me/Terresquall</a></td>
				</tr>
            </tbody>
        </table>
	</div>
</div>
<script>
'use strict';
var HTMLMinifierSettings = {
	mustRemoveComments: "<?= __('Javascript / CSS comments must be removed using the current Compression Mode.','html-minifier'); ?>",
	restURL: "<?= admin_url('options-general.php?page='.HTMLMinifier_Admin::OPTIONS); ?>",
	defaults: <?= json_encode(HTMLMinifier_Manager::$Defaults); ?>
};
</script>