(function(){
  const storageKey = 'alvaro-color-scheme';
  const toggle = () => {
    const current = document.documentElement.dataset.colorScheme === 'dark' ? 'light' : 'dark';
    document.documentElement.dataset.colorScheme = current;
    try{localStorage.setItem(storageKey, current);}catch(e){}
  };
  document.addEventListener('click', (e)=>{
    const t = e.target.closest('[data-toggle-theme]');
    if(t){ e.preventDefault(); toggle(); }
  });

  // Tabs accesibles
  document.querySelectorAll('[role="tablist"]').forEach(tablist=>{
    const tabs = tablist.querySelectorAll('[role="tab"]');
    const panels = document.getElementById(tablist.getAttribute('aria-controls'))?.querySelectorAll('[role="tabpanel"]') || [];
    const activate = (i)=>{
      tabs.forEach((tab,idx)=>{
        const selected = idx===i; tab.setAttribute('aria-selected', selected);
        tab.setAttribute('tabindex', selected? '0':'-1');
        if(panels[idx]) panels[idx].hidden = !selected;
      });
    };
    tabs.forEach((tab,idx)=>{
      tab.addEventListener('click', ()=>activate(idx));
      tab.addEventListener('keydown', (ev)=>{
        if(['ArrowRight','ArrowLeft'].includes(ev.key)){
          ev.preventDefault(); const dir = ev.key==='ArrowRight'?1:-1; let ni=(idx+dir+tabs.length)%tabs.length; tabs[ni].focus(); activate(ni);
        }
      });
    });
    activate(0);
  });

  // FAQ acordeón
  document.querySelectorAll('.faq-button').forEach(btn=>{
    btn.addEventListener('click', ()=>{
      const panel = document.getElementById(btn.getAttribute('aria-controls'));
      const expanded = btn.getAttribute('aria-expanded') === 'true';
      btn.setAttribute('aria-expanded', String(!expanded));
      if(panel) panel.setAttribute('aria-hidden', String(expanded));
    })
  });

  // Copiar ROI
  document.addEventListener('click', (e)=>{
    const btn = e.target.closest('[data-copy-target]');
    if(!btn) return;
    const sel = btn.getAttribute('data-copy-target');
    const el = document.querySelector(sel);
    if(el){
      const text = el.innerText || el.value || '';
      navigator.clipboard?.writeText(text);
      btn.textContent = 'Copiado';
      setTimeout(()=>btn.textContent='Copiar',1500);
    }
  })
})();