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

 		$password = $_POST["Password"];

		echo '<div id="conteudo">';
		echo '<div class="documentos">';
		
		if (!$result)
		{
			echo "Nome de utilizador não existente!";
			echo '<br> <a href="index.html"> Voltar Atrás</a>';
		}
		else if (!$password)
		{
			echo 'Introduza uma palavra passe!';
			echo '<br> <a href="index.html"> Voltar Atrás</a>';
		}
		else if ($result['Password'] != $password)
		{
			echo "Palavra passe errada!";
			echo '<br> <a href="index.html"> Voltar Atrás</a>';
		}
		else 
			echo "LOGGED IN BITCHEZ";




		echo '</div></div>';
		?>

</body>