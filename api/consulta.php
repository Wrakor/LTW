<!DOCTYPE html>

<head>
	<title> Sistema de faturação online </title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="../style.css">
	<style type="text/css">
    .text{display:none;
        padding-left: 15px;}
   
     p{ display:none;} 
   
    .mostrar {cursor: pointer; padding-left: 15px; text-decoration: underline;}
    .btab{padding-left: 15px;}
    .btab2{padding-left: 30px;}
    .btab3{padding-left: 45px;}
	</style>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
	</script>
	<script>
		$(document).ready(function(){
 	 		$(".mostrar").click(function(e) {
      			$(this).prev('.text').slideToggle("slow");
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
  echo '<div id="conteudo">';
	echo '<div id="documentos">';

	$db = new PDO('sqlite:documentos.db');
 	$invoices = $db->query('SELECT * FROM Invoice');
 	$invoices_lines = $db->query('SELECT * FROM Line');
  $products = $db->query('SELECT * FROM Product');

 	$data = $invoices->fetchAll();
 	$data2 = $invoices_lines->fetchAll();
  $data3 = $products->fetchAll();

  echo '<h2> Faturas: </h2>';
 	foreach ($data as $row) 
  {
  	echo '<h3 class="btab">' . '- ' . $row['InvoiceNo'] . '</h3>'; 
  	
  	echo '<div class="btab">' . '<b>Data: </b>' .$row['InvoiceDate'] . '<br>';  
  	echo '<b>ID de Cliente: </b>'  . $row['CustomerID'] . '<br></div>';  
    echo '<div class="text">';
    echo '<b>Linhas de Produtos:</b><br>';
   
  
  	foreach ($data2 as $row2)
  	{
  		if ($row['id'] == $row2['idInvoice'])
  		{
  			echo '<b class="btab">- Linha nº </b>'  . $row2['LineNumber'] . '<br>';  
	   	 	echo '<b class="btab2">Código do Produto/Serviço:</b>'  . $row2['ProductCode'] . '<br>';  
	    	echo '<b class="btab2">Nº de unidades vendidas:</b>'  . $row2['Quantity'] . '<br>';  
	    	echo '<b class="btab2">Preço unitário:</b>'  . $row2['UnitPrice'] . '<br>';  
	    	echo '<b class="btab2">Total:</b>'  . $row2['CreditAmount'] . '<br>'; 

	    	echo '<b class="btab2">Taxas:</b><br>';  
	    	echo '<b class="btab3">Tipo de Taxa:</b>'  . $row2['TaxType'] . '<br>';  
	    	echo '<b class="btab3">Percentagem da Taxa:</b>'  . $row2['TaxPercentage'] . '%<br>';  
  		}
  	}

  	echo '<b>Total de Imposto: </b>'  . $row['TaxPayable'] . '<br>';  
   	echo '<b>Total sem Imposto: </b>'  . $row['NetTotal'] . '<br>';  
   	echo '<b>Total: </b>'  . $row['GrossTotal'] . '<br>';
    echo '</div>'; 
    echo '<h4 class="mostrar"> Ver mais </h4><br>';    
   }
    
  echo '<h2> Produtos e Serviços: </h2>';
  foreach ($data3 as $row) 
  {  
    echo '<h3 class="btab">' . '- ' . $row['ProductCode'] . '</h3>'; 

    echo '<div class="btab">' . '<b>Descrição: </b>' . $row['ProductDescription'] . '<br></div>';  

    echo '<div class="text"> <b>Preço Unitário: </b>' . $row['UnitPrice'] . '</br>'; 
    echo '<b>Unidade de medida: </b>' . $row['UnitOfMeasure'] . '</br></div>'; 
    echo '<h4 class="mostrar"> Ver mais </h4><br>'; 
  }


  	?>
	</div>
	</div>
</body>