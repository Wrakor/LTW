
<?php
	$db = new PDO('sqlite:database\documents.db');

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
										$InvoiceArray[] = $row['InvoiceNo'];
										$InvoiceArray[] = $row['InvoiceDate'];										
										$InvoiceArray[] = $companyName;
										$InvoiceArray[] = $row['GrossTotal'];					
									}
									break;
								case 'min':
									if ($row['InvoiceNo'] >= $_GET['value1'])
									{
										$InvoiceArray[] = $row['InvoiceNo'];
										$InvoiceArray[] = $row['InvoiceDate'];
										$InvoiceArray[] = $companyName;
										$InvoiceArray[] = $row['GrossTotal'];					
									}
									break;
								case 'max':
									if ($row['InvoiceNo'] <= $_GET['value1'])
									{
										$InvoiceArray[] = $row['InvoiceNo'];
										$InvoiceArray[] = $row['InvoiceDate'];
										$InvoiceArray[] = $companyName;
										$InvoiceArray[] = $row['GrossTotal'];					
									}
									break;
								case 'contains':
									if(strpos($row['InvoiceNo'],$_GET['value1']) !== false)
									{
										$InvoiceArray[] = $row['InvoiceNo'];
										$InvoiceArray[] = $row['InvoiceDate'];
										$InvoiceArray[] = $companyName;
										$InvoiceArray[] = $row['GrossTotal'];	
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
										$InvoiceArray[] = $row['InvoiceNo'];
										$InvoiceArray[] = $row['InvoiceDate'];
										$InvoiceArray[] = $companyName;
										$InvoiceArray[] = $row['GrossTotal'];					
									}
									break;
								case 'min':
									if ($row['InvoiceDate'] >= $_GET['value1'])
									{
										$InvoiceArray[] = $row['InvoiceNo'];
										$InvoiceArray[] = $row['InvoiceDate'];
										$InvoiceArray[] = $companyName;
										$InvoiceArray[] = $row['GrossTotal'];					
									}
									break;
								case 'max':
									if ($row['InvoiceDate'] <= $_GET['value1'])
									{
										$InvoiceArray[] = $row['InvoiceNo'];
										$InvoiceArray[] = $row['InvoiceDate'];
										$InvoiceArray[] = $companyName;
										$InvoiceArray[] = $row['GrossTotal'];					
									}
									break;
								case 'contains':
									if(strpos($row['InvoiceDate'],$_GET['value1']) !== false)
									{
										$InvoiceArray[] = $row['InvoiceNo'];
										$InvoiceArray[] = $row['InvoiceDate'];
										$InvoiceArray[] = $companyName;
										$InvoiceArray[] = $row['GrossTotal'];	
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
										$InvoiceArray[] = $row['InvoiceNo'];
										$InvoiceArray[] = $row['InvoiceDate'];
										$InvoiceArray[] = $companyName;
										$InvoiceArray[] = $row['GrossTotal'];					
									}
									break;
								case 'min':
									if ($companyName >= $_GET['value1'])
									{
										$InvoiceArray[] = $row['InvoiceNo'];
										$InvoiceArray[] = $row['InvoiceDate'];
										$InvoiceArray[] = $companyName;
										$InvoiceArray[] = $row['GrossTotal'];					
									}
									break;
								case 'max':
									if ($companyName <= $_GET['value1'])
									{
										$InvoiceArray[] = $row['InvoiceNo'];
										$InvoiceArray[] = $row['InvoiceDate'];
										$InvoiceArray[] = $companyName;
										$InvoiceArray[] = $row['GrossTotal'];					
									}
									break;
								case 'contains':
									if(strpos(strtolower ($companyName),strtolower ($_GET['value1'])) !== false)
									{
										$InvoiceArray[] = $row['InvoiceNo'];
										$InvoiceArray[] = $row['InvoiceDate'];
										$InvoiceArray[] = $companyName;
										$InvoiceArray[] = $row['GrossTotal'];	
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
										$InvoiceArray[] = $row['InvoiceNo'];
										$InvoiceArray[] = $row['InvoiceDate'];
										$InvoiceArray[] = $companyName;
										$InvoiceArray[] = $row['GrossTotal'];					
									}
									break;
								case 'min':
									if ($row['GrossTotal'] >= $_GET['value1'])
									{
										$InvoiceArray[] = $row['InvoiceNo'];
										$InvoiceArray[] = $row['InvoiceDate'];
										$InvoiceArray[] = $companyName;
										$InvoiceArray[] = $row['GrossTotal'];					
									}
									break;
								case 'max':
									if ($row['GrossTotal'] <= $_GET['value1'])
									{
										$InvoiceArray[] = $row['InvoiceNo'];
										$InvoiceArray[] = $row['InvoiceDate'];
										$InvoiceArray[] = $companyName;
										$InvoiceArray[] = $row['GrossTotal'];					
									}
									break;
								case 'contains':
									if(strpos($row['GrossTotal'],$_GET['value1']) !== false)
									{
										$InvoiceArray[] = $row['InvoiceNo'];
										$InvoiceArray[] = $row['InvoiceDate'];
										$InvoiceArray[] = $companyName;
										$InvoiceArray[] = $row['GrossTotal'];	
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
								$InvoiceArray[] = $row['InvoiceNo'];
								$InvoiceArray[] = $row['InvoiceDate'];
								$InvoiceArray[] = $companyName;
								$InvoiceArray[] = $row['GrossTotal'];					
							}
							break;
						case 'InvoiceDate': 
							if ( ($row['InvoiceDate'] >= $_GET['value1']) && ($row['InvoiceDate'] <= $_GET['value2']))
							{
								$InvoiceArray[] = $row['InvoiceNo'];
								$InvoiceArray[] = $row['InvoiceDate'];
								$InvoiceArray[] = $companyName;
								$InvoiceArray[] = $row['GrossTotal'];					
							}						
							break;
						case 'CompanyName': 
							if ( ($companyName >= $_GET['value1']) && ($companyName <= $_GET['value2']))
							{
								$InvoiceArray[] = $row['InvoiceNo'];
								$InvoiceArray[] = $row['InvoiceDate'];
								$InvoiceArray[] = $companyName;
								$InvoiceArray[] = $row['GrossTotal'];					
							}
							break;
						case 'GrossTotal': 
							if ( ($row['GrossTotal'] >= $_GET['value1']) && ($row['GrossTotal'] <= $_GET['value2']))
							{
								$InvoiceArray[] = $row['InvoiceNo'];
								array_push($InvoiceArray, "\n");
								
								$InvoiceArray[] = $row['InvoiceDate'];
								$InvoiceArray[] = $companyName;
								$InvoiceArray[] = $row['GrossTotal'];					
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
			echo '<b class="btab">- Invoice Number </b>'  . $row['InvoiceNo'] . '<br>';  
			echo '<b class="btab">- Invoice Date </b>'  . $row['InvoiceDate'] . '<br>';  
			echo '<b class="btab">- Company Name </b>'  . $row['companyName'] . '<br>';  
			echo '<b class="btab">- Gross Total </b>'  . $row['GrossTotal'] . '<br>';  
		}
	}	
?>
