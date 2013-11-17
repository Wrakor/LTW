
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
	$db = new PDO('sqlite:database\documents.db');

	$InvoiceArray = array();

	if(!empty($_GET['field']))
	{				
		$result1 = $db->query('SELECT * FROM Customer');
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
						case 'CustomerID': 
							switch ($_GET['op'])
							{
								case 'equal':
									if ($row['CustomerID'] == $_GET['value1'])
									{
										$InvoiceArray2 = array('CustomerID' => $row['CustomerID'], 'CustomerTaxID' => $row['CustomerTaxID'],
										'CompanyName' =>  $row['CompanyName']);	
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'min':
									if ($row['CustomerID'] >= $_GET['value1'])
									{
										$InvoiceArray2 = array('CustomerID' => $row['CustomerID'], 'CustomerTaxID' => $row['CustomerTaxID'],
										'CompanyName' =>  $row['CompanyName']);				
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'max':
									if ($row['CustomerID'] <= $_GET['value1'])
									{
										$InvoiceArray2 = array('CustomerID' => $row['CustomerID'], 'CustomerTaxID' => $row['CustomerTaxID'],
										'CompanyName' =>  $row['CompanyName']);				
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'contains':
									if(strpos($row['CustomerID'],$_GET['value1']) !== false)
									{
										$InvoiceArray2 = array('CustomerID' => $row['CustomerID'], 'CustomerTaxID' => $row['CustomerTaxID'],
										'CompanyName' =>  $row['CompanyName']);	
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
							}
							break;
						case 'CustomerTaxID': 
							switch ($_GET['op'])
							{
								case 'equal':
									if ($row['CustomerTaxID'] == $_GET['value1'])
									{
										$InvoiceArray2 = array('CustomerID' => $row['CustomerID'], 'CustomerTaxID' => $row['CustomerTaxID'],
										'CompanyName' =>  $row['CompanyName']);				
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'min':
									if ($row['CustomerTaxID'] >= $_GET['value1'])
									{
										$InvoiceArray2 = array('CustomerID' => $row['CustomerID'], 'CustomerTaxID' => $row['CustomerTaxID'],
										'CompanyName' =>  $row['CompanyName']);					
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'max':
									if ($row['CustomerTaxID'] <= $_GET['value1'])
									{
										$InvoiceArray2 = array('CustomerID' => $row['CustomerID'], 'CustomerTaxID' => $row['CustomerTaxID'],
										'CompanyName' =>  $row['CompanyName']);					
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'contains':
									if(strpos($row['CustomerTaxID'],$_GET['value1']) !== false)
									{
										$InvoiceArray2 = array('CustomerID' => $row['CustomerID'], 'CustomerTaxID' => $row['CustomerTaxID'],
										'CompanyName' =>  $row['CompanyName']);
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
							}
							break;
						case 'CompanyName': 
							switch ($_GET['op'])
							{
								case 'equal':
									if (strtolower ($row['CompanyName']) == strtolower ($_GET['value1']))
									{
										$InvoiceArray2 = array('CustomerID' => $row['CustomerID'], 'CustomerTaxID' => $row['CustomerTaxID'],
										'CompanyName' =>  $row['CompanyName']);		
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'min':
									if ($row['CompanyName'] >= $_GET['value1'])
									{
										$InvoiceArray2 = array('CustomerID' => $row['CustomerID'], 'CustomerTaxID' => $row['CustomerTaxID'],
										'CompanyName' =>  $row['CompanyName']);					
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'max':
									if ($row['CompanyName'] <= $_GET['value1'])
									{
										$InvoiceArray2 = array('CustomerID' => $row['CustomerID'], 'CustomerTaxID' => $row['CustomerTaxID'],
										'CompanyName' =>  $row['CompanyName']);				
										array_push($InvoiceArray, $InvoiceArray2);
									}
									break;
								case 'contains':
									if(strpos(strtolower ($row['CompanyName']),strtolower ($_GET['value1'])) !== false)
									{
										$InvoiceArray2 = array('CustomerID' => $row['CustomerID'], 'CustomerTaxID' => $row['CustomerTaxID'],
										'CompanyName' =>  $row['CompanyName']);
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
						case 'CustomerID': 
							if ( ($row['CustomerID'] >= $_GET['value1']) && ($row['CustomerID'] <= $_GET['value2']))
							{
								$InvoiceArray2 = array('CustomerID' => $row['CustomerID'], 'CustomerTaxID' => $row['CustomerTaxID'],
								'CompanyName' =>  $row['CompanyName']);
								array_push($InvoiceArray, $InvoiceArray2);
							}
							break;
						case 'CustomerTaxID': 
							if ( ($row['CustomerTaxID'] >= $_GET['value1']) && ($row['CustomerTaxID'] <= $_GET['value2']))
							{
								$InvoiceArray2 = array('CustomerID' => $row['CustomerID'], 'CustomerTaxID' => $row['CustomerTaxID'],
								'CompanyName' =>  $row['CompanyName']);	
								array_push($InvoiceArray, $InvoiceArray2);
							}						
							break;
						case 'CompanyName': 
							if ( (strtolower ($row['CompanyName']) >= strtolower ($_GET['value1'])) && (strtolower ($row['CompanyName']) <= strtolower ($_GET['value2'])))
							{
								$InvoiceArray2 = array('CustomerID' => $row['CustomerID'], 'CustomerTaxID' => $row['CustomerTaxID'],
								'CompanyName' =>  $row['CompanyName']);
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
			echo '<b class="btab">- Customer ID </b>'  . $row['CustomerID'] . '<br>';  
			echo '<b class="btab">- Customer Tax ID </b>'  . $row['CustomerTaxID'] . '<br>';  
			echo '<b class="btab">- Company Name </b>'  . $row['CompanyName'] . '<br>';  			
		}
	}	
?>
</div>
</div>
</body>