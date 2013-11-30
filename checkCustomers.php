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
  $customers = $db->query('SELECT * FROM Customer');
  $data = $customers->fetchAll();

  echo '<div id="conteudo">';
  echo '<div class="texto">';
  echo '<h1> Clientes: </h1><br>';

  foreach ($data as $row) 
  {  
    $path = 'showCustomer.php?CustomerID=' . $row['CustomerID']; 
    echo '<a href=' . $path . '>';
    echo '<h3 class="btab">' . '- ' . $row['CustomerID'] . '</h3></a>'; 

    echo '<div class="btab"><table border="1"><tr><td>' . '<b>Número de Contribuinte: </b></td><td>' .$row['CustomerTaxID'] . '</tr></td>';  
    echo '<tr><td><b> Nome do Cliente: </b></td><td>'  . $row['CompanyName'] . '</tr></td></table></div>';  

    echo '<div class="hiddenText"><table border="1">';
    echo '<tr><td><b>Dados de Morada: </b><br></tr></td>';
    echo '<tr><td><b class="btab"> Rua ou Avenida: </b></td><td>' . $row['AdressDetail'] . '</tr></td>';
    echo '<tr><td><b class="btab"> Cidade: </b></td><td>' . $row['City'] . '</tr></td>';
    echo '<tr><td><b class="btab"> Código Postal: </b></td><td>' . $row['PostalCode'] . '</tr></td>';
    echo '<tr><td><b class="btab"> Código do País: </b></td><td>' . $row['Country'] . '</tr></td>';
    echo '<tr><td><b>E-mail: </b></td><td>' . $row['Email'] . '</tr></td></table>';

    echo '</div>';
    echo '<h4 class="mostrar"> Ver mais </h4><br>'; 
  }  
  ?>
  </div>

  <div id="pesquisas" class="texto">
    <form action="showCustomer.php" method="get">
    Pesquisar Clientes por ID: <br>
    <input type = "number" name = "CustomerID" maxlength = "30" />
    <input type="submit"/>
    </form><br>
  </div>  
  
 </div>  
</body>