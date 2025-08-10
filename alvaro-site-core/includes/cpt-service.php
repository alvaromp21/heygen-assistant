<?php
add_action('init', function(){
  register_post_type('service', [
    'label' => __('Servicios','alvaro-site-core'),
    'public' => true,
    'show_in_rest' => true,
    'has_archive' => true,
    'rewrite' => ['slug'=>'servicios'],
    'menu_icon' => 'dashicons-robot',
    'supports' => ['title','editor','thumbnail','excerpt','revisions'],
  ]);
});