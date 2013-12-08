<?php 
	include 'header.php';

	echo '<div id="conteudo">
		  <div class="texto">';

	if ($_SESSION['permission'] == "reader")
	{
		echo ' Precisa de ter permissões de writer para criar clientes!';
		exit();
	}
?>

	 	<form action="createCustomer.php" method="POST">
			<h2>Adicionar Cliente:</h2><br>
			ID: <br><input type="integer" name="ID"> <br><br>
			Numero Contribuinte: <br><input type="integer" name="TaxID"><br><br>
			Nome da Empresa: <br><input type="text" name="CompanyName"><br><br>
			Morada: <br><input type="text" name="Address"><br><br>
			Cidade: <br><input type="text" name="City"><br><br>
			Código Postal: <br><input type="integer" name="PostalCode"><br><br>
			Código Pais: <br><input type="integer" name="Country"><br><br>
			Email: <br><input type="text" name="Email"><br><br>
			<input type="submit" value="Criar novo">
		</form>
	</div>
</div>