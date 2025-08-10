<?php
add_action('init', function(){
  register_post_type('case', [
    'label' => __('Casos','alvaro-site-core'),
    'public' => true,
    'show_in_rest' => true,
    'has_archive' => true,
    'rewrite' => ['slug'=>'casos'],
    'menu_icon' => 'dashicons-analytics',
    'supports' => ['title','editor','thumbnail','excerpt','revisions'],
  ]);
});