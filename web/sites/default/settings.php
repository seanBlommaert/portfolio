<?php

/**
 * @file
 * Drupal site-specific configuration file.
 */

/**
 * Configuration overrides.
 *
 * $config['system.site']['name'] = 'My Drupal site';
 */
$config['config_split.config_split.development']['status'] = FALSE;
$config['config_split.config_split.excluded']['status'] = TRUE;

/**
 * Location of the site configuration files.
 */
$config_directories = array(
  'sync' => './../config/sync',
);

/**
 * Public file path.
 */
$settings['file_public_path'] = 'sites/default/files';

/**
 * Private file path.
 */
$settings['file_private_path'] = 'sites/default/files/private';

/**
 * Salt for one-time login links, cancel links, form tokens, etc.
 */
$settings['hash_salt'] = 'pETnekQTaYUQhuvNRYLFzI8IVzHV9oRjBx0LvdFmRWjJe4q_iCYhmMPEJ4gOoJXOhMd7QvcvZw';

/**
 * The active installation profile.
 */
$settings['install_profile'] = 'minimal';

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
