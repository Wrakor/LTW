<!DOCTYPE html>

<head>
	<title> Sistema de faturação online </title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style.css">
	<style type="text/css">
		@media print {
		    div#header {display: none;}
			div#menu {display: none;}
			button {display:none;}
	}
	</style>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
 	 		$("button").click(function(e) {
 	 			window.print();
 	 		});
 	 	});
	</script>
</head>

<body>
	<?php 
	include 'header.html';
 	echo '<div id="conteudo">';
 	echo '<div class="documentos" style="border-right: none;">';
 	
	$db = new PDO('sqlite:database/documents.db');
 	$stmt = $db->prepare('SELECT * FROM Invoice WHERE InvoiceNo = ?');
   	$stmt->execute(array($_GET['InvoiceNo']));
   	$row = $stmt->fetch();

   	if (!$row)
   		echo 'Não foram encontradas faturas com ID ' . $_GET['InvoiceNo'] . '!';
   	else
   	{
   		$invoices_lines = $db->query('SELECT * FROM Line');
   		$lines = $invoices_lines->fetchAll();
   
	  	echo '<div class="btab">' . '<b>Número: </b>' .$row['InvoiceNo'] . '<br></div>';  
	  	
	  	echo '<div class="btab">' . '<b>Data: </b>' .$row['InvoiceDate'] . '<br>';  
	  	echo '<b>ID de Cliente: </b>'  . $row['CustomerID'] . '<br></div>';  
	    echo '<div style="padding-left: 15px;">';
	    echo '<b>Linhas de Produtos:</b><br>';   
	  
	  	foreach ($lines as $row2)
	  	{
	  		if ($row['id'] == $row2['idInvoice'])
	  		{
	  			echo '<b class="btab">- Linha nº </b>'  . $row2['LineNumber'] . '<br>';  
		   	 	echo '<b class="btab2">Código do Produto/Serviço:</b>'  . $row2['ProductCode'] . '<br>';  
		    	echo '<b class="btab2">Nº de unidades vendidas:</b>'  . $row2['Quantity'] . '<br>';  
		    	echo '<b class="btab2">Preço unitário:</b>'  . $row2['UnitPrice'] . '<br>';  
		    	echo '<b class="btab2">Total:</b>'  . $row2['CreditAmount'] . '<br>'; 

		    	echo '<b class="btab2">Taxas:</b><br>';  
		    	echo '<b class="btab3">Tipo de Taxa:</b>'  . $row2['TaxType'] . '<br>';  
		    	echo '<b class="btab3">Percentagem da Taxa:</b>'  . $row2['TaxPercentage'] . '%<br>';  
	  		}
	  	}

	  	echo '<b>Total de Imposto: </b>'  . $row['TaxPayable'] . '<br>';  
	   	echo '<b>Total sem Imposto: </b>'  . $row['NetTotal'] . '<br>';  
	   	echo '<b>Total: </b>'  . $row['GrossTotal'] . '<br><br>';  
   
	   	echo '<button> Imprimir</button>';
   }
     ?>
	</div>
	</div>
</body>