<?php session_start(); ?>
<!DOCTYPE html>

<head>
	<title> Sistema de Faturação </title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style.css">
</head>

</body>
	<?php
		include 'header.html';

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