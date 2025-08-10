<?php
/**
 * Funciones del tema Alvaro IA Theme
 */

if (!defined('ABSPATH')) { exit; }

add_action('after_setup_theme', function () {
  add_theme_support('wp-block-styles');
  add_theme_support('editor-styles');
  add_theme_support('responsive-embeds');
  add_theme_support('custom-logo');
  add_theme_support('title-tag');
});

// Limpieza de wp_head
add_action('init', function () {
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'wp_shortlink_wp_head');
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_print_styles', 'print_emoji_styles');
});

// Enqueue assets
add_action('wp_enqueue_scripts', function () {
  $theme = wp_get_theme();
  wp_enqueue_style('alvaro-theme', get_stylesheet_uri(), [], $theme->get('Version'));
  wp_enqueue_style('alvaro-theme-extra', get_template_directory_uri() . '/assets/css/style.css', [], $theme->get('Version'));
  wp_enqueue_script('alvaro-theme', get_template_directory_uri() . '/assets/js/theme.js', [], $theme->get('Version'), true);
});

// Defer de scripts del tema
add_filter('script_loader_tag', function ($tag, $handle, $src) {
  $handles = ['alvaro-theme'];
  if (in_array($handle, $handles, true)) {
    $tag = '<script defer src="' . esc_url($src) . '"></script>';
  }
  return $tag;
}, 10, 3);

// Shortcode de breadcrumbs accesibles (usable en bloque Shortcode)
function alvaro_breadcrumbs_shortcode() {
  if (is_front_page()) { return ''; }
  $items = [];
  $items[] = [ 'url' => home_url('/'), 'label' => __('Inicio', 'alvaro-ia-theme') ];

  if (is_singular()) {
    $post = get_post();
    $parents = [];
    while ($post->post_parent) {
      $post = get_post($post->post_parent);
      $parents[] = [ 'url' => get_permalink($post), 'label' => get_the_title($post) ];
    }
    $parents = array_reverse($parents);
    $items = array_merge($items, $parents);
    $items[] = [ 'url' => get_permalink(), 'label' => get_the_title() ];
  } elseif (is_archive()) {
    if (is_post_type_archive()) {
      $items[] = [ 'url' => get_post_type_archive_link(get_query_var('post_type')), 'label' => post_type_archive_title('', false) ];
    } elseif (is_category()) {
      $cat = get_queried_object();
      $items[] = [ 'url' => get_category_link($cat), 'label' => single_cat_title('', false) ];
    } else {
      $items[] = [ 'url' => '', 'label' => get_the_archive_title() ];
    }
  } elseif (is_search()) {
    $items[] = [ 'url' => '', 'label' => sprintf(__('Búsqueda: %s', 'alvaro-ia-theme'), get_search_query()) ];
  } elseif (is_404()) {
    $items[] = [ 'url' => '', 'label' => __('No encontrado', 'alvaro-ia-theme') ];
  }

  $output = '<nav class="breadcrumbs" aria-label="Breadcrumb">';
  $output .= '<ol class="breadcrumbs__list">';
  foreach ($items as $index => $item) {
    $is_last = ($index === array_key_last($items));
    $output .= '<li class="breadcrumbs__item"' . ($is_last ? ' aria-current="page"' : '') . '>';
    if (!$is_last && !empty($item['url'])) {
      $output .= '<a href="' . esc_url($item['url']) . '">' . esc_html($item['label']) . '</a>';
    } else {
      $output .= '<span>' . esc_html($item['label']) . '</span>';
    }
    $output .= '</li>';
  }
  $output .= '</ol></nav>';
  return $output;
}
add_shortcode('alvaro_breadcrumbs', 'alvaro_breadcrumbs_shortcode');

// Utilidad: añadir decoding async y lazyload a imágenes del contenido
add_filter('render_block', function ($block_content, $block) {
  if ($block['blockName'] === 'core/image') {
    $block_content = preg_replace('/<img(.*?)>/', '<img loading="lazy" decoding="async"$1>', $block_content);
  }
  return $block_content;
}, 10, 2);

// Soporte modo oscuro/claro via class en <html>
add_action('wp_head', function () {
  echo '<script>try{const k="alvaro-color-scheme";const s=localStorage.getItem(k);if(s){document.documentElement.dataset.colorScheme=s}}catch(e){}</script>';
});

?>