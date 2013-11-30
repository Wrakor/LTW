<!DOCTYPE html>

<head>
	<title> Sistema de faturação online </title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style.css">

	<style type="text/css">   
     p{ display:none;} 
	</style>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
 	 		$(".mostrar").click(function(e) {
      			$(this).prev('.hiddenText').slideToggle("slow");
            var text = $(this).text();

            if (text == " Ver mais ")
            {
              $(this).text(' Ver menos ');
            }
            else
            {
              $(this).text(' Ver mais ');
            }
      			e.preventDefault();
      		});
		});
	</script>
</head>

<body>
	<?php 
	include 'header.html';  

  $db = new PDO('sqlite:database/documents.db');
  $products = $db->query('SELECT * FROM Product');
  $data = $products->fetchAll();

  echo '<div id="conteudo">';
  echo '<div class="texto">';
  echo '<h1> Produtos: </h1><br>';

  foreach ($data as $row) 
  {  
    $path = 'showProduct.php?ProductCode=' . $row['ProductCode']; 
    echo '<a href=' . $path . '> ';
    echo '<h3 class="btab"></td><td>' . '- ' . $row['ProductCode'] . '</h3></a>'; 

    echo '<div class="btab"><table border="1"> <tr><td>' . '<b>Descrição: </b>' . $row['ProductDescription'] . '</td></tr></table><br></div>';  
    echo '<div class="hiddenText"><table border="1"> <tr><td><b>Preço Unitário: </b></td><td>' . $row['UnitPrice'] . '</tr></td>'; 
    echo '<tr><td><b>Unidade de medida: </b></td><td>' . $row['UnitOfMeasure'] . '</tr></td></table>';    
    echo '</div>'; 
    echo '<h4 class="mostrar"> Ver mais </h4><br>'; 
  }
  ?>

  </div>
  <div id="pesquisas" class="texto">
    <form action="showProduct.php" method="get" style="width: 300px">
    Pesquisar Produtos ou Serviços por Código: <br>
    <input type = "number" name = "ProductCode" maxlength = "30" />
    <input type="submit"/>
    </form><br>
  </div>  

  </div>  
</body>