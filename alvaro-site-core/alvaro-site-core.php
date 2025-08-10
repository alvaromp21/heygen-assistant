<?php
/**
 * Plugin Name: Alvaro Site Core
 * Description: Core del sitio: CPTs, taxonomías, meta, shortcodes y SEO técnico/JSON-LD.
 * Version: 1.0.0
 * Author: Álvaro Maureira
 * License: GPL2+
 * Text Domain: alvaro-site-core
 */

if (!defined('ABSPATH')) { exit; }

define('ALVARO_CORE_PATH', plugin_dir_path(__FILE__));

autoloadAlvaroCore();

function autoloadAlvaroCore(){
  foreach ([
    'includes/cpt-service.php',
    'includes/cpt-case.php',
    'includes/cpt-event.php',
    'includes/cpt-testimonial.php',
    'includes/taxonomies.php',
    'includes/meta.php',
    'includes/shortcodes.php',
    'includes/seo.php',
    'includes/json-ld.php'
  ] as $file){
    $path = ALVARO_CORE_PATH . $file;
    if (file_exists($path)) require_once $path;
  }
}

add_action('init', function(){ do_action('alvaro_core_init_loaded'); });