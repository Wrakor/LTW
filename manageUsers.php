<?php 
	include 'header.php';
	$db = new PDO('sqlite:database/users.db');
 	$users = $db->query('SELECT * FROM User WHERE Permission = "reader" OR Permission = "writer"');
  	$data = $users->fetchAll();

 	echo '<div id="conteudo">';
 	echo '<div class="texto">';
 	echo '<h2>Gestão de Utilizadores</h2><br>';

 	echo '<table border="1"><tr><th>Nome de Utilizador</th><th>Permissões</th>';

 	foreach($data as $row)
 	{
 		echo '<tr><td>' . $row['Name'] . '</td><td>'. $row['Permission'] .'</th>';
 	}
 	echo '</table><br><br>';

 	echo '
 		<div>
		<form action="changeUserPermissions.php" method="GET">
			Utilizador: 
			<select name="user">';

			foreach ($data as $row)
			{
				echo '<option>' . $row['Name'] . '</option>';
			}

	echo '
			</select><br>
			Permissões a atribuir:
			<select name="newPermission">
			<option> reader </option>
			<option> writer </option>
			</select><br><br>
			<input type="submit" value="Atribuir novas permissões">
		</form>';


 	echo '</div></div>';
 	?>
 </body>
