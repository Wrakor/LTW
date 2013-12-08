<?php
	include 'header.php';

	echo '<div id="conteudo">
		  <div class="texto">';

	if ($_SESSION['permission'] == "reader")
	{
		echo ' Precisa de ter permissões de writer para editar clientes!';
		exit();
	}

	$db = new PDO('sqlite:database/documents.db');

	$Insert= $db->prepare("UPDATE Customer SET CustomerTaxID = ?, CompanyName = ?, AdressDetail = ?,
							City = ?, PostalCode = ?, Country = ?, Email = ? WHERE CustomerID = ?");
	$Insert->execute(array($_POST['CustomerTaxID'], $_POST['CompanyName'], $_POST['AdressDetail'], 
					$_POST['City'], $_POST['PostalCode'], $_POST['Country'], $_POST['Email'], $_POST['CustomerID']));

	echo 'Cliente editado!';
?>