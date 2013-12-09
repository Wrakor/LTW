<?php include 'header.php';  ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="javascript/checkDocuments.js"></script>

<?php 

	$db = new PDO('sqlite:database/documents.db');
 	$invoices = $db->query('SELECT * FROM Invoice');
 	$invoices_lines = $db->query('SELECT * FROM Line');  

 	$data = $invoices->fetchAll();
 	$data2 = $invoices_lines->fetchAll();
 
  
	echo '<div id="conteudo">';
	echo '<div class="texto">';
	echo '<h1> Faturas: </h1><br>';

	foreach ($data as $row) 
	{
		$path = 'showInvoice.php?InvoiceNo=' . $row['InvoiceNo']; 
		echo '<a href=' . $path . '> '; 

		echo '<h3 class="btab">' . '- ' . $row['InvoiceNo'] . '</h3><a>'; 
		
		echo '<div class="btab"><table border="1"><tr> <td>' . '<b>Data: </b></td> <td>' .$row['InvoiceDate'] . '</td></tr><br>';  
		echo '<tr><td><b>ID de Cliente: </b></td><td>'  . $row['CustomerID'] . '</td></tr></table><br></div>';  
		echo '<div class="hiddenText">';
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
?>
</div>
	  <div id="pesquisas" class="texto">
	    <form action="showInvoice.php" method="get">
	    Pesquisar Faturas por ID: <br>
	    <input type = "text" name = "InvoiceNo" maxlength = "30" />
	    <input type="submit"/>
	    </form><br>

	    <form action="importInvoices.php" method="post">
	    Importar Faturas de outras BDs: <br>
	    URL: <br> <input type = "text" name = "url" maxlength = "300" /><br>
	    ID: <br><input type = "text" name = "InvoiceNo" maxlength = "30" /><br>
	    <input type="submit"/>
	    </form><br>

	    <form action="importFromXML.php" method="post">
	    Importar Faturas em XML: <br>
	    URL: <br> <input type = "text" name = "url" maxlength = "300" /><br>
	    <input type="submit"/>
	    </form>
</div>  
	
</div>  
</body>