<?php
	$db = new PDO('sqlite..database/documents.db');

	$CustomerArray = array();	
	$createArray = array();
	$arrayDecode = json_decode($_POST['customer'], true);
	
	if(!empty($arrayDecode['CustomerID']))
	{
		$result1 = $db->query('SELECT * FROM Customer');
		$data1 = $result1->fetchAll();
		
		foreach($data1 as $row)
		{			
			if ($arrayDecode['CustomerID'] == $row['CustomerID'])
			{
				$update = $db->prepare('UPDATE Customer SET CustomerTaxID = ?, CompanyName = ?, AdressDetail = ?, City = ?, PostalCode = ?, Country = ?, Email = ? WHERE CustomerID = ?');
				$update->execute(array($arrayDecode['CustomerTaxID'],
									   $arrayDecode['CompanyName'],
									   $arrayDecode['AdressDetail'],
									   $arrayDecode['City'],
									   $arrayDecode['PostalCode'],
									   $arrayDecode['Country'], 
									   $arrayDecode['Email'],
									   $arrayDecode['CustomerID']));
				$createArray = array("CustomerID" => $arrayDecode['CustomerID'],
									"CustomerTaxID" => $arrayDecode['CustomerTaxID'],
									"CompanyName" => $arrayDecode['CompanyName'],
									"AdressDetail" => $arrayDecode['AdressDetail'],
									"City" => $arrayDecode['City'],							   
				 				    "PostalCode" => $arrayDecode['PostalCode'],
								    "Country" => $arrayDecode['Country'],
								    "Email" => $arrayDecode['Email']);	
				$CustomerArray = json_encode($createArray);						   
				$check = 1;
				break;		
			}
			else $check = 0;
		}
	}
	else 
	{				
		$getMaxID = $db->prepare('SELECT CustomerID, MAX(id) FROM Customer');
		$getMaxID->execute();
		$maxID = $getMaxID->fetch(0);
		$maxID[0]++;		
		
		$update = $db->prepare('INSERT INTO Customer (CustomerID, CustomerTaxID, CompanyName, AdressDetail, City, PostalCode, Country, Email) Values(?,?,?,?,?,?,?,?)');
		$update->execute(array($maxID[0], 
									   $arrayDecode['CustomerTaxID'],
									   $arrayDecode['CompanyName'],
									   $arrayDecode['AdressDetail'],
									   $arrayDecode['City'],
									   $arrayDecode['PostalCode'],
									   $arrayDecode['Country'], 
									   $arrayDecode['Email']));
		$createArray = array("CustomerID" => $maxID[0],
							 "CustomerTaxID" => $arrayDecode['CustomerTaxID'],
							 "CompanyName" => $arrayDecode['CompanyName'],
							 "AdressDetail" => $arrayDecode['AdressDetail'],
 							 "City" => $arrayDecode['City'],							   
							 "PostalCode" => $arrayDecode['PostalCode'],
							 "Country" => $arrayDecode['Country'],
							 "Email" => $arrayDecode['Email']);		
		$CustomerArray = json_encode($createArray);	
	}
		
	if(empty($CustomerArray)) 
	{
		echo "{“error”:{“code”:601,”reason”:”Permission denied”}}";
	}
	else
	{
		echo $CustomerArray;
	}	
?>