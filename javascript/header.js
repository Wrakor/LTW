$(document).ready(function(){
      	$("#check").click(function(e) {
      if ($('#checkDocuments').css('visibility') == 'hidden')
      {
      	$('#checkDocuments').css('visibility', 'visible');
      }
      else 
      	$('#checkDocuments').css('visibility', 'hidden');
      e.preventDefault();
      });

      	$("#create").click(function(e) {
      if ($('#createDocuments').css('visibility') == 'hidden')
      {
      	$('#createDocuments').css('visibility', 'visible');
      }
      else 
      	$('#createDocuments').css('visibility', 'hidden');
      e.preventDefault();
      });
});