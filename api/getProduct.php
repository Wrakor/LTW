<!DOCTYPE html>
<HTML>
	<HEAD>	
		<title> Sistema de faturação online </title>
		<META http-equiv="Content-Type" content="text/html; charset=utf-8">
	</HEAD>

	<BODY>
		<?php
			$ProductCode = $_GET["ProductCode"];
				
			$db = new PDO('sqlite:../database/documents.db');
		 	$products = $db->query('SELECT * FROM Product');
		 

		 	$data = $products->fetchAll();

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
	</BODY>		
</HTML>