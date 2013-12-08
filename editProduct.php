<?php
	include 'header.php';

	echo '<div id="conteudo">
		  <div class="texto">';

	if ($_SESSION['permission'] == "reader")
	{
		echo ' Precisa de ter permissões de writer para criar documentos!';
		exit();
	}

	$db = new PDO('sqlite:database/documents.db');

	$Insert= $db->prepare("UPDATE Product SET ProductDescription = ?, UnitPrice = ?, UnitOfMeasure = ? WHERE ProductCode = ?");
	$Insert->execute(array($_POST['ProductDescription'], $_POST['UnitPrice'], $_POST['UnitOfMeasure'], $_POST['ProductCode']));

	echo 'Produto editado!';
?>