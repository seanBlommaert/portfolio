<?php

/**
 * @file
 * Drupal site-specific configuration file.
 */

/**
 * Database settings.
 */
$databases['default']['default'] = array(
  'database' => '',
  'username' => '',
  'password' => '',
  'prefix' => '',
  'host' => '127.0.0.1',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);

/**
 * Configuration overrides.
 *
 * $config['system.site']['name'] = 'My Drupal site';
 */
$config['config_split.config_split.development']['status'] = TRUE;
$config['config_split.config_split.excluded']['status'] = TRUE;

/**
 * Disable class loader (only use for dev/test).
 *
 * $settings['class_loader_auto_detect'] = FALSE;
 */

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
$settings['hash_salt'] = '';

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
 */
if (file_exists(__DIR__ . '/settings.local.php')) {
  include __DIR__ . '/settings.local.php';
}
