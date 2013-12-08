<?php
	$db = new PDO('sqlite:database/documents.db');

	$InvoiceArray = array();	
	$createArray = array();
	$createArray = array("InvoiceNo" => '',
							   "InvoiceDate" => '2013-12-22',
							   "CustomerID" => 3,
							   "Line" => array(array("LineNumber" => 2,
											   "ProductCode" => 125, 
											   "Quantity" => 12,
											   "UnitPrice" => 4,
											   "CreditAmount" => 100,
											   "Tax" => array("TaxType" => 'Iva',
															  "TaxPercentage" => 23.00))),							   
						       "TaxPayable" => 37,							   
							   "NetTotal" => 123,
							   "GrossTotal" => 160);
							   
	$InvoiceArray = json_encode($createArray);	
	$arrayDecode = json_decode($InvoiceArray, true);
	//$arrayDecode = json_decode($_POST['invoice'], true);

	if(!empty($arrayDecode['InvoiceNo']))
	{
		$result1 = $db->query('SELECT * FROM Invoice');
		$result2 = $db->query('SELECT * FROM Line');
		$data1 = $result1->fetchAll();
		$data2 = $result2->fetchAll();
		
		foreach($data1 as $row)
		{			
			if ($arrayDecode['InvoiceNo'] == $row['InvoiceNo'])
			{
				$update = $db->prepare('UPDATE Invoice SET InvoiceDate = ?, CustomerID = ?, TaxPayable = ?, NetTotal = ?, GrossTotal = ? WHERE InvoiceNo = ?');
				$update->execute(array($arrayDecode['InvoiceDate'],
									   $arrayDecode['CustomerID'],
									   $arrayDecode['TaxPayable'],
									   $arrayDecode['NetTotal'],
									   $arrayDecode['TaxPayable'] + $arrayDecode['NetTotal'], 
									   $arrayDecode['InvoiceNo']));
				foreach($arrayDecode['Line'] as $rowLine)
				{									
					$update = $db->prepare('UPDATE Line SET LineNumber = ?, ProductCode = ?, Quantity = ?, UnitPrice = ?, CreditAmount = ?, TaxType = ?, TaxPercentage = ? WHERE idInvoice = ?');
					$update->execute(array($rowLine['LineNumber'],
									   $rowLine['ProductCode'],
									   $rowLine['Quantity'],
									   $rowLine['UnitPrice'],
									   $rowLine['CreditAmount'],
									   $rowLine['Tax']['TaxType'],
									   $rowLine['Tax']['TaxPercentage'], 
									   $arrayDecode['InvoiceNo']));
				}
				$createArray = array("InvoiceNo" => $arrayDecode['InvoiceNo'],
									 "InvoiceDate" => $arrayDecode['InvoiceDate'],
									 "CustomerID" => $arrayDecode['CustomerID'],
									 "Line" => $arrayDecode['Line'],
									 "TaxPayable" => $arrayDecode['TaxPayable'],
									 "NetTotal" => $arrayDecode['NetTotal'],							   
				 				     "GrossTotal" => $arrayDecode['TaxPayable'] + $arrayDecode['NetTotal']);	
				$InvoiceArray = json_encode($createArray);					
				$check = 1;
				break;		
			}
			else $check = 0;
		}
	}
	else 
	{				
		$getMaxID = $db->prepare('SELECT InvoiceNo, MAX(id) FROM Invoice');
		$getMaxID->execute();
		$maxID = $getMaxID->fetch(0);		
		$int = (int) preg_replace('/[^0-9]/', '', $maxID[0]);
		$maxID = "FT SEQ/" . ($int + 1);
		
		$update = $db->prepare('INSERT INTO Invoice (InvoiceNo, InvoiceDate, CustomerID, TaxPayable, NetTotal, GrossTotal) Values(?,?,?,?,?,?)');
		$update->execute(array($maxID, 
							   $arrayDecode['InvoiceDate'],
							   $arrayDecode['CustomerID'],
							   $arrayDecode['TaxPayable'],
							   $arrayDecode['NetTotal'],
							   $arrayDecode['TaxPayable'] + $arrayDecode['NetTotal']));
	    foreach($arrayDecode['Line'] as $rowLine)
		{			
			$update = $db->prepare('INSERT INTO Line (idInvoice,LineNumber, ProductCode, Quantity, UnitPrice, CreditAmount, TaxType, TaxPercentage) Values(?,?,?,?,?,?,?,?)');			
			$update->execute(array($maxID,
							   $rowLine['LineNumber'],
							   $rowLine['ProductCode'],
							   $rowLine['Quantity'],
							   $rowLine['UnitPrice'],
							   $rowLine['CreditAmount'],
							   $rowLine['Tax']['TaxType'],
							   $rowLine['Tax']['TaxPercentage']));
		}
		$createArray = array("InvoiceNo" => $maxID,
		 					 "InvoiceDate" => $arrayDecode['InvoiceDate'],
							 "CustomerID" => $arrayDecode['CustomerID'],
							 "Line" => $arrayDecode['Line'],
							 "TaxPayable" => $arrayDecode['TaxPayable'],
							 "NetTotal" => $arrayDecode['NetTotal'],							   
				 			 "GrossTotal" => $arrayDecode['TaxPayable'] + $arrayDecode['NetTotal']);
		$InvoiceArray = json_encode($createArray);									 
	}
		
	if(empty($InvoiceArray)) 
	{
		echo "{“error”:{“code”:404,”reason”:”Invoice not found”}}";
	}
	else
	{
		echo $InvoiceArray;
	}	
?>