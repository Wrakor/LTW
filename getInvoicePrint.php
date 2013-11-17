<!DOCTYPE html>
<HTML>
	<HEAD>	
		<title> Vista Impressão Fatura </title>
		<META http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<link rel="stylesheet" href="print.css">

		<style type="text/css">
		    .btab{padding-left: 15px;}
		    .btab2{padding-left: 30px;}
		    .btab3{padding-left: 45px;}
		</style>
	</HEAD>

	<BODY>
		
		<div class="page">
		<?php
			$numFat = $_GET["numFaturaPr"];
				
			$db = new PDO('sqlite:database/documents.db');
		 	$invoices = $db->query('SELECT * FROM Invoice');
		 	$invoices_lines = $db->query('SELECT * FROM Line');
		  
		 	$data = $invoices->fetchAll();
		 	$data2 = $invoices_lines->fetchAll();
			

			$exists=false;


			echo '<h2> Faturas: </h2>';
			foreach ($data as $row) 
			{

				if($row['InvoiceNo']==$numFat) {
					$exists=true;

				 	echo '<h3>' . '- ' . $row['InvoiceNo'] . '</h3>'; 	
				  	echo '<div class="btab">' . '<b>Data: </b>' .$row['InvoiceDate'] . '<br>';  
				  	echo '<b>ID de Cliente: </b>'  . $row['CustomerID'] . '<br></div>';
				  
							foreach ($data2 as $row2)
						  	{
						  		if ($row['id'] == $row2['idInvoice'])
						  		{
						  			echo '<b class="btab">- Linha nº:</b>'  . $row2['LineNumber'] . '<br>';
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
				   	echo '<b>Total: </b>'  . $row['GrossTotal'] . '<br>';				   
					}

			  }

			  if(!$exists){
			  	echo 'Fatura não existe';
			  }

			?>
			</div>
	</BODY>		
</HTML>