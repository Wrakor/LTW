<!DOCTYPE html>

<html>
	<head>	
		<title> Sistema de faturação online </title>
		<META http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="../style.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
		</script>
		<script>		
		$(document).ready(function() {
		
			$.getJSON("api/getInvoice.php?InvoiceNo=20355",function(result){
			    $.each(result, function(i, field){
			      $("div").append(field.InvoiceNo + " ");
			    });
		  	});				
		});		
	});
	</script>
	</head>

	<body>
	<?php 
	echo '<div ></div>';

	?>
	</body>
</html>