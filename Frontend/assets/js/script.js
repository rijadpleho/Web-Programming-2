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