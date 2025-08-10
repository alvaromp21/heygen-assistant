<?php
// Title: Servicio + Resultado + IA – Álvaro Maureira (aprox)
add_filter('document_title_parts', function($parts){
  if (is_singular('service')) {
    $title = get_the_title();
    $kpi = get_post_meta(get_the_ID(), 'kpi_foco', true);
    $parts['title'] = trim($title.' – '.$kpi.' – IA');
    $parts['site'] = 'Álvaro Maureira';
  }
  return $parts;
});

// Meta description automatizada
add_action('wp_head', function(){
  if (is_singular()){
    $desc = get_the_excerpt();
  } elseif (is_home() || is_front_page()){
    $desc = 'IA que vende, automatiza y escala tu negocio.';
  } else {
    $desc = get_bloginfo('description');
  }
  if ($desc){ echo '<meta name="description" content="'.esc_attr(wp_trim_words(wp_strip_all_tags($desc), 30, '...')).'">'; }
}, 1);

// Enlaces rel next/prev en archivos paginados
add_action('wp_head', function(){
  global $paged, $wp_query; $paged = max(1, get_query_var('paged'));
  if (is_archive() || is_home() || is_search()){
    if ($paged > 1){ echo '<link rel="prev" href="'.esc_url(get_pagenum_link($paged-1)).'">'; }
    if ($paged < $wp_query->max_num_pages){ echo '<link rel="next" href="'.esc_url(get_pagenum_link($paged+1)).'">'; }
  }
}, 2);