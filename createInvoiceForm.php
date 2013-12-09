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
			$('<br><label for="ProductCode">ID do Produto</label><br><input type="text" name="ProductCode[]" value=""><br><br>').appendTo(scntDiv);
			j++;
			$('<label for="Quantity">Quantidade Vendida</label><br><input type="text" name="Quantity[]" value=""><br><br>').appendTo(scntDiv);
			j++;
			$('<label for="UnitPrice">Pre&ccedil;o Unit&aacute;rio</label><br><input type="text" name="UnitPrice[]" value=""><br><br>').appendTo(scntDiv);
			j++;
			$('<label for="TaxType">Tipo de Taxa</label><br><input type="text" name="TaxType[]" value=""><br><br>').appendTo(scntDiv);
			j++;
			$('<label for="TaxPercentage">Percentagem da Taxa</label><br><input type="text" name="TaxPercentage[]" value=""><br><br>').appendTo(scntDiv);
			$('</p>').appendTo(scntDiv);
			$('<h4><a href="#" id="remLine">	Remove Line  </a></h4>').appendTo(scntDiv);				
			$('<h4><a style="padding-left: 10px" href="#" id="addLine">  Add Line</a></h4>').appendTo(scntDiv);								
				
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
			<h2>Adicionar Fatura:</h2><br>		
			<label for="InvoiceDate">Data da Fatura</label><br><input type="date" name="InvoiceDate" value=""><br><br>
			<label for="CustomerID">ID do Cliente</label><br><input type="text" name="CustomerID" value=""><br><br>
			<br>
			<div id="line">			
				<label for="ProductCode">ID do Produto</label><br><input type="number" name="ProductCode[]" value=""><br><br>
				<label for="Quantity">Quantidade Vendida</label><br><input type="number" name="Quantity[]" value=""><br><br>
				<label for="UnitPrice">Pre&ccedil;o Unit&aacute;rio</label><br><input type="number" name="UnitPrice[]" value=""><br><br>
				<label for="TaxType">Tipo de Taxa</label><br><input type="text" name="TaxType[]" value=""><br><br>
				<label for="TaxPercentage">Percentagem da Taxa</label><br><input type="text" name="TaxPercentage[]" value=""><br><br>	
				<h4><a href="#" id="addLine">Add Line</a></h4>			
			</div>
			<br>
			<label for="TaxPayable">Total de Imposto</label><br><input type="number" name="TaxPayable" value=""><br><br>
			<label for="NetTotal">Total sem Imposto</label><br><input type="number" name="NetTotal" value=""><br><br>
			<br>			
			<input type="submit" value="Criar novo">
		</form>
	</div>
</div>	
