<?php 
	include 'header.php';

	echo '<div id="conteudo">
		  <div class="texto">';

	if ($_SESSION['permission'] == "reader")
	{
		echo 'Precisa de ter permissões de writer para editar clientes!';
		exit();
	}

	$db = new PDO('sqlite:database/documents.db');
  	$customers = $db->query('SELECT * FROM Customer WHERE CustomerID = ?');
  	$customers->execute(array($_GET['CustomerID']));
  	$customer = $customers->fetch();


	echo '<form action="editCustomer.php" method="POST">
			<h2>Editar Cliente:</h2><br>
			Código: <br><input type="number" name="CustomerID" value='. $customer['CustomerID'] .' readonly><br><br>
			Número Contribuinte: <br><input type="number" name="CustomerTaxID" value="' . $customer['CustomerTaxID'] .'"><br><br>
			Nome da Empresa: <br><input type="text" name="CompanyName" value="' . $customer['CompanyName'] .'"><br><br>
			Morada: <br><input type="text" name="AdressDetail" value="' . $customer['AdressDetail'] .'"><br><br>
			Cidade: <br><input type="text" name="City" value="' . $customer['City'] .'"><br><br>
			Código Postal: <br><input type="number" name="PostalCode" value="' . $customer['PostalCode'] .'"><br><br>
			Código País: <br><input type="number" name="Country" value="' . $customer['Country'] .'"><br><br>
			Email: <br><input type="text" name="Email" value="' . $customer['Email'] .'"><br><br>
			<input type="submit" value="Editar Cliente">
		</form>';

		?>
	</div>
</div>