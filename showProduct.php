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
 	echo '<div class="documentos">';
 	
	$db = new PDO('sqlite:database/documents.db');
 	$stmt = $db->prepare('SELECT * FROM Product WHERE ProductCode = ?');
   	$stmt->execute(array($_GET['ProductCode']));
   	$row = $stmt->fetch();

   	if (!$row)
   		echo 'Não foram encontrados produtos com código ' . $_GET['ProductCode'] . '!';
   	else
   	{
		echo '<div class="btab"><table border="1"><tr><td>' . '<b>Código:</b></td><td>' . $row['ProductCode'] . '</td></tr>'; 

	    echo ' <tr><td>' . '<b>Descrição: </b></td><td>' . $row['ProductDescription'] . '</td></tr>';  
	    echo '<tr><td><b>Preço Unitário: </b></td><td>' . $row['UnitPrice'] . '</tr></td>'; 
	    echo '<tr><td><b>Unidade de medida: </b></td><td>' . $row['UnitOfMeasure'] . '</tr></td></table></div>';  
	}	
    ?>
    </div>
  </div>
</body>
