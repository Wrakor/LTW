<!DOCTYPE html>

<?php 
	include 'header.php';

	echo '<div id="conteudo">
		  <div class="texto">';

	if ($_SESSION['permission'] == "reader")
	{
		echo ' Precisa de ter permissões de writer para criar faturas!';
		exit();
	}
?>

	<script language="Javascript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
	<script>
	$(document).ready(function() 
	{
		var scntDiv = $('#line');
		var i = $('#line label').size() + 1;
		var j = 10;
		$('#addLine').live('click', function() 
		{
			$('#addLine').remove();
			if (i > 2)
				$('#remLine').remove();
			j++;
			$('<p>').appendTo(scntDiv);
			$('<label for="ProductCode">ID do Produto</label><input type="text" name="ProductCode[]" value=""><br>').appendTo(scntDiv);
			j++;
			$('<label for="Quantity">Quantidade Vendida</label><input type="text" name="Quantity[]" value=""><br>').appendTo(scntDiv);
			j++;
			$('<label for="UnitPrice">Preço Unitário</label><input type="text" name="UnitPrice[]" value=""><br>').appendTo(scntDiv);
			j++;
			$('<label for="TaxType">Tipo de Taxa</label><input type="text" name="TaxType[]" value=""><br>').appendTo(scntDiv);
			j++;
			$('<label for="TaxPercentage">Percentagem da Taxa</label><input type="text" name="TaxPercentage[]" value=""><br>').appendTo(scntDiv);
			$('</p>').appendTo(scntDiv);
			$('<a href="#" id="remLine">	Remove Line  </a>').appendTo(scntDiv);				
			$('<a style="padding-left: 10px" href="#" id="addLine">  Add Line</a><br>').appendTo(scntDiv);								
				
			i++;
			return false;
		});
					
		$('#remLine').live('click', function() 
		{ 				
			if( i > 2 ) 
			{					
				$(this).prev('p').remove();
				i--;
				j = j - 4;
			}
			return false;
		});
	});	
	</script>		

		<form id="form" action="createInvoice.php" method="GET">			
			Invoice: 
			<br>			
			<label for="InvoiceDate">Data da Fatura</label><input type="date" name="InvoiceDate" value=""><br>
			<label for="CustomerID">ID do Cliente</label><input type="text" name="CustomerID" value=""><br>
			<br>
			<div id="line">			
				<label for="ProductCode">ID do Produto</label><input type="text" name="ProductCode[]" value=""><br>
				<label for="Quantity">Quantidade Vendida</label><input type="text" name="Quantity[]" value=""><br>
				<label for="UnitPrice">Preço Unitário</label><input type="text" name="UnitPrice[]" value=""><br>
				<label for="TaxType">Tipo de Taxa</label><input type="text" name="TaxType[]" value=""><br>
				<label for="TaxPercentage">Percentagem da Taxa</label><input type="text" name="TaxPercentage[]" value=""><br>	
				<h4><a href="#" id="addLine">Add Line</a></h4>			
			</div>
			<br>
			<label for="TaxPayable">Total de Imposto</label><input type="text" name="TaxPayable" value=""><br>
			<label for="NetTotal">Total sem Imposto</label><input type="text" name="NetTotal" value=""><br>
			<br>			
			<input type="submit">
		</form>
	</div>
</div>	
