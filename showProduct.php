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
 	$stmt = $db->prepare('SELECT * FROM Product WHERE ProductCode = ?');
   	$stmt->execute(array($_GET['ProductCode']));
   	$row = $stmt->fetch();

   	if (!$row)
   		echo 'Não foram encontrados produtos com código ' . $_GET['ProductCode'] . '!';
   	else
   	{
	   	echo '<h3 class="btab">' . '- ' . $row['ProductCode'] . '</h3>'; 

	    echo '<div class="btab">' . '<b>Descrição: </b>' . $row['ProductDescription'] . '<br></div>';  

	    echo '<div style="padding-left: 15px;"> <b>Preço Unitário: </b>' . $row['UnitPrice'] . '</br>'; 
	    echo '<b>Unidade de medida: </b>' . $row['UnitOfMeasure'] . '</br></div>';
	}	
    ?>
    </div>
  </div>
</body>
