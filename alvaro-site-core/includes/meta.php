<?php
function alvaro_register_meta($post_type, $keys){
  foreach($keys as $key => $args){
    register_post_meta($post_type, $key, array_merge([
      'type' => 'string', 'single'=> true, 'show_in_rest'=> true, 'auth_callback' => '__return_true'
    ], $args));
  }
}

add_action('init', function(){
  alvaro_register_meta('service', [
    'beneficios' => ['type'=>'string'],
    'entregables' => ['type'=>'string'],
    'kpi_foco' => ['type'=>'string'],
    'precio_desde' => ['type'=>'string'],
    'duracion' => ['type'=>'string'],
    'faqs' => ['type'=>'string'],
  ]);

  alvaro_register_meta('case', [
    'sector_texto' => ['type'=>'string'],
    'problema' => ['type'=>'string'],
    'solucion' => ['type'=>'string'],
    'stack' => ['type'=>'string'],
    'kpi_antes' => ['type'=>'string'],
    'kpi_despues' => ['type'=>'string'],
    'testimonial_id' => ['type'=>'integer'],
  ]);

  alvaro_register_meta('event', [
    'fecha_hora' => ['type'=>'string'],
    'modalidad' => ['type'=>'string'],
    'registro_url' => ['type'=>'string'],
  ]);

  alvaro_register_meta('testimonial', [
    'rol' => ['type'=>'string'],
    'empresa' => ['type'=>'string'],
    'video_url' => ['type'=>'string'],
  ]);
});