<!DOCTYPE html>
<HTML>
	<HEAD>	
		<title> Sistema de faturação online </title>
		<META http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="../style.css">
	</HEAD>

	<BODY>
	<div id="conteudo">
		<div id="header">
			<div id ="title">
				<h2>Sistema de faturação online</h2>
			</div>
			<div id = "header-links">
	        <nav>
	            <ul>
	                <li><a href="../index.html"> Home </a></li>
	                <li><a href="consulta.html"> Consultar Documentos </a></li>
	                <li><a href="#portfolio"> Our Works </a></li>
	                <li><a href="#about-us"> About Us </a></li>
	                <li><a href="#contact"> Contact Us </a></li>
	            </ul>
	        </nav>
			</div>				
		</div>

		<div>
			<?php
					include 'header.html';
  					echo '<div id="conteudo">';
					echo '<div id="documentos">';

					$idCustomer = $_GET["CustomerID"];
						
					$db = new PDO('sqlite:documentos.db');
				 	$customers = $db->query('SELECT * FROM Customer');
				 

				 	$data = $customers->fetchAll();


				  echo '<h2> Clientes: </h2>';
				 	foreach ($data as $row) 
				  {

						if($row['CustomerID']==$idCustomer) { 
						
						  		$customerArray = array('ID Cliente' => $row['CustomerID'], 'ID Imposto' => $row['CustomerTaxID'],
						  		'Nome da Empresa' => $row['CompanyName'],'Morada' => array($row['AdressDetail'],
						  		'Cidade' => $row['City'], 'Codigo Postal' => $row['PostalCode'], 
						  		'Codigo Pais' => $row['Country'], 'Email' => $row['Email']));

						   
						    $json_array = json_encode($customerArray);
						    echo $json_array;
						   
						}	

				  }

				  if(empty($json_array)) {
				  	echo json_encode(array('error'=> array('code' => 601,'reason'=>'Permission denied')));
				  }

			?>	
		</div>
	<div>	
	</BODY>		
</HTML>