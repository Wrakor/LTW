<!DOCTYPE html>
<HTML>
	<HEAD>	
		<title> Sistema de faturação online </title>
		<META http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="../style.css">
	</HEAD>

	<BODY>
	<div id="conteudo">
		<div>
			<?php
					include 'header.html';
  					echo '<div id="conteudo">';
					echo '<div id="documentos">';

					$numFat = $_GET["InvoiceNo"];
						
					$db = new PDO('sqlite:database/documents.db');
				 	$invoices = $db->query('SELECT * FROM Invoice');
				 	$invoices_lines = $db->query('SELECT * FROM Line');

				 	$data = $invoices->fetchAll();
				 	$data2 = $invoices_lines->fetchAll();

				  echo '<h2> Faturas: </h2>';
				 	foreach ($data as $row) 
				  {

						if($row['InvoiceNo']==$numFat) { 
						/*  	echo '<h3>' . '- ' . $row['InvoiceNo'] . '</h3>'; 	
						  	echo '<div class="btab">' . '<b>Data: </b>' .$row['InvoiceDate'] . '<br>';  
						  	echo '<b>ID de Cliente: </b>'  . $row['CustomerID'] . '<br></div>';*/
						  		$array1 = array('InvoiceNo' => $row['InvoiceNo'], 'Data' => $row['InvoiceDate'], 
						  		'ID de Cliente'=> $row['CustomerID']);
						  	//	echo json_encode(array('InvoiceNo' => $row['InvoiceNo'], 'Data' => $row['InvoiceDate'], 
						  	//	'ID de Cliente'=> $row['CustomerID']));

									foreach ($data2 as $row2)
								  	{
								  		if ($row['id'] == $row2['idInvoice'])
								  		{
								  		/*	echo '<b class="btab">- Linha nº:</b>'  . $row2['LineNumber'] . '<br>';  
									   	 	echo '<b class="btab2">Código do Produto/Serviço:</b>'  . $row2['ProductCode'] . '<br>';  
									    	echo '<b class="btab2">Nº de unidades vendidas:</b>'  . $row2['Quantity'] . '<br>';  
									    	echo '<b class="btab2">Preço unitário:</b>'  . $row2['UnitPrice'] . '<br>';  
									    	echo '<b class="btab2">Total:</b>'  . $row2['CreditAmount'] . '<br>'; 

									    	echo '<b class="btab2">Taxas:</b><br>';  
									    	echo '<b class="btab3">Tipo de Taxa:</b>'  . $row2['TaxType'] . '<br>';  
									    	echo '<b class="btab3">Percentagem da Taxa:</b>'  . $row2['TaxPercentage'] . '%<br>'; */

									   /* 	echo json_encode(array('Linha numero' => $row2['LineNumber'], 
									    		'Codigo do ProdutoServico' => $row2['ProductCode'], 
									    		'Numero de unidades vendidas' => $row2['Quantity'], 
									    		'Preco unitario' => $row2['UnitPrice'], 'Total' => $row2['CreditAmount'], 
									    		'Tipo de Taxa' => $row2['TaxType'], 'Percentagem da Taxa' => $row2['TaxPercentage']));*/
									    	$array2= array('Linha:'=> array('Linha numero' => $row2['LineNumber'], 
									    		'Codigo do ProdutoServico' => $row2['ProductCode'], 
									    		'Numero de unidades vendidas' => $row2['Quantity'], 
									    		'Preco unitario' => $row2['UnitPrice'], 'Total' => $row2['CreditAmount'], 
									    		'Tipo de Taxa' => $row2['TaxType'], 
									    		'Percentagem da Taxa' => $row2['TaxPercentage']));
								  		}
								  	}

						/*  	echo '<b>Total de Imposto: </b>'  . $row['TaxPayable'] . '<br>';  
						   	echo '<b>Total sem Imposto: </b>'  . $row['NetTotal'] . '<br>';  
						   	echo '<b>Total: </b>'  . $row['GrossTotal'] . '<br>';
						    echo '</div>'; 
						    echo '<h4 class="mostrar"> Ver mais </h4><br>';*/

						/*    echo json_encode(array('Total de Imposto' => $row['TaxPayable'], 
						    				  'Total sem Imposto' => $row['NetTotal'],
						    				  'Total' => $row['GrossTotal']));*/
						    $array3= array( 'Total Documento' => array('Total de Imposto' => $row['TaxPayable'], 
						    				  'Total sem Imposto' => $row['NetTotal'],
						    				  'Total' => $row['GrossTotal']));


						    $merge = array_merge($array1,$array2,$array3);
						    $json_array = json_encode($merge);
						    echo $json_array;
						
						   
						}

				  }

				   if(empty($json_array)) {
				  	echo json_encode(array('error'=> array('code' => 404,'reason'=>'Invoice not found')));
				  }

			?>	
		</div>
	<div>	
	</BODY>		
</HTML>