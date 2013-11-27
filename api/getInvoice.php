<!DOCTYPE html>
<HTML>
	<HEAD>	
		<title> Sistema de faturação online </title>
		<META http-equiv="Content-Type" content="text/html; charset=utf-8">
	</HEAD>

	<BODY>
		<?php
			$numFat = $_GET["InvoiceNo"];
				
			$db = new PDO('sqlite:../database/documents.db');
		 	$invoices = $db->query('SELECT * FROM Invoice');
		 	$invoices_lines = $db->query('SELECT * FROM Line');

		 	$data = $invoices->fetchAll();
		 	$data2 = $invoices_lines->fetchAll();
		  
		 	foreach ($data as $row) 
		  	{

				if($row['InvoiceNo']==$numFat) { 
		  			$array2 = array();
		  			
					foreach ($data2 as $row2)
				  	{
				  		if ($row['id'] == $row2['idInvoice'])
				  		{							
					    	$lineArr = array('Linha numero' => $row2['LineNumber'], 
					    		'Codigo do ProdutoServico' => $row2['ProductCode'], 
					    		'Numero de unidades vendidas' => $row2['Quantity'], 
					    		'Preco unitario' => $row2['UnitPrice'], 'Total' => $row2['CreditAmount'], 
					    		'Tipo de Taxa' => $row2['TaxType'], 
					    		'Percentagem da Taxa' => $row2['TaxPercentage']);

					    	array_push($array2,$lineArr);									    	
				  		}
				 
				  	}

				  	$array1 = array('InvoiceNo' => $row['InvoiceNo'], 'Data' => $row['InvoiceDate'], 'ID de Cliente'=> $row['CustomerID'],'Line: ' => $array2);
				
				    $array3= array( 'Total Documento' => array('Total de Imposto' => $row['TaxPayable'], 
				    				  'Total sem Imposto' => $row['NetTotal'],
				    				  'Total' => $row['GrossTotal']));

				    $merge = array_merge($array1,$array3);
				    $json_array = json_encode($merge);

				   echo $json_array;						   
				}
		  }

		   if(empty($json_array)) {
		  	echo json_encode(array('error'=> array('code' => 404,'reason'=>'Invoice not found')));
		  }

		?>	
	</BODY>		
</HTML>