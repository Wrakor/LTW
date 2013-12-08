
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
		
?>
	</div>
</div>
