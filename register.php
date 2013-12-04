d<!DOCTYPE html>
<HTML>
	<HEAD>	
		<title> Sistema de faturação online </title>
		<META http-equiv="Content-Type" content="text/html; charset=utf-8">		
	</HEAD>

	<BODY>	
		<?php
			include 'header.php';

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
		  					<a href="index.php"> <u> Voltar atrás <u></a>
					   </div>';
			}
			else {
				echo '<div id="login">
		  			 	    <p style= "color: white"> Username já existente! </p>
		  					<a href="register.html"> <u>Tentar novamente. </u></a>
					  </div>';
			}
		?>	
	</BODY>		
</HTML>