
<?php
	$db = new PDO('sqlite:..\database\documents.db');

	$InvoiceArray = array();

	if(!empty($_GET['field']))
	{				
		$result1 = $db->query('SELECT * FROM Product');
		$data1 = $result1->fetchAll();
		foreach($data1 as $row)
		{						
			switch ($_GET['op'])
			{
				case 'equal':
				case 'contains':
				case 'min':				
				case 'max':
					switch ($_GET['field'])
					{
						case 'ProductCode': 
							switch ($_GET['op'])
							{
								case 'equal':
									if ($row['ProductCode'] == $_GET['value1'])
									{
										$InvoiceArray = array('ProductCode' => $row['ProductCode'], 'ProductDescription' => $row['ProductDescription'],
										'UnitPrice' =>  $row['UnitPrice']);		
									}
									break;
								case 'min':
									if ($row['ProductCode'] >= $_GET['value1'])
									{
										$InvoiceArray = array('ProductCode' => $row['ProductCode'], 'ProductDescription' => $row['ProductDescription'],
										'UnitPrice' =>  $row['UnitPrice']);					
									}
									break;
								case 'max':
									if ($row['ProductCode'] <= $_GET['value1'])
									{
										$$InvoiceArray = array('ProductCode' => $row['ProductCode'], 'ProductDescription' => $row['ProductDescription'],
										'UnitPrice' =>  $row['UnitPrice']);						
									}
									break;
								case 'contains':
									if(strpos($row['ProductCode'],$_GET['value1']) !== false)
									{
										$InvoiceArray = array('ProductCode' => $row['ProductCode'], 'ProductDescription' => $row['ProductDescription'],
										'UnitPrice' =>  $row['UnitPrice']);		
									}
									break;
							}
							break;
						case 'ProductDescription': 
							switch ($_GET['op'])
							{
								case 'equal':
									if ($row['ProductDescription'] == $_GET['value1'])
									{
										$InvoiceArray = array('ProductCode' => $row['ProductCode'], 'ProductDescription' => $row['ProductDescription'],
										'UnitPrice' =>  $row['UnitPrice']);						
									}
									break;
								case 'min':
									if ($row['ProductDescription'] >= $_GET['value1'])
									{
										$InvoiceArray = array('ProductCode' => $row['ProductCode'], 'ProductDescription' => $row['ProductDescription'],
										'UnitPrice' =>  $row['UnitPrice']);						
									}
									break;
								case 'max':
									if ($row['ProductDescription'] <= $_GET['value1'])
									{
										$InvoiceArray = array('ProductCode' => $row['ProductCode'], 'ProductDescription' => $row['ProductDescription'],
										'UnitPrice' =>  $row['UnitPrice']);						
									}
									break;
								case 'contains':
									if(strpos($row['ProductDescription'],$_GET['value1']) !== false)
									{
										$InvoiceArray = array('ProductCode' => $row['ProductCode'], 'ProductDescription' => $row['ProductDescription'],
										'UnitPrice' =>  $row['UnitPrice']);	
									}
									break;
							}
							break;						
					}
					break;
				case 'range':
					switch ($_GET['field'])
					{
						case 'ProductCode': 
							if ( ($row['ProductCode'] >= $_GET['value1']) && ($row['ProductCode'] <= $_GET['value2']))
							{
								$InvoiceArray = array('ProductCode' => $row['ProductCode'], 'ProductDescription' => $row['ProductDescription'],
										'UnitPrice' =>  $row['UnitPrice']);					
							}
							break;
						case 'ProductDescription': 
							if ( ($row['ProductDescription'] >= $_GET['value1']) && ($row['ProductDescription'] <= $_GET['value2']))
							{
								$InvoiceArray = array('ProductCode' => $row['ProductCode'], 'ProductDescription' => $row['ProductDescription'],
										'UnitPrice' =>  $row['UnitPrice']);					
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
    