<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/setup.php',     // Theme setup
  'lib/bb-pagination.php', // fixes for pagination
  'lib/acf-fields.php',
  'lib/bb-featured.php',
  'lib/timber.php',
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

// allows for checking to see if plugins are active so can prevent errors when plugins are inactive
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
