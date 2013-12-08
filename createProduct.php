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
	$query = $db->prepare("SELECT * FROM Product WHERE ProductCode = ?");
	$product = $query->execute(array($_POST['ProductCode']));

	if (!$product)
	{
		$Insert= $db->prepare("INSERT INTO Product(ProductCode,ProductDescription, UnitPrice, UnitOfMeasure) VALUES (:code, :description, :price, :measure)");
		$Insert->bindParam(':code',$_POST['ProductCode'],PDO::PARAM_INT);
		$Insert->bindParam(':description',$_POST['ProductDescription'],PDO::PARAM_STR);
		$Insert->bindParam(':price',$_POST['UnitPrice'],PDO::PARAM_INT);
		$Insert->bindParam(':measure' ,$_POST['UnitOfMeasure'],PDO::PARAM_STR);
		$Insert->execute();

		echo 'Produto adicionado!';
	}
	else
	{
		echo 'Produto já existente!';
	}
?>

	</div>
</div>