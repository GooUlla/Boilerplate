jQuery(document).ready(function ($) {
  $('#masthead').find('#hamburger').click(function (e) { 
    e.preventDefault();
    $(this).toggleClass('open');
    $(this).parent().children('#main-menu').toggleClass('active');
  });
});