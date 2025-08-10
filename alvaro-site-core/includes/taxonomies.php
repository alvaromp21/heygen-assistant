<?php
add_action('init', function(){
  register_taxonomy('sector', ['service','case'], [
    'label' => __('Sector','alvaro-site-core'), 'public'=>true, 'show_in_rest'=>true, 'rewrite'=>['slug'=>'sector']
  ]);
  register_taxonomy('tipo-servicio', ['service'], [
    'label' => __('Tipo de servicio','alvaro-site-core'), 'public'=>true, 'show_in_rest'=>true, 'rewrite'=>['slug'=>'tipo-servicio']
  ]);
});