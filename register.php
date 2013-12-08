<!DOCTYPE html>
<html>
	<head>
	<title> Sistema de Faturação </title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="javascript/header.js"></script>
</head>

<body>	
	<div id="header">
		<div id="header-contents">
		    <div id ="title">
		    	<h2>Sistema de Faturação</h2>
		    </div>
		    <div id = "header-links">
		        <nav>
		            <ul>
		                <li><a href="index.php"> <img src="images/home-white.png" width="15" height="15" /> Home </a></li>
		                <li id="check"><a href=""> <img src="images/sheet-white.png" width="15" height="15" />  Consultar Documentos </a></li>
		                <li id="create"><a href=""> <img src="images/create-sheet.png" width="15" height="15" />  Criar Documentos </a></li>
		                <li><a href="search.php"> <img src="images/search-white.png" width="15" height="15" /> Pesquisa Avançada </a></li>
		            </ul>
		        </nav>
		    </div>
	    </div>
	    <div class="documents" id="checkDocuments">
			<ul>
			  <li><a href="checkInvoices.php"> Faturas </a></li>
			  <li><a href="checkProducts.php"> Produtos e Serviços </a></li>
			  <li><a href="checkCustomers.php"> Clientes </a></li>
			</ul>
		</div>
		<div class="documents" id="createDocuments">
			<ul>
			  <li><a href="createInvoiceForm.php"> Faturas </a></li>
			  <li><a href="createProductForm.php"> Produtos e Serviços </a></li>
			  <li><a href="createCustomerForm.php"> Clientes </a></li>
			</ul>
		</div>
	</div>

	<?php
		$User_name = $_POST["username"];
		$User_password = $_POST["pass"];
		$permission ="reader";
		$encrypted_pass = hash("sha512", $User_password);
		$db = new PDO('sqlite:database/users.db');
		$selectUsers = $db->query("SELECT * FROM User");
		$data = $selectUsers->fetchAll();

		$User_exists = FALSE;
		foreach ($data as $row) {
			if($row['Name'] == $User_name) {
				$User_exists = TRUE;
			}
		}
		
		//Se user nao registado, adiciona
		if($User_exists==FALSE) {
			$queryInsert= $db->prepare("INSERT INTO User(Name,Password, Permission) VALUES (:name,:pass,:permission)");
			$queryInsert->bindParam(':name',$User_name,PDO::PARAM_STR);
			$queryInsert->bindParam(':pass',$encrypted_pass,PDO::PARAM_STR);
			$queryInsert->bindParam(':permission',$permission,PDO::PARAM_STR);
			$queryInsert->execute();

			echo '<div id="login">
	  					<p style= "color: white"> Utilizador registado! </p>
	  					<a href="index.php"> <u> Voltar à Página Inicial <u></a>
				   </div>';
		}
		else {
			echo '<div id="login">
	  			 	    <p style= "color: white"> Username já existente! </p>
	  					<a href="register.html"> <u>Tentar novamente. </u></a>
				  </div>';
		}
	?>	
</body>		
</html>