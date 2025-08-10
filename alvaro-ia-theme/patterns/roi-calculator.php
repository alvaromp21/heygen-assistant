<?php
/**
 * Title: Calculadora ROI
 * Slug: alvaro-ia-theme/roi-calculator
 * Categories: featured
 */
?>
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":2,"textAlign":"center"} -->
<h2 class="has-text-align-center">Calcula tu ROI con agentes de IA</h2>
<!-- /wp:heading -->
<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph --><p>Ingresos actuales mensuales</p><!-- /wp:paragraph --><!-- wp:html -->
<input type="number" id="roi-ingresos" min="0" step="100" value="10000" />
<!-- /wp:html --></div>
<!-- /wp:column --><!— wp:column —>
<div class="wp-block-column"><!-- wp:paragraph --><p>Margen (%)</p><!-- /wp:paragraph --><!-- wp:html -->
<input type="number" id="roi-margen" min="0" max="100" step="1" value="30" />
<!-- /wp:html --></div>
<!-- /wp:column --><!— wp:column —>
<div class="wp-block-column"><!-- wp:paragraph --><p>Mejora esperada (%)</p><!-- /wp:paragraph --><!-- wp:html -->
<input type="number" id="roi-mejora" min="0" max="300" step="1" value="15" />
<!-- /wp:html --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"btn-gradient"} -->
<div class="wp-block-button btn-gradient"><a class="wp-block-button__link wp-element-button" href="#" onclick="(function(){var i=+document.getElementById('roi-ingresos').value||0;var m=(+document.getElementById('roi-margen').value||0)/100;var e=(+document.getElementById('roi-mejora').value||0)/100;var gan=i*m*e*12;document.getElementById('roi-resultado').innerText='ROI anual estimado: $'+gan.toLocaleString();})()">Calcular</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<!-- wp:paragraph {"align":"center"} -->
<p id="roi-resultado" class="has-text-align-center">ROI anual estimado: $0</p>
<!-- /wp:paragraph -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a data-copy-target="#roi-resultado" class="wp-block-button__link wp-element-button" href="#">Copiar</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->