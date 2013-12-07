$(document).ready(function(){
    $(".mostrar").click(function(e) {
          $(this).prev('.hiddenText').slideToggle("slow");
          var text = $(this).text();

          if (text == " Ver mais ")
          {
            $(this).text(' Ver menos ');
          }
          else
          {
            $(this).text(' Ver mais ');
          }
          e.preventDefault();
        });
  });