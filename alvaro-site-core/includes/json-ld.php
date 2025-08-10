<?php
function alvaro_jsonld_output($data){ echo '<script type="application/ld+json">'.wp_json_encode($data).'</script>'; }

add_action('wp_head', function(){
  // Organization
  $org = [
    '@context'=>'https://schema.org', '@type'=>'Organization',
    'name'=> get_bloginfo('name'), 'url'=> home_url('/'),
    'logo'=> get_site_icon_url() ?: (get_theme_file_uri('assets/svg/logo.svg'))
  ];
  alvaro_jsonld_output($org);

  // Breadcrumbs
  if (!is_front_page()){
    $items = [[ '@type'=>'ListItem','position'=>1,'name'=>'Inicio','item'=>home_url('/') ]];
    $pos = 2; $trail = [];
    if (is_singular()){
      $trail[] = ['name'=> get_the_title(), 'item'=> get_permalink()];
    } elseif (is_archive()){
      $trail[] = ['name'=> wp_strip_all_tags(get_the_archive_title()), 'item'=> (is_post_type_archive()? get_post_type_archive_link(get_query_var('post_type')): get_permalink()) ];
    } elseif (is_search()){
      $trail[] = ['name'=> 'Búsqueda', 'item'=> home_url(add_query_arg([])) ];
    }
    foreach($trail as $t){ $items[] = ['@type'=>'ListItem','position'=>$pos++,'name'=>$t['name'],'item'=>$t['item']]; }
    alvaro_jsonld_output(['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>$items]);
  }

  if (is_singular('service')){
    $price = get_post_meta(get_the_ID(),'precio_desde', true);
    $data = [
      '@context'=>'https://schema.org','@type'=>'Service',
      'name'=> get_the_title(),
      'description'=> wp_strip_all_tags(get_the_excerpt()),
      'areaServed'=> 'Global',
      'provider'=> ['@type'=>'Organization','name'=> get_bloginfo('name')],
    ];
    if ($price){ $data['offers'] = ['@type'=>'Offer','priceCurrency'=>'USD','price'=>$price]; }
    alvaro_jsonld_output($data);
  }

  if (is_single() && get_post_type()==='post'){
    alvaro_jsonld_output([
      '@context'=>'https://schema.org','@type'=>'Article',
      'headline'=> get_the_title(),
      'author'=> ['@type'=>'Person','name'=>'Álvaro Maureira'],
      'datePublished'=> get_the_date('c'),
      'dateModified'=> get_the_modified_date('c'),
      'mainEntityOfPage'=> get_permalink()
    ]);
  }

  if (is_singular('event')){
    $dt = get_post_meta(get_the_ID(),'fecha_hora', true);
    $mode = get_post_meta(get_the_ID(),'modalidad', true) ?: 'Online';
    alvaro_jsonld_output([
      '@context'=>'https://schema.org','@type'=>'Event',
      'name'=> get_the_title(), 'startDate'=> $dt ?: get_the_date('c'),
      'eventAttendanceMode'=> 'https://schema.org/'.($mode==='Online'?'OnlineEventAttendanceMode':'OfflineEventAttendanceMode'),
      'eventStatus'=> 'https://schema.org/EventScheduled',
      'location'=> ['@type'=>'VirtualLocation','url'=> get_permalink()],
      'organizer'=> ['@type'=>'Organization','name'=> get_bloginfo('name')]
    ]);
  }

  // FAQ si existe meta 'faqs'
  if (is_singular()){
    $raw = get_post_meta(get_the_ID(),'faqs', true);
    if ($raw){
      $lines = array_filter(array_map('trim', preg_split('/\r?\n/', $raw)));
      $faqs = [];
      foreach($lines as $line){ [$q,$a] = array_pad(explode('::',$line,2),2,''); $faqs[]=['@type'=>'Question','name'=>$q,'acceptedAnswer'=>['@type'=>'Answer','text'=>$a]]; }
      alvaro_jsonld_output(['@context'=>'https://schema.org','@type'=>'FAQPage','mainEntity'=>$faqs]);
    }
  }
});