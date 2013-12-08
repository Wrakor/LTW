<?php
	$db = new PDO('sqlite:..database/documents.db');

	$ProductArray = array();	
	$createArray = array();	
	$arrayDecode = json_decode($_POST['product'], true);
	
	if(!empty($arrayDecode['ProductCode']))
	{
		$result1 = $db->query('SELECT * FROM Product');
		$data1 = $result1->fetchAll();
		
		foreach($data1 as $row)
		{			
			if ($arrayDecode['ProductCode'] == $row['ProductCode'])
			{
				$update = $db->prepare('UPDATE Product SET ProductDescription = ?, UnitPrice = ?, UnitOfMeasure = ? WHERE ProductCode = ?');
				$update->execute(array($arrayDecode['ProductDescription'],
									   $arrayDecode['UnitPrice'],
									   $arrayDecode['UnitOfMeasure'],
									   $arrayDecode['ProductCode']));
				$createArray = array("ProductCode" => $arrayDecode['ProductCode'],
									 "ProductDescription" => $arrayDecode['ProductDescription'],
									 "UnitPrice" => $arrayDecode['UnitPrice'],
								     "UnitOfMeasure" => $arrayDecode['UnitOfMeasure']);	
				$ProductArray = json_encode($createArray);						   
				$check = 1;
				break;		
			}
			else $check = 0;
		}
	}
	else 
	{				
		$getMaxID = $db->prepare('SELECT ProductCode, MAX(id) FROM Product');
		$getMaxID->execute();
		$maxID = $getMaxID->fetch(0);
		$maxID[0]++;				
		$update = $db->prepare('INSERT INTO Product (ProductCode, ProductDescription, UnitPrice, UnitOfMeasure) Values(?,?,?,?)');		
		$update->execute(array($maxID[0], 
									   $arrayDecode['ProductDescription'],
									   $arrayDecode['UnitPrice'],
									   $arrayDecode['UnitOfMeasure']));
		$createArray = array("ProductCode" => $maxID[0],
							 "ProductDescription" => $arrayDecode['ProductDescription'],
							 "UnitPrice" => $arrayDecode['UnitPrice'],
							 "UnitOfMeasure" => $arrayDecode['UnitOfMeasure']);		
		$ProductArray = json_encode($createArray);	
	}
		
	if(empty($ProductArray)) 
	{
		echo "{“error”:{“code”:404,”reason”:”Invoice not found”}}";
	}
	else
	{
		echo $ProductArray;
	}	
?>