<!DOCTYPE html>

<head>
	<title> Sistema de faturação online </title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="../style.css">
	<style type="text/css">
    .text{padding-left: 15px;}
     
    .btab{padding-left: 15px;}
    .btab2{padding-left: 30px;}
    .btab3{padding-left: 45px;}
	</style>
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
	   	echo '<h3 class="btab">' . '- ' . $row['ProductCode'] . '</h3>'; 

	    echo '<div class="btab">' . '<b>Descrição: </b>' . $row['ProductDescription'] . '<br></div>';  

	    echo '<div class="text"> <b>Preço Unitário: </b>' . $row['UnitPrice'] . '</br>'; 
	    echo '<b>Unidade de medida: </b>' . $row['UnitOfMeasure'] . '</br></div>';
	}	
    ?>
    </div>
  </div>
</body>
