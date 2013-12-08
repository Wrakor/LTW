<?php 
	include 'header.php';

	$db = new PDO('sqlite:database/users.db');
 	$users = $db->query('SELECT * FROM User WHERE Name = ?');
  	$users->execute(array($_POST['user']));
 	$data = $users->fetch();

  	$user = $data['Name'];
  	$newPermission = $_POST['newPermission'];

  	echo '<div id="conteudo">';
	echo '<div class="texto">';

  	if ($data['Permission'] == $newPermission)
  	{
  		echo 'O utilizador já tem essas permissões!<br>';
  	}
  	else
  	{
	  	$update = $db->prepare('UPDATE User SET Permission = :newPermission WHERE Name = :name');
	  	$update->bindParam(':name', $user, PDO::PARAM_STR);
	  	$update->bindParam(':newPermission', $newPermission, PDO::PARAM_STR);
	  	$update->execute();

	  	echo ' Permissões do Utilizador ' . $user . ' mudadas!<br>';
    }

    echo '<br><a href="manageUsers.php"><u> Voltar à Página de Gestão de Utilizadores</u></a>'
?>

</div>
</div>
</body>

