<?php

return array(

	////////////////////////////////////////
	// Localized JS Message Configuration //
	////////////////////////////////////////

	/**
	 * Validation Messages
	 */
	'validation' => array(
		'alphabet'     => __('Value needs to be Alphabet', 'wp-ultimate-post-grid'),
		'alphanumeric' => __('Value needs to be Alphanumeric', 'wp-ultimate-post-grid'),
		'numeric'      => __('Value needs to be Numeric', 'wp-ultimate-post-grid'),
		'email'        => __('Value needs to be Valid Email', 'wp-ultimate-post-grid'),
		'url'          => __('Value needs to be Valid URL', 'wp-ultimate-post-grid'),
		'maxlength'    => __('Length needs to be less than {0} characters', 'wp-ultimate-post-grid'),
		'minlength'    => __('Length needs to be more than {0} characters', 'wp-ultimate-post-grid'),
		'maxselected'  => __('Select no more than {0} items', 'wp-ultimate-post-grid'),
		'minselected'  => __('Select at least {0} items', 'wp-ultimate-post-grid'),
		'required'     => __('This is required', 'wp-ultimate-post-grid'),
	),

	/**
	 * Import / Export Messages
	 */
	'util' => array(
		'import_success'    => __('Import succeed, option page will be refreshed..', 'wp-ultimate-post-grid'),
		'import_failed'     => __('Import failed', 'wp-ultimate-post-grid'),
		'export_success'    => __('Export succeed, copy the JSON formatted options', 'wp-ultimate-post-grid'),
		'export_failed'     => __('Export failed', 'wp-ultimate-post-grid'),
		'restore_success'   => __('Restoration succeed, option page will be refreshed..', 'wp-ultimate-post-grid'),
		'restore_nochanges' => __('Options identical to default', 'wp-ultimate-post-grid'),
		'restore_failed'    => __('Restoration failed', 'wp-ultimate-post-grid'),
	),

	/**
	 * Control Fields String
	 */
	'control' => array(
		// select2 select box
		'select2_placeholder' => __('Select option(s)', 'wp-ultimate-post-grid'),
		// fontawesome chooser
		'fac_placeholder'     => __('Select an Icon', 'wp-ultimate-post-grid'),
	),

);

/**
 * EOF
 */