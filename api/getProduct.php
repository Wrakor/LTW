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

					$ProductCode = $_GET["ProdCod"];
						
					$db = new PDO('sqlite:database/documents.db');
				 	$products = $db->query('SELECT * FROM Product');
				 

				 	$data = $products->fetchAll();


				  echo '<h2> Produtos: </h2>';
				 	foreach ($data as $row) 
				  {

						if($row['ProductCode']==$ProductCode) { 
						
						  		$productArray = array('Codigo Produto' => $row['ProductCode'], 
						  		'Descricao Produto' => $row['ProductDescription'],
						  		'Preco Unitario' => $row['UnitPrice'],
						  		'Unidade de medida do produto ou servico' => $row['UnitOfMeasure']);

						   
						    $json_array = json_encode($productArray);
						    echo $json_array;
						   
						}	

				  }

				  if(empty($json_array)) {
				  	echo json_encode(array('error'=> array('code' => 404,'reason'=>'Product not found')));
				  }

			?>	
		</div>
	<div>	
	</BODY>		
</HTML>