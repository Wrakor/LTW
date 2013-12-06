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
						    	$lineArr = array('LineNumber' => $row2['LineNumber'], 
						    		'ProductCode' => $row2['ProductCode'], 
						    		'Quantity' => $row2['Quantity'], 
						    		'UnitPrice' => $row2['UnitPrice'], 'CreditAmount' => $row2['CreditAmount'], 
						    		'Tax' => array('TaxType' => $row2['TaxType'], 
						    		'TaxPercentage' => $row2['TaxPercentage']));
						    		

						    	array_push($array2,$lineArr);									    	
					  		}
					 
					  	}

					  	$array1 = array('InvoiceNo' => $row['InvoiceNo'], 'InvoiceDate' => $row['InvoiceDate'], 'CustomerID'=> $row['CustomerID'],'Line' => $array2);
					
					    $array3= array( 'DocumentTotals' => array('TaxPayable' => $row['TaxPayable'], 
					    				  'NetTotal' => $row['NetTotal'],
					    				  'GrossTotal' => $row['GrossTotal']));

					    $merge = array_merge($array1,$array3);
					    $json_array = json_encode($merge);
					   header('Content-type: application/json; charset=utf-8');
					   echo $json_array;						   
					}
			  }

			   if(empty($json_array)) {
			   	header('Content-type: application/json; charset=utf-8');
			  	echo json_encode(array('error'=> array('code' => 404,'reason'=>'Invoice not found')));
			  }
		
		?>	
