<!DOCTYPE html>
<head>
	<title> Sistema de Faturação </title>
	<META http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<div id="header">
	    <div id="header-contents">
		    <div id ="title">
		    	<h2>Sistema de Faturação</h2>
		    </div>
		    <div id = "header-links">
		        <nav>
		            <ul>
		                <li><a href="index.html"> <img src="images/home-white.png" width="15" height="15" /> Home </a></li>
		                <li><a href="checkDocuments.php"> <img src="images/sheet-white.png" width="15" height="15" />  Consultar Documentos </a></li>
		                <li><a href="search.php"> <img src="images/search-white.png" width="15" height="15" /> Pesquisa Avançada </a></li>
		            </ul>
		        </nav>
		    </div>
	    </div>
	</div>

	<div id="conteudo">
	<div class="documentos" style="border-right: none;">
	<div id ="pesquisas_avancadas">
		<?php

		echo '<h2> Faturas: </h2> <br>'; 
		include "searchInvoicesByField.php";		
		echo '<br>';
		echo '<h2> Clientes: </h2> <br>';
		include "searchCustomersByField.php";
		echo '<br>';
		echo '<h2> Produtos: </h2> <br>';
		include "searchProductsByField.php";
		echo '<br>';
		?>
	</div>
	</div>
	</div>
	</div>
	</div>
	</body>
</html>
