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

	$db = new PDO('sqlite:database/documents.db');
 	$invoices = $db->query('SELECT * FROM Invoice');
 	$invoices_lines = $db->query('SELECT * FROM Line');
  $products = $db->query('SELECT * FROM Product');
  $customers = $db->query('SELECT * FROM Customer');

 	$data = $invoices->fetchAll();
 	$data2 = $invoices_lines->fetchAll();
  $data3 = $products->fetchAll();
  $data4 = $customers->fetchAll();
  
  echo '<div id="conteudo">';
  echo '<div class="documentos" style="border-right: 1px solid black;">';
  echo '<h1> Listagem sumarizada de Documentos </h1><br>';

  echo '<h2> Faturas: </h2>';

 	foreach ($data as $row) 
  {
    $path = 'showInvoice.php?InvoiceNo=' . $row['InvoiceNo']; 
    echo '<a href=' . $path . '> '; 
  
  	echo '<h3 class="btab">' . '- ' . $row['InvoiceNo'] . '</h3><a>'; 
  	
  	echo '<div class="btab"><table border="1"><tr> <td>' . '<b>Data: </b></td> <td>' .$row['InvoiceDate'] . '</td></tr><br>';  
  	echo '<tr><td><b>ID de Cliente: </b></td><td>'  . $row['CustomerID'] . '</td></tr></table><br></div>';  
    echo '<div class="text">';
    echo '<table border="1"> <tr> <td colspan="2"><b>Linhas de Produtos:</b><br></td></tr>';   
  
  	foreach ($data2 as $row2)
  	{
  		if ($row['id'] == $row2['idInvoice'])
  		{
  			echo '<tr><td colspan="7"><b class="btab">- Linha nº </b>'  . $row2['LineNumber'] . '</td></tr>';  
	   	 	echo '<tr><td><b class="btab2">Código do Produto/Serviço:</b></td><td>'  . $row2['ProductCode'] . '</td></tr>';  
	    	echo '<tr><td><b class="btab2">Nº de unidades vendidas:</b></td><td>'  . $row2['Quantity'] . '</tr></td>';  
	    	echo '<tr><td><b class="btab2">Preço unitário:</b></td><td>'  . $row2['UnitPrice'] . '</tr></td>';  
	    	echo '<tr><td><b class="btab2">Total:</b></td><td>'  . $row2['CreditAmount'] . '</tr></td>'; 

	    	echo '<tr><td colspan="2"><b class="btab2">Taxas:</b></tr>';  
	    	echo '<tr><td><b class="btab3">Tipo de Taxa:</b></td><td>'  . $row2['TaxType'] . '</tr></td>';  
	    	echo '<tr><td><b class="btab3">Percentagem da Taxa:</b></td><td>'  . $row2['TaxPercentage'] . '%</tr></td>';  
  		}
  	}

  	echo '<tr><td><b>Total de Imposto: </b></td><td>'  . $row['TaxPayable'] . '<br></tr></td>';  
   	echo '<tr><td><b>Total sem Imposto: </b></td><td>'  . $row['NetTotal'] . '<br></tr></td>';  
   	echo '<tr><td><b>Total: </b></td><td>'  . $row['GrossTotal'] . '<br></tr></td></table>';
    echo '</div>'; 
    echo '<h4 class="mostrar"> Ver mais </h4><br>';    
   }
    
  echo '<h2> Produtos e Serviços: </h2>';

  foreach ($data3 as $row) 
  {  
    $path = 'showProduct.php?ProductCode=' . $row['ProductCode']; 
    echo '<a href=' . $path . '> ';
    echo '<h3 class="btab"></td><td>' . '- ' . $row['ProductCode'] . '</h3></a>'; 

    echo '<div class="btab"><table border="1"> <tr><td>' . '<b>Descrição: </b>' . $row['ProductDescription'] . '</td></tr></table><br></div>';  
    echo '<div class="text"><table border="1"> <tr><td><b>Preço Unitário: </b></td><td>' . $row['UnitPrice'] . '</tr></td>'; 
    echo '<tr><td><b>Unidade de medida: </b></td><td>' . $row['UnitOfMeasure'] . '</tr></td></table>';    
    echo '</div>'; 
    echo '<h4 class="mostrar"> Ver mais </h4><br>'; 
  }

  echo '<h2> Clientes : </h2>';

  foreach ($data4 as $row) 
  {  
    $path = 'showCustomer.php?CustomerID=' . $row['CustomerID']; 
    echo '<a href=' . $path . '>';
    echo '<h3 class="btab">' . '- ' . $row['CustomerID'] . '</h3></a>'; 

    echo '<div class="btab"><table border="1"><tr><td>' . '<b>Número de Contribuinte: </b></td><td>' .$row['CustomerTaxID'] . '</tr></td>';  
    echo '<tr><td><b> Nome do Cliente: </b></td><td>'  . $row['CompanyName'] . '</tr></td></table></div>';  

    echo '<div class="text"><table border="1">';
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
  <div id="pesquisas" class="documentos">
    <form action="showInvoice.php" method="get">
    Pesquisar Faturas por ID: <br>
    <input type = "text" name = "InvoiceNo" maxlength = "30" />
    <input type="submit"/>
    </form><br>

    <form action="showProduct.php" method="get">
    Pesquisar Produtos ou Serviços por Código: <br>
    <input type = "number" name = "ProductCode" maxlength = "30" />
    <input type="submit"/>
    </form><br>

    <form action="showCustomer.php" method="get">
    Pesquisar Clientes por ID: <br>
    <input type = "number" name = "CustomerID" maxlength = "30" />
    <input type="submit"/>
    </form><br>
  </div>
  
  </div>
  
</body>