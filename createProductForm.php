<?php 
	include 'header.php';

	echo '<div id="conteudo">
		  <div class="texto">';

	if ($_SESSION['permission'] == "reader")
	{
		echo ' Precisa de ter permissões de writer para criar documentos!';
		exit();
	}
?>

	 	<form action="createProduct.php" method="POST">
			<h2>Adicionar Produto:</h2><br>
			Código: <br><input type="integer" name="ProductCode"> <br><br>
			Descrição: <br><input type="text" name="ProductDescription"><br><br>
			Preço Unitário: <br><input type="number" name="UnitPrice"><br><br>
			Unidade de medida: <br><input type="text" name="UnitOfMeasure"><br><br>
			<input type="submit" value="Criar novo">
		</form>
	</div>
</div>