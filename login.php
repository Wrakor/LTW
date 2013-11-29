<!DOCTYPE html>
<HTML>
	<HEAD>	
		<title> Sistema de faturação online </title>
		<META http-equiv="Content-Type" content="text/html; charset=utf-8">		
	</HEAD>

	<BODY>	
		<?php
			include 'header.html';
 			echo '<div id="login_verification" style="border-right: none;">';

			$User_name = $_POST["username"];
			$User_password = $_POST["pass"];

			$db = new PDO('sqlite:database/users.db');
		 	$users = $db->query('SELECT * FROM User');
		 	$data = $users->fetchAll();
		 	$user_registered = false;

		 	foreach ($data as $row) 
		    {	
				if($row['Name']==$User_name) {
					$user_registered = true;
				  	$password = $row['Password'];
				}	
		  	}

		  	if(!$user_registered) {
		  		echo '<h2>Usuário não registado</h2>';
		  	}
		  	else if($User_password != $password) {
		  		echo '<h2>Password incorreta</h2>';
		  	}
		  	else {
		  		echo '<h2>Login com sucesso</h2>';
		  	}
		?>	
		
		<a href="index.html"> Voltar ao Inicio</a>


	</BODY>		
</HTML>