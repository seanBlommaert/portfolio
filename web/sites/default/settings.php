<?php

/**
 * @file
 * Drupal site-specific configuration file.
 */

/**
 * Trusted host configuration.
 */
$settings['trusted_host_patterns'] = [
  '^seanblommaert\.nl',
  '^www\.seanblommaert\.nl',
];

/**
 * Configuration overrides.
 *
 * $config['system.site']['name'] = 'My Drupal site';
 */
$config['config_split.config_split.development']['status'] = FALSE;
$config['config_split.config_split.excluded']['status'] = TRUE;

/**
 * Hide error logs.
 */
$config['system.logging']['error_level'] = 'hide';

/**
 * Set performance defaults.
 */
$config['system.performance']['css']['preprocess'] = TRUE;
$config['system.performance']['js']['preprocess'] = TRUE;
$config['system.performance']['minifyhtml']['minify_html'] = TRUE;
$config['system.performance']['cache']['page']['max_age'] = 86400;

/**
 * Location of the site configuration files.
 */
$settings['config_sync_directory'] = './../config/sync';

/**
 * Public file path.
 */
$settings['file_public_path'] = 'sites/default/files';

/**
 * Private file path.
 */
$settings['file_private_path'] = 'sites/default/files/private';

/**
 * Temp file path.
 */
$settings['file_temp_path'] = $_ENV['TEMP'];

/**
 * Salt for one-time login links, cancel links, form tokens, etc.
 */
$settings['hash_salt'] = 'pETnekQTaYUQhuvNRYLFzI8IVzHV9oRjBx0LvdFmRWjJe4q_iCYhmMPEJ4gOoJXOhMd7QvcvZw';

/**
 * Enable state caching.
 */
$settings['state_cache'] = TRUE;

/**
 * Access control for update.php script.
 */
$settings['update_free_access'] = FALSE;

/**
 * Authorized file system operations.
 */
$settings['allow_authorize_operations'] = FALSE;

/**
 * Load services definition file.
 */
$settings['container_yamls'][] = __DIR__ . '/services.yml';

/**
 * The default list of directories that will be ignored by Drupal's file API.
 */
$settings['file_scan_ignore_directories'] = [
  'node_modules',
  'bower_components',
];

/**
 * Load local development override configuration, if available.
 *
 * Use this for the local database connection, Solr configuration etc.
 */
if (file_exists($app_root . '/../settings/services.local.yml')) {
  $settings['container_yamls'][] = $app_root . '/../settings/services.local.yml';
}
if (file_exists($app_root . '/../settings/settings.local.php')) {
  include $app_root . '/../settings/settings.local.php';
}

// Automatically generated include for settings managed by ddev.
$ddev_settings = __DIR__ . '/settings.ddev.php';
if (getenv('IS_DDEV_PROJECT') == 'true' && is_readable($ddev_settings)) {
  require $ddev_settings;
}
