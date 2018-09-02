$(document).ready(function () {
    $('#close').click(function () {
       $('.wrapper').removeClass('visible');
    });
   $('.registration').click(function () {
       $('.wrapper-registration').addClass('visible');
   });
});