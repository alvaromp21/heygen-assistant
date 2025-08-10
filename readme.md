# Instalación rápida

1) Sube y activa el tema `alvaro-ia-theme.zip` y el plugin `alvaro-site-core.zip` desde Apariencia > Temas y Plugins > Añadir nuevo.
2) Ve a Herramientas > Importar > WordPress e importa `wp-export.xml` (autor: asigna a tu usuario; adjuntos: opcional).
3) Ajusta Enlaces permanentes a `Nombre de la entrada`.
4) En Ajustes > Lectura, define la página de inicio como "Home" si no queda asignada automáticamente.

Checklist de pendientes para producción
- Reemplazar imágenes y logos por definitivos (formato WebP/AVIF, alt descriptivo).
- Completar copys largos en cada servicio (900–1500 palabras) y agregar 5–7 FAQs.
- Sustituir videos de testimonios por reales y enlazar casos.
- Revisar títulos y descripciones SEO por plantilla.
- Probar Lighthouse (móvil) buscando ≥90 en Performance/SEO/Accesibilidad/BP.

Soporte y notas
- Paleta editable desde `theme.json` usando variables `--brand-*`.
- Breadcrumbs: usa el bloque Shortcode con `[alvaro_breadcrumbs]` si quieres moverlos.
- Shortcodes disponibles: `[roi_calculator]`, `[faq]`, `[case_highlights]`, `[sticky_cta]`.