<?php
	$db = new PDO('sqlite:..database/documents.db');

	$InvoiceArray = array();	
	$createArray = array();
	$arrayDecode = json_decode($_POST['invoice'], true);

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
				$createArray = array("InvoiceNo" => $arrayDecode['InvoiceNo'],
									 "InvoiceDate" => $arrayDecode['InvoiceDate'],
									 "CustomerID" => $arrayDecode['CustomerID'],
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
		$createArray = array("InvoiceNo" => $maxID,
		 					 "InvoiceDate" => $arrayDecode['InvoiceDate'],
							 "CustomerID" => $arrayDecode['CustomerID'],
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