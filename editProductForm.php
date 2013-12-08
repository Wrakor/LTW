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
  	$products = $db->query('SELECT * FROM Product WHERE ProductCode = ?');
  	$products->execute(array($_GET['ProductCode']));
  	$product = $products->fetch();

	echo '<form action="editProduct.php" method="POST">
			<h2>Editar Produto:</h2><br>
			Código: <br><input type="text" name="ProductCode" value='. $product['ProductCode'] .' readonly><br><br>
			Descrição: <br><input type="text" style="width: 300px" name="ProductDescription" value="' . $product['ProductDescription'] .'"><br><br>
			Preço Unitário: <br><input type="number" name="UnitPrice" value=' . $product['UnitPrice'] .'><br><br>
			Unidade de medida: <br><input type="text" name="UnitOfMeasure" value=' . $product['UnitOfMeasure'] .'><br><br>
			<input type="submit" value="Editar Produto">
		</form>';

		?>
	</div>
</div>