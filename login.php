<?php session_start(); ?>
<!DOCTYPE html>

<head>
	<title> Sistema de Faturação </title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="javascript/header.js"></script>
</head>

</body>
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
			  <li><a href="createInvoices.php"> Faturas </a></li>
			  <li><a href="createProducts.php"> Produtos e Serviços </a></li>
			  <li><a href="createCustomers.php"> Clientes </a></li>
			</ul>
		</div>
</div>

<?php
		$db = new PDO('sqlite:database/users.db');
 		$data = $db->query('SELECT * FROM User WHERE Name = ?');
 		$data->execute(array($_POST["Name"]));
 		$result = $data->fetch();

		$username = $result['Name'];
 		$password = $_POST["Password"];
 		$encryptedPassword = hash("sha512", $password);
 		

		echo '<div id="conteudo">';
		echo '<div class="texto">';		
		
		if (!$result)
		{
			echo "Nome de utilizador não existente!";			
		}
		else if (!$password)
		{
			echo 'Introduza uma palavra passe!';
		}
		else if ($result['Password'] != $encryptedPassword)
		{
			echo "Palavra passe errada!";
		}
		else 
		{
			echo "Bem vindo, " . $username . "!";

			//session_start();
			$_SESSION['username'] = $username;
			$_SESSION['permission'] = $result['Permission'];
		}

		echo '<br><br> <u><a href="index.php"> Ir para a Página Inicial </a></u>';
		echo '</div></div>';
		?>

</body>