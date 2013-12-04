<?php session_start(); ?>
<!DOCTYPE html>

<head>
	<title> Sistema de Faturação </title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script>

	$(document).ready(function(){
 	 		$("#consultar").click(function(e) {
      			if ($('#documents').css('visibility') == 'hidden')
      			{
      				$('#documents').css('visibility', 'visible');
      			}
      			else 
      				$('#documents').css('visibility', 'hidden');
      			e.preventDefault();
      			});
		});
    </script>
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
		                <li><a href="index.php"> <img src="images/home-white.png" width="15" height="15" /> Home </a></li>
		                <li id="consultar"><a href=""> <img src="images/sheet-white.png" width="15" height="15" />  Consultar Documentos </a></li>
		                <li><a href="search.php"> <img src="images/search-white.png" width="15" height="15" /> Pesquisa Avançada </a></li>
		            </ul>
		        </nav>
		    </div>
	    </div>
	    <div id="documents">
		<ul>
		  <li><a href="checkInvoices.php"> Faturas </a></li>
		  <li><a href="checkProducts.php"> Produtos e Serviços </a></li>
		  <li><a href="checkCustomers.php"> Clientes </a></li>
		</ul>
	</div>
	</div>

	<?php
	if (!isset($_SESSION['username']))
	{
		echo '<div id="conteudo">';
  		echo '<div class="texto" style="max-width: 100%">';
  		echo 'Não tem permissões para aceder a esta página! Aceda à Página Inicial para se registar ou fazer login. </div></div>';
		exit();
	}
	?>
</body>