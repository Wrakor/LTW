
<?php
	include 'header.php';

	echo '<div id="conteudo">
		  <div class="texto">';

	if ($_SESSION['permission'] == "reader")
	{
		echo ' Precisa de ter permissões de writer para criar faturas!';
		exit();
	}
	
	$db = new PDO('sqlite:database/documents.db');
	
	$getMaxID = $db->prepare('SELECT InvoiceNo, MAX(id) FROM Invoice');
	$getMaxID->execute();
	$maxID = $getMaxID->fetch(0);		
	$int = (int) preg_replace('/[^0-9]/', '', $maxID[0]);
	$maxID = "FT-SEQ/" . ($int + 1);
	
	$update = $db->prepare('INSERT INTO Invoice (InvoiceNo, InvoiceDate, CustomerID, TaxPayable, NetTotal, GrossTotal) Values(?,?,?,?,?,?)');
	$update->execute(array($maxID, 
						   $_GET['InvoiceDate'],
						   $_GET['CustomerID'],
						   $_GET['TaxPayable'],
						   $_GET['NetTotal'],
						   $_GET['TaxPayable'] + $_GET['NetTotal']));
	$count = count($_GET['ProductCode']);	
	$lineNumber = 0;
	$getMaxID = $db->prepare('SELECT InvoiceNo, MAX(id) FROM Invoice');
	$getMaxID->execute();
	$maxID = $getMaxID->fetch(0);
	$maxID = $maxID[1];
	
	for ($i = 0; $i < $count; $i++)
	{		
		$lineNumber++;
		$update = $db->prepare('INSERT INTO Line (idInvoice, LineNumber, ProductCode, Quantity, UnitPrice, CreditAmount, TaxType, TaxPercentage) Values(?,?,?,?,?,?,?,?)');			
		$update->execute(array($maxID,
							   $lineNumber,
							   $_GET['ProductCode'][$i],
							   $_GET['Quantity'][$i],
						       $_GET['UnitPrice'][$i],
						       $_GET['Quantity'][$i] *  $_GET['UnitPrice'][$i],
						       $_GET['TaxType'][$i],
						       $_GET['TaxPercentage'][$i]));		
	}
	
	echo "Fatura criada com sucesso!";
		
	/*$result1 = $db->query('SELECT * FROM Invoice');
	$result2 = $db->query('SELECT * FROM Line');	
	$data1 = $result1->fetchAll();
	$data2 = $result2->fetchAll();
	
	foreach($data1 as $row)
	{		
		if($row['InvoiceNo'] == $maxID)
		{			
			echo '<b class="btab">- Invoice Number </b>'  . $row['InvoiceNo'] . '<br>';  
			echo '<b class="btab">- Invoice Date </b>'  . $row['InvoiceDate'] . '<br>';  
			echo '<b class="btab">- Customer ID </b>'  . $row['CustomerID'] . '<br>';  
			echo '<b class="btab">- Tax Payable </b>'  . $row['TaxPayable'] . '<br>';  
			echo '<b class="btab">- Net Total </b>'  . $row['NetTotal'] . '<br>';
			echo '<b class="btab">- Gross Total </b>'  . $row['GrossTotal'] . '<br><br>'; 
			foreach($data2 as $row2)
			{
				if($row2['idInvoice'] == $maxID)
				{
					echo '<b class="btab">- Line Number </b>'  . $row2['LineNumber'] . '<br>';  
					echo '<b class="btab">- Product Code </b>'  . $row2['ProductCode'] . '<br>';  
					echo '<b class="btab">- Quantity </b>'  . $row2['Quantity'] . '<br>';
					echo '<b class="btab">- Unit Price </b>'  . $row2['UnitPrice'] . '<br>';  
					echo '<b class="btab">- Credit Amount </b>'  . $row2['CreditAmount'] . '<br>';
					echo '<b class="btab">- Tax Type </b>'  . $row2['TaxType'] . '<br>';  
					echo '<b class="btab">- Tax Percentage </b>'  . $row2['TaxPercentage'] . '<br><br>';    					
				}
			}
		}
	}	*/	
?>
	</div>
</div>
