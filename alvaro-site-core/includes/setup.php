<?php
if (!defined('ABSPATH')) { exit; }

register_activation_hook(dirname(__FILE__,2).'/alvaro-site-core.php', function(){
  // Intentar asignar Home/Blog si existen
  $home = get_page_by_path('home') ?: get_page_by_title('Home');
  $blog = get_page_by_path('blog') ?: get_page_by_title('Blog');
  if ($home) {
    update_option('show_on_front', 'page');
    update_option('page_on_front', $home->ID);
  }
  if ($blog) {
    update_option('page_for_posts', $blog->ID);
  }
  flush_rewrite_rules();
});

// Redirections suaves: /casos y /agenda -> archivos de CPT
add_action('template_redirect', function(){
  if (is_page('casos')){
    wp_redirect(get_post_type_archive_link('case'), 301); exit;
  }
  if (is_page('agenda')){
    wp_redirect(get_post_type_archive_link('event'), 301); exit;
  }
});

// Asegurar reglas de CPT en init
add_action('init', function(){
  global $wp_rewrite; $wp_rewrite->flush_rules(false);
});