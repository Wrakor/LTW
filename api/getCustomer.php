<!DOCTYPE html>
<HTML>
	<HEAD>	
		<title> Sistema de faturação online </title>
		<META http-equiv="Content-Type" content="text/html; charset=utf-8">		
	</HEAD>

	<BODY>	
		<?php

			$idCustomer = $_GET["CustomerID"];
				
			$db = new PDO('sqlite:../database/documents.db');
		 	$customers = $db->query('SELECT * FROM Customer');
		 

		 	$data = $customers->fetchAll();

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
	</BODY>		
</HTML>