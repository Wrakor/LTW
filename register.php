d<!DOCTYPE html>
<HTML>
	<HEAD>	
		<title> Sistema de faturação online </title>
		<META http-equiv="Content-Type" content="text/html; charset=utf-8">		
	</HEAD>

	<BODY>	
		<?php
			include 'header.html';

			$User_name = $_POST["username"];
			$User_password = $_POST["pass"];
			$Permission = $_POST["permission"];
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
				$queryInsert= $db->prepare("INSERT INTO User(Name,Password,Permission) VALUES (:name,:pass,:perm)");
				$queryInsert->bindParam(':name',$User_name,PDO::PARAM_STR);
				$queryInsert->bindParam(':pass',$encrypted_pass,PDO::PARAM_STR);
				$queryInsert->bindParam(':perm',$Permission,PDO::PARAM_STR);
				$queryInsert->execute();

				echo '<div id="login">
		  					<p style= "color: white"> Registado </p>
		  					<a href="index.html"> <img src="images/home-white.png" width="15" height="15" /> Home </a>
					   </div>';
			}
			else {
				echo '<div id="login">
		  			 	    <p style= "color: white"> Username ja existente </p>
		  					<a href="register.html"> Tentar novamente </a>
					  </div>';
			}
		?>	
	</BODY>		
</HTML>