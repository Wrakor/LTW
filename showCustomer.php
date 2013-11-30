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
	   	echo '<h3 class="btab">' . '- ' . $row['CustomerID'] . '</h3></a>'; 

    echo '<div class="btab"><table border="1"><tr><td>' . '<b>Número de Contribuinte: </b></td><td>' .$row['CustomerTaxID'] . '</tr></td>';  
    echo '<tr><td><b> Nome do Cliente: </b></td><td>'  . $row['CompanyName'] . '</tr></td></table></div>';  

    echo '<div class="text"><table border="1">';
    echo '<tr><td><b>Dados de Morada: </b><br></tr></td>';
    echo '<tr><td><b class="btab"> Rua ou Avenida: </b></td><td>' . $row['AdressDetail'] . '</tr></td>';
    echo '<tr><td><b class="btab"> Cidade: </b></td><td>' . $row['City'] . '</tr></td>';
    echo '<tr><td><b class="btab"> Código Postal: </b></td><td>' . $row['PostalCode'] . '</tr></td>';
    echo '<tr><td><b class="btab"> Código do País: </b></td><td>' . $row['Country'] . '</tr></td>';
    echo '<tr><td><b>E-mail: </b></td><td>' . $row['Email'] . '</tr></td></table>';
}
	?>
	</div>
	</div>
</body>