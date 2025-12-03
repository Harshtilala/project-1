/* Dashboard interactions: sidebar toggle, uploads, previews, progress */
(function(){
  const $ = (sel, ctx=document) => ctx.querySelector(sel);
  const $$ = (sel, ctx=document) => Array.from(ctx.querySelectorAll(sel));

  // Sidebar toggle (mobile)
  const sidebar = $('#sidebar');
  const sidebarToggle = $('#sidebarToggle');
  sidebarToggle?.addEventListener('click', () => {
    sidebar?.classList.toggle('open');
  });

  // Global ripple effect for buttons
  function createRipple(e){
    const button = e.currentTarget;
    const rect = button.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = e.clientX - rect.left - size/2;
    const y = e.clientY - rect.top - size/2;
    const span = document.createElement('span');
    span.className = 'ripple';
    span.style.width = span.style.height = `${size}px`;
    span.style.left = `${x}px`;
    span.style.top = `${y}px`;
    button.appendChild(span);
    span.addEventListener('animationend', ()=> span.remove());
  }
  
  function bindRipples(ctx=document){
    $$('.btn', ctx).forEach(btn => {
      btn.removeEventListener('click', createRipple);
      btn.addEventListener('click', createRipple);
    });
  }
  
  // Initial bind and observe DOM changes to bind on new buttons
  bindRipples();
  const mo = new MutationObserver(muts => {
    for(const m of muts){
      if(m.addedNodes?.length){
        m.addedNodes.forEach(n => { if(n.nodeType===1) bindRipples(n); });
      }
    }
  });
  mo.observe(document.body, { childList:true, subtree:true });

  // Select change handlers
  // themePresetSel?.addEventListener('change', (e)=> applyTheme(e.target.value));  
  // sidebarStyleSel?.addEventListener('change', (e)=> applySidebarStyle(e.target.value));
  // elevSel?.addEventListener('change', (e)=> applyElevation(e.target.value));

  // Sidebar dropdown accordion: only one open at a time on desktop
  const groups = $$('.menu-group');
  groups.forEach(g => {
    g.addEventListener('toggle', () => {
      if(g.open){
        groups.forEach(other => { if(other!==g) other.open = false; });
      }
    });
  });
})();