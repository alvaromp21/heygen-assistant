<?php
add_action('init', function(){
  register_post_type('event', [
    'label' => __('Agenda','alvaro-site-core'),
    'public' => true,
    'show_in_rest' => true,
    'has_archive' => true,
    'rewrite' => ['slug'=>'agenda'],
    'menu_icon' => 'dashicons-calendar-alt',
    'supports' => ['title','editor','thumbnail','excerpt','revisions'],
  ]);
});