$(function () {

  $('main#spapp > section').css('min-height', $(window).height() - 120);


  var app = $.spapp({
    defaultView: 'home',            
    templateDir: 'Frontend/views/',  
    pageNotFound: 'home'             
  });



  app.run();


  function setActive() {
    var hash = (location.hash || '#home');
    $('.navbar-nav .nav-link').removeClass('active');
    $('.navbar-nav .nav-link[href="' + hash + '"]').addClass('active');
  }
  setActive();
  $(window).on('hashchange', setActive);
});

/*////spap<-////*/

   (function(){
  function getCat(){
    var h = location.hash || '';
    var i = h.indexOf('?');
    if (i === -1) return 'all';
    var params = new URLSearchParams(h.slice(i+1));
    return (params.get('cat') || 'all').toLowerCase();
  }
  function apply(cat){
    document.querySelectorAll('.filter-btn').forEach(btn=>{
      btn.classList.toggle('active', btn.dataset.cat === cat || (cat==='all' && btn.dataset.cat==='all'));
    });
    document.querySelectorAll('#productGrid .product').forEach(card=>{
      card.classList.toggle('d-none', !(cat==='all' || card.dataset.cat===cat));
    });
  }
  function init(){
    apply(getCat());
    document.querySelectorAll('.filter-btn').forEach(btn=>{
      btn.addEventListener('click', ()=> apply(btn.dataset.cat));
    });
  }
  init();
  window.addEventListener('hashchange', ()=> apply(getCat()));
})();








