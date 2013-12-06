$(document).ready(function(){
 	 		$("#consultar").click(function(e) {
      			if ($('#documents').css('visibility') == 'hidden')
      			{
      				$('#documents').css('visibility', 'visible');
      			}
      			else 
      				$('#documents').css('visibility', 'hidden');
      			e.preventDefault();
      			});
		});