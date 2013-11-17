<!DOCTYPE html>

<HTML>
	<HEAD>	
		<title> Sistema de faturação online </title>
		<META http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="style.css">
		</HEAD>

<body>
<?php
	include 'header.html';
  	echo '<div id="conteudo">';
	echo '<div class="documentos" style="border-right: none;">';
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
										$InvoiceArray2 = array('ProductCode' => $row['ProductCode'], 'ProductDescription' => $row['ProductDescription'],
										'UnitPrice' =>  $row['UnitPrice']);		
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'min':
									if ($row['ProductCode'] >= $_GET['value1'])
									{
										$InvoiceArray2 = array('ProductCode' => $row['ProductCode'], 'ProductDescription' => $row['ProductDescription'],
										'UnitPrice' =>  $row['UnitPrice']);					
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'max':
									if ($row['ProductCode'] <= $_GET['value1'])
									{
										$$InvoiceArray2 = array('ProductCode' => $row['ProductCode'], 'ProductDescription' => $row['ProductDescription'],
										'UnitPrice' =>  $row['UnitPrice']);						
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'contains':
									if(strpos($row['ProductCode'],$_GET['value1']) !== false)
									{
										$InvoiceArray2 = array('ProductCode' => $row['ProductCode'], 'ProductDescription' => $row['ProductDescription'],
										'UnitPrice' =>  $row['UnitPrice']);		
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
							}
							break;
						case 'ProductDescription': 
							switch ($_GET['op'])
							{
								case 'equal':
									if ( strtolower ($row['ProductDescription']) == strtolower ($_GET['value1']))
									{
										$InvoiceArray2 = array('ProductCode' => $row['ProductCode'], 'ProductDescription' => $row['ProductDescription'],
										'UnitPrice' =>  $row['UnitPrice']);
										array_push($InvoiceArray, $InvoiceArray2);										
									}
									break;
								case 'min':
									if ($row['ProductDescription'] >= $_GET['value1'])
									{
										$InvoiceArray2 = array('ProductCode' => $row['ProductCode'], 'ProductDescription' => $row['ProductDescription'],
										'UnitPrice' =>  $row['UnitPrice']);						
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'max':
									if ($row['ProductDescription'] <= $_GET['value1'])
									{
										$InvoiceArray2 = array('ProductCode' => $row['ProductCode'], 'ProductDescription' => $row['ProductDescription'],
										'UnitPrice' =>  $row['UnitPrice']);						
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'contains':
									if(strpos(strtolower ($row['ProductDescription']),strtolower ($_GET['value1'])) !== false)
									{
										$InvoiceArray2 = array('ProductCode' => $row['ProductCode'], 'ProductDescription' => $row['ProductDescription'],
										'UnitPrice' =>  $row['UnitPrice']);
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
						case 'ProductCode': 
							if ( ($row['ProductCode'] >= $_GET['value1']) && ($row['ProductCode'] <= $_GET['value2']))
							{
								$InvoiceArray2 = array('ProductCode' => $row['ProductCode'], 'ProductDescription' => $row['ProductDescription'],
								'UnitPrice' =>  $row['UnitPrice']);
								array_push($InvoiceArray, $InvoiceArray2);
							}
							break;
						case 'ProductDescription': 
							if ( (strtolower ($row['ProductDescription']) >= strtolower ($_GET['value1'])) && (strtolower ($row['ProductDescription']) <= strtolower ($_GET['value2'])))							
							{
								$InvoiceArray2 = array('ProductCode' => $row['ProductCode'], 'ProductDescription' => $row['ProductDescription'],
								'UnitPrice' =>  $row['UnitPrice']);
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
		echo "There was no results.";
	}
	else
	{
		foreach($InvoiceArray as $row)
		{
			echo '<b class="btab">- Product Code </b>'  . $row['ProductCode'] . '<br>';  
			echo '<b class="btab">- Product Description </b>'  . $row['ProductDescription'] . '<br>';  
			echo '<b class="btab">- Unit Price </b>'  . $row['UnitPrice'] . '<br>';  			
		}
	}		
?>
</div>
</div>
</body>