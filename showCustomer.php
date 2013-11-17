<!DOCTYPE html>

<head>
	<title> Sistema de faturação online </title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<?php 
	include 'header.html';
 	echo '<div id="conteudo">';
 	echo '<div class="documentos" style="border-right: none;">';
 	
	$db = new PDO('sqlite:database/documents.db');
 	$stmt = $db->prepare('SELECT * FROM Customer WHERE CustomerID = ?');
   	$stmt->execute(array($_GET['CustomerID']));
   	$row = $stmt->fetch();

   	if (!$row)
   		echo 'Não foram encontrados clientes com ID ' . $_GET['CustomerID'] . '!';
   	else
   	{
	   	echo '<h3 class="btab">' . '- ' . $row['CustomerID'] . '</h3>'; 

	    echo '<div class="btab">' . '<b>Número de Contribuinte: </b>' .$row['CustomerTaxID'] . '<br>';  
	    echo '<b> Nome do Cliente: </b>'  . $row['CompanyName'] . '<br></div>';  

	    echo '<div style="padding-left: 15px;">';
	    echo '<b>Dados de Morada: </b><br>';
	    echo '<b class="btab"> Rua ou Avenida: </b>' . $row['AdressDetail'] . '<br>';
	    echo '<b class="btab"> Cidade: </b>' . $row['City'] . '<br>';
	    echo '<b class="btab"> Código Postal: </b>' . $row['PostalCode'] . '<br>';
	    echo '<b class="btab"> Código do País: </b>' . $row['Country'] . '<br>';
	    echo '<b>E-mail: </b>' . $row['Email'] . '<br>';
}
	?>
	</div>
	</div>
</body>