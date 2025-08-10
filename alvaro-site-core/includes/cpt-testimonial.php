<?php
add_action('init', function(){
  register_post_type('testimonial', [
    'label' => __('Testimonios','alvaro-site-core'),
    'public' => true,
    'show_in_rest' => true,
    'has_archive' => false,
    'rewrite' => ['slug'=>'testimonios'],
    'menu_icon' => 'dashicons-format-quote',
    'supports' => ['title','editor','thumbnail','excerpt','revisions'],
  ]);
});