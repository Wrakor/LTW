
<?php
	$db = new PDO('sqlite:database\documents.db');

	$InvoiceArray = array();

	if(!empty($_GET['field']))
	{				
		$result1 = $db->query('SELECT * FROM Invoice');
		$data1 = $result1->fetchAll();
		foreach($data1 as $row)
		{			
							
		}
	}
		
	if(empty($InvoiceArray)) 
	{
		echo "{“error”:{“code”:404,”reason”:”Invoice not found”}}";
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
