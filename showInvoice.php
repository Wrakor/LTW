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
	include 'header.php';
 	echo '<div id="conteudo">';
 	echo '<div class="texto">';
 	
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
   
	  	echo '<div class="btab">' . '<table border="1"><tr><td><b>Número: </b></td><td>' .$row['InvoiceNo'] . '</td></tr>';  
	  	
	  	echo '<tr><td>' . '<b>Data: </b></td> <td>' .$row['InvoiceDate'] . '</td></tr><br>';  
  		echo '<tr><td><b>ID de Cliente: </b></td><td>'  . $row['CustomerID'] . '</td></tr><br></div>'; 
	    echo '<div style="padding-left: 15px;">';
    	echo '<tr><td colspan="2"><b>Linhas de Produtos:</b><br></td></tr>';   
	  
	  	foreach ($lines as $row2)
	  	{
	  		if ($row['id'] == $row2['idInvoice'])
	  		{
	  			echo '<tr><td colspan="7"><b class="btab">- Linha nº </b>'  . $row2['LineNumber'] . '</td></tr>';  
		   	 	echo '<tr><td><b class="btab2">Código do Produto/Serviço:</b></td><td>'  . $row2['ProductCode'] . '</td></tr>';  
		    	echo '<tr><td><b class="btab2">Nº de unidades vendidas:</b></td><td>'  . $row2['Quantity'] . '</tr></td>';  
		    	echo '<tr><td><b class="btab2">Preço unitário:</b></td><td>'  . $row2['UnitPrice'] . '</tr></td>';  
		    	echo '<tr><td><b class="btab2">Total:</b></td><td>'  . $row2['CreditAmount'] . '</tr></td>'; 

		    	echo '<tr><td colspan="2"><b class="btab2">Taxas:</b></tr>';  
		    	echo '<tr><td><b class="btab3">Tipo de Taxa:</b></td><td>'  . $row2['TaxType'] . '</tr></td>';  
		    	echo '<tr><td><b class="btab3">Percentagem da Taxa:</b></td><td>'  . $row2['TaxPercentage'] . '%</tr></td>';  
	  		}
	  	}

echo '<tr><td><b>Total de Imposto: </b></td><td>'  . $row['TaxPayable'] . '<br></tr></td>';  
   	echo '<tr><td><b>Total sem Imposto: </b></td><td>'  . $row['NetTotal'] . '<br></tr></td>';  
   	echo '<tr><td><b>Total: </b></td><td>'  . $row['GrossTotal'] . '<br></tr></td></table>';  
   
	   	echo '<button> Imprimir</button>';
   }
     ?>
	</div>
	</div>
</body>