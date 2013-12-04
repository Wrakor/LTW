<?php session_start(); ?>
<!DOCTYPE html>

<head>
	<title> Sistema de Faturação </title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style.css">
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
		                <li id="consultar"><a href=""> <img src="images/sheet-white.png" width="15" height="15" />  Consultar Documentos </a></li>
		                <li><a href="search.php"> <img src="images/search-white.png" width="15" height="15" /> Pesquisa Avançada </a></li>
		            </ul>
		        </nav>
		    </div>
	    </div>
	    <div id="documents">
		<ul>
		  <li><a href="checkInvoices.php"> Faturas </a></li>
		  <li><a href="checkProducts.php"> Produtos e Serviços </a></li>
		  <li><a href="checkCustomers.php"> Clientes </a></li>
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
			echo '<br><br> <u><a href="index.php"> Voltar Atrás</a></u>';
		}
		else if (!$password)
		{
			echo 'Introduza uma palavra passe!';
			echo '<br><br> <u><a href="index.php"> Voltar Atrás</a></u>';
		}
		else if ($result['Password'] != $encryptedPassword)
		{
			echo "Palavra passe errada!";
			echo '<br><br> <u><a href="index.php"> Voltar Atrás</a></u>';
		}
		else 
		{
			echo "Bem vindo, " . $username . "!";
			echo '<br><br> <u><a href="index.php"> Voltar Atrás</a></u>';

			//session_start();
			$_SESSION['username'] = $username;
			$_SESSION['permission'] = $result['Permission'];
		}

		echo '</div></div>';
		?>

</body>