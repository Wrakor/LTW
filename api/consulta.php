<!DOCTYPE html>

<head>
	<title> Sistema de faturação online </title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="../style.css">
	<style type="text/css">
    .text{display:none;
        padding-left: 15px;}
   
     p{
      display:none;
    } 

    .btab{padding-left: 15px;}
    .btab2{padding-left: 30px;}
    .btab3{padding-left: 45px;}
	</style>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
	</script>
	<script>
		$(document).ready(function(){
 	 		$("h3").click(function(e) {
     			/*$(".text").slideToggle();
      			$("h4").slideToggle();*/
      			$(this).next('div').toggle();

      			e.preventDefault();
      		});
		});
	</script>
</head>

<body>
<div id="conteudo">	
	<?php 
	include 'header.html';
	echo '<div id="documentos">';
	echo '<h2><b> Documentos existentes: </b></h2><br>';

	$db = new PDO('sqlite:documentos.db');
   	$invoices = $db->query('SELECT * FROM Invoice');
   	$invoices_lines = $db->query('SELECT * FROM Line');
   	$data = $invoices->fetchAll();
   	$data2 = $invoices_lines->fetchAll();

   	foreach ($data as $row) 
    {
    	echo '<h3>' . '- ' . $row['InvoiceNo'] . '</h3>'; 
    	
    	echo '<div class="text">' . '<br><b>Data: </b>' .$row['InvoiceDate'] . '<br>';  
    	echo ' <b>ID de Cliente: </b>'  . $row['CustomerID'] . '<br>';  
    	echo ' <b>Linhas de Produtos:</b><br>';

    	foreach ($data2 as $row2)
    	{
    		if ($row['id'] == $row2['idInvoice'])
    		{
    			echo ' <b class="btab">- Linha nº:</b>'  . $row2['LineNumber'] . '<br>';  
    	   	 	echo '<b class="btab2">Código do Produto/Serviço:</b>'  . $row2['ProductCode'] . '<br>';  
    	    	echo ' <b class="btab2">Nº de unidades vendidas:</b>'  . $row2['Quantity'] . '<br>';  
    	    	echo ' <b class="btab2">Preço unitário:</b>'  . $row2['UnitPrice'] . '<br>';  
    	    	echo ' <b class="btab2">Total:</b>'  . $row2['CreditAmount'] . '<br>'; 

    	    	echo ' <b class="btab2">Taxas:</b><br>';  
    	    	echo ' <b class="btab3">Tipo de Taxa:</b>'  . $row2['TaxType'] . '<br>';  
    	    	echo ' <b class="btab3">Percentagem da Taxa:</b>'  . $row2['TaxPercentage'] . '%<br>';  
    		}
    	}

    	echo ' <b>Total de Imposto: </b>'  . $row['TaxPayable'] . '<br>';  
     	echo '<b>Total sem Imposto: </b>'  . $row['NetTotal'] . '<br>';  
     	echo '<b>Total: </b>'  . $row['GrossTotal'] . '<br><br></div>'; 
     }
  	?>
	</div>
	</div>
</body>