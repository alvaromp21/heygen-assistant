<?php
// [roi_calculator]
add_shortcode('roi_calculator', function(){
  ob_start(); ?>
  <div class="wp-block-group">
    <h3>Calcula tu ROI</h3>
    <p>Monto mensual actual</p><input id="s-roi-ing" type="number" value="10000" />
    <p>Margen (%)</p><input id="s-roi-mar" type="number" value="30" />
    <p>Mejora (%)</p><input id="s-roi-mej" type="number" value="15" />
    <p id="s-roi-res">ROI anual estimado: $0</p>
    <button class="wp-element-button" onclick="(function(){var i=+document.getElementById('s-roi-ing').value||0;var m=(+document.getElementById('s-roi-mar').value||0)/100;var e=(+document.getElementById('s-roi-mej').value||0)/100;var gan=i*m*e*12;document.getElementById('s-roi-res').innerText='ROI anual estimado: $'+gan.toLocaleString();})()">Calcular</button>
  </div>
  <?php return ob_get_clean();
});

// [faq] lee meta 'faqs' con formato Q::A por líneas
add_shortcode('faq', function($atts){
  $raw = get_post_meta(get_the_ID(), 'faqs', true);
  if (!$raw) return '';
  $lines = array_filter(array_map('trim', preg_split('/\r?\n/', $raw)));
  $out = '<div class="faq-list">'; $i=0;
  foreach($lines as $line){ $i++; [$q,$a] = array_pad(explode('::',$line,2),2,'');
    $q=esc_html($q); $a=esc_html($a);
    $out .= '<div class="faq-item"><button class="faq-button" aria-expanded="false" aria-controls="faqsc'.$i.'">'.$q.'</button><div id="faqsc'.$i.'" class="faq-panel" aria-hidden="true"><p>'.$a.'</p></div></div>';
  }
  return $out.'</div>';
});

// [case_highlights] muestra KPI antes/después
add_shortcode('case_highlights', function(){
  $antes = get_post_meta(get_the_ID(), 'kpi_antes', true);
  $despues = get_post_meta(get_the_ID(), 'kpi_despues', true);
  if(!$antes && !$despues) return '';
  return '<ul><li><strong>Antes:</strong> '.esc_html($antes).'</li><li><strong>Después:</strong> '.esc_html($despues).'</li></ul>';
});

// [sticky_cta]
add_shortcode('sticky_cta', function($atts){
  $a = shortcode_atts(['text'=>'Agendar diagnóstico','url'=>'/contacto'], $atts);
  return '<div class="sticky-cta"><div class="wp-block-buttons"><div class="wp-block-button btn-gradient"><a class="wp-block-button__link wp-element-button" href="'.esc_url($a['url']).'">'.esc_html($a['text']).'</a></div></div></div>';
});