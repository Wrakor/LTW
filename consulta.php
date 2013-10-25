<!DOCTYPE html>

<head>
	<title> Sistema de faturação online </title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style.css">
</head>

<body>
<div id="conteudo">
	<div id="header">
	    <div id ="title">
	    	<h2>Sistema de faturação online</h2>
	    </div>
	    <div id = "header-links">
	        <nav>
	            <ul>
	                <li><a href="index.html"> Home </a></li>
	                <li><a href="consulta.html"> Consultar Documentos </a></li>
	                <li><a href="#portfolio"> Our Works </a></li>
	                <li><a href="#about-us"> About Us </a></li>
	                <li><a href="#contact"> Contact Us </a></li>
	            </ul>
	        </nav>
	    </div>
	</div>

	<div id="documentos">
	<h3> Documentos existentes: </h2>

	<?php 
	$db = new PDO('sqlite:documentos.db');
   	$result = $db->query('SELECT * FROM Invoice');
   	$data = $result->fetchAll();
   	foreach ($data as $row) 
    {
    	echo '<h3>' . '- ' . $row['InvoiceNo'] . '</h3>';   
    }
  	?>

  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  		a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  		a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	a</br>
  	
  	a</br>

	</div>
</div>
</body>