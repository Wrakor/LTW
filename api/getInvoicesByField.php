
<?php
	$db = new PDO('sqlite:..\database\documents.db');

	$InvoiceArray = array();

	if(!empty($_GET['field']))
	{				
		$result1 = $db->query('SELECT * FROM Invoice');
		$result2 = $db->query('SELECT *  FROM Customer');
		$data1 = $result1->fetchAll();
		$data2 = $result2->fetchAll();
		foreach($data1 as $row)
		{			
			$companyName;			
			foreach ($data2 as $row2)
			{
				if ($row['CustomerID'] == $row2['CustomerID'])
				{					
					$companyName = $row2['CompanyName'];					
				}	
			}				
			
			switch ($_GET['op'])
			{
				case 'equal':
				case 'contains':
				case 'min':				
				case 'max':
					switch ($_GET['field'])
					{
						case 'InvoiceNo': 
							switch ($_GET['op'])
							{
								case 'equal':
									if ($row['InvoiceNo'] == $_GET['value1'])
									{
										$InvoiceArray2 = array('InvoiceNo' => $row['InvoiceNo'], 'InvoiceDate' => $row['InvoiceDate'],
										'CompanyName' => $companyName,'GrossTotal' => $row['GrossTotal']);								
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'min':
									if ($row['InvoiceNo'] >= $_GET['value1'])
									{
										$InvoiceArray2 = array('InvoiceNo' => $row['InvoiceNo'], 'InvoiceDate' => $row['InvoiceDate'],
										'CompanyName' => $companyName,'GrossTotal' => $row['GrossTotal']);					
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'max':
									if ($row['InvoiceNo'] <= $_GET['value1'])
									{
										$InvoiceArray2 = array('InvoiceNo' => $row['InvoiceNo'], 'InvoiceDate' => $row['InvoiceDate'],
										'CompanyName' => $companyName,'GrossTotal' => $row['GrossTotal']);						
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'contains':
									if(strpos($row['InvoiceNo'],$_GET['value1']) !== false)
									{
										$InvoiceArray2 = array('InvoiceNo' => $row['InvoiceNo'], 'InvoiceDate' => $row['InvoiceDate'],
										'CompanyName' => $companyName,'GrossTotal' => $row['GrossTotal']);	
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
							}
							break;
						case 'InvoiceDate': 
							switch ($_GET['op'])
							{
								case 'equal':
									if ($row['InvoiceDate'] == $_GET['value1'])
									{
										$InvoiceArray2 = array('InvoiceNo' => $row['InvoiceNo'], 'InvoiceDate' => $row['InvoiceDate'],
										'CompanyName' => $companyName,'GrossTotal' => $row['GrossTotal']);						
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'min':
									if ($row['InvoiceDate'] >= $_GET['value1'])
									{
										$InvoiceArray2 = array('InvoiceNo' => $row['InvoiceNo'], 'InvoiceDate' => $row['InvoiceDate'],
										'CompanyName' => $companyName,'GrossTotal' => $row['GrossTotal']);					
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'max':
									if ($row['InvoiceDate'] <= $_GET['value1'])
									{
										$InvoiceArray2 = array('InvoiceNo' => $row['InvoiceNo'], 'InvoiceDate' => $row['InvoiceDate'],
										'CompanyName' => $companyName,'GrossTotal' => $row['GrossTotal']);					
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'contains':
									if(strpos($row['InvoiceDate'],$_GET['value1']) !== false)
									{
										$InvoiceArray2 = array('InvoiceNo' => $row['InvoiceNo'], 'InvoiceDate' => $row['InvoiceDate'],
										'CompanyName' => $companyName,'GrossTotal' => $row['GrossTotal']);
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
							}
							break;
						case 'CompanyName': 
							switch ($_GET['op'])
							{
								case 'equal':
									if ($companyName == $_GET['value1'])
									{
										$InvoiceArray2 = array('InvoiceNo' => $row['InvoiceNo'], 'InvoiceDate' => $row['InvoiceDate'],
										'CompanyName' => $companyName,'GrossTotal' => $row['GrossTotal']);
										array_push($InvoiceArray, $InvoiceArray2);										
									}
									break;
								case 'min':
									if ($companyName >= $_GET['value1'])
									{
										$InvoiceArray2 = array('InvoiceNo' => $row['InvoiceNo'], 'InvoiceDate' => $row['InvoiceDate'],
										'CompanyName' => $companyName,'GrossTotal' => $row['GrossTotal']);					
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'max':
									if ($companyName <= $_GET['value1'])
									{
										$InvoiceArray2 = array('InvoiceNo' => $row['InvoiceNo'], 'InvoiceDate' => $row['InvoiceDate'],
										'CompanyName' => $companyName,'GrossTotal' => $row['GrossTotal']);					
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'contains':
									if(strpos(strtolower ($companyName),strtolower ($_GET['value1'])) !== false)
									{
										$InvoiceArray2 = array('InvoiceNo' => $row['InvoiceNo'], 'InvoiceDate' => $row['InvoiceDate'],
										'CompanyName' => $companyName,'GrossTotal' => $row['GrossTotal']);		
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;								
							}
							break;
						case 'GrossTotal': 
							switch ($_GET['op'])
							{
								case 'equal':
									if ($row['GrossTotal'] == $_GET['value1'])
									{
										$InvoiceArray2 = array('InvoiceNo' => $row['InvoiceNo'], 'InvoiceDate' => $row['InvoiceDate'],
										'CompanyName' => $companyName,'GrossTotal' => $row['GrossTotal']);	
										array_push($InvoiceArray, $InvoiceArray2);										
									}
									break;
								case 'min':
									if ($row['GrossTotal'] >= $_GET['value1'])
									{
										$InvoiceArray2 = array('InvoiceNo' => $row['InvoiceNo'], 'InvoiceDate' => $row['InvoiceDate'],
										'CompanyName' => $companyName,'GrossTotal' => $row['GrossTotal']);
										array_push($InvoiceArray, $InvoiceArray2);										
									}
									break;
								case 'max':
									if ($row['GrossTotal'] <= $_GET['value1'])
									{
										$InvoiceArray2 = array('InvoiceNo' => $row['InvoiceNo'], 'InvoiceDate' => $row['InvoiceDate'],
										'CompanyName' => $companyName,'GrossTotal' => $row['GrossTotal']);	
										array_push($InvoiceArray, $InvoiceArray2);										
									}
									break;
								case 'contains':
									if(strpos($row['GrossTotal'],$_GET['value1']) !== false)
									{
										$InvoiceArray2 = array('InvoiceNo' => $row['InvoiceNo'], 'InvoiceDate' => $row['InvoiceDate'],
										'CompanyName' => $companyName,'GrossTotal' => $row['GrossTotal']);		
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
							}
							break;
					}
					break;
				case 'range':
					switch ($_GET['field'])
					{
						case 'InvoiceNo': 
							if ( ($row['InvoiceNo'] >= $_GET['value1']) && ($row['InvoiceNo'] <= $_GET['value2']))
							{
								$InvoiceArray2 = array('InvoiceNo' => $row['InvoiceNo'], 'InvoiceDate' => $row['InvoiceDate'],
								'CompanyName' => $companyName,'GrossTotal' => $row['GrossTotal']);
								array_push($InvoiceArray, $InvoiceArray2);
							}
							break;
						case 'InvoiceDate': 
							if ( ($row['InvoiceDate'] >= $_GET['value1']) && ($row['InvoiceDate'] <= $_GET['value2']))
							{
								$InvoiceArray2 = array('InvoiceNo' => $row['InvoiceNo'], 'InvoiceDate' => $row['InvoiceDate'],
								'CompanyName' => $companyName,'GrossTotal' => $row['GrossTotal']);
								array_push($InvoiceArray, $InvoiceArray2);
							}						
							break;
						case 'CompanyName': 
							if ( ($companyName >= $_GET['value1']) && ($companyName <= $_GET['value2']))
							{
								$InvoiceArray2 = array('InvoiceNo' => $row['InvoiceNo'], 'InvoiceDate' => $row['InvoiceDate'],
								'CompanyName' => $companyName,'GrossTotal' => $row['GrossTotal']);
								array_push($InvoiceArray, $InvoiceArray2);
							}
							break;
						case 'GrossTotal': 
							if ( ($row['GrossTotal'] >= $_GET['value1']) && ($row['GrossTotal'] <= $_GET['value2']))
							{
								$InvoiceArray2 = array('InvoiceNo' => $row['InvoiceNo'], 'InvoiceDate' => $row['InvoiceDate'],
								'CompanyName' => $companyName,'GrossTotal' => $row['GrossTotal']);
								array_push($InvoiceArray, $InvoiceArray2);								
							}
							break;
					}
					break;
			}					
		}
	}
		
	if(empty($InvoiceArray)) 
	{
		$InvoiceArray;
		echo json_encode($InvoiceArray);
	}
	else echo json_encode($InvoiceArray);		
?>
    