<?php
	include 'header.php';

	echo '<div id="conteudo">
		  <div class="texto">';

	if ($_SESSION['permission'] == "reader")
	{
		echo ' Precisa de ter permissões de writer para criar clientes!';
		exit();
	}

	$db = new PDO('sqlite:database/documents.db');
	$selectCustomers = $db->query("SELECT * FROM Customer");
	$allUsers = $selectCustomers->fetchAll();
	
	$customerExists=FALSE;
	foreach ($allUsers as $User) {
		 if($User['CustomerID'] == $_POST['ID']) {
		 	$customerExists = TRUE;
		 }
	}

	if($customerExists == FALSE) {
			$Insert= $db->prepare("INSERT INTO Customer(CustomerID,CustomerTaxID,CompanyName,AdressDetail,City,PostalCode,Country,Email) 
				VALUES (:CustomerID,:CustomerTaxID,:CompanyName,:AdressDetail,:City,:PostalCode,:Country,:Email)");
			$Insert->bindParam(':CustomerID',$_POST['ID'],PDO::PARAM_INT);
			$Insert->bindParam(':CustomerTaxID',$_POST['TaxID'],PDO::PARAM_INT);
			$Insert->bindParam(':CompanyName',$_POST['CompanyName'],PDO::PARAM_STR);
			$Insert->bindParam(':AdressDetail',$_POST['Address'],PDO::PARAM_STR);
			$Insert->bindParam(':City',$_POST['City'],PDO::PARAM_STR);
			$Insert->bindParam(':PostalCode',$_POST['PostalCode'],PDO::PARAM_INT);
			$Insert->bindParam(':Country',$_POST['Country'],PDO::PARAM_INT);
			$Insert->bindParam(':Email',$_POST['Email'],PDO::PARAM_STR);
			$Insert->execute();
			
			echo 'Cliente adicionado!';
	}
	else {
		echo 'Cliente já existente!';
	}
?>