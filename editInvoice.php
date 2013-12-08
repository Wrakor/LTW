<?php
	include 'header.php';

	echo '<div id="conteudo">
		  <div class="texto">';

	if ($_SESSION['permission'] == "reader")
	{
		echo 'Precisa de ter permissões de writer para editar faturas!';
		exit();
	}

	$db = new PDO('sqlite:database/documents.db');

	$insert = $db->prepare("UPDATE Invoice SET InvoiceDate = ?, CustomerID = ?, TaxPayable = ?, NetTotal = ?, GrossTotal = ? WHERE InvoiceNo = ?");
	$insert->execute(array($_POST['InvoiceDate'], $_POST['CustomerID'], $_POST['TaxPayable'], $_POST['NetTotal'], $_POST['TaxPayable'] + $_POST['NetTotal'], $_POST['InvoiceNo']));	
	$count = count($_POST['ProductCode']);	
	
	for($i = 0; $i < $count ;$i++)
	{
		$insert = $db->prepare('UPDATE Line SET ProductCode = ?, Quantity = ?, UnitPrice = ?, CreditAmount = ?, TaxType = ?, TaxPercentage = ? WHERE LineNumber = ?');
		$insert->execute(array($_POST['ProductCode'][$i], 
		$_POST['Quantity'][$i],
		$_POST['UnitPrice'][$i], 
		$_POST['Quantity'][$i] * $_POST['UnitPrice'][$i], 
		$_POST['TaxType'][$i], 
		$_POST['TaxPercentage'][$i], 
		$i+1));
	}

	echo 'Fatura editada!';
?>