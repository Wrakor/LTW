<!DOCTYPE html>

<HTML>
	<HEAD>	
		<title> Sistema de faturação online </title>
		<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<link rel="stylesheet" href="../style.css">	<script language="Javascript" type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script type='text/javascript'>
		$(document).ready(function()
		{
			var i = 1;
			 $('#addProd').live('click', function() 
			 {				
				$()appendTo(this);
				i++;
				return false;
			 }
			 $('#remProd').live('click', function() 
			 {
				if( i > 2)
				{
					$(this).parent'p').remove();
					i--;
				}
				retur false;
			 }
		}
		</script>
		
	</HEAD>

	<BODY>
	<div id="conteudo">
		<form action="returnInvoice.php" method="POST">			
			Invoice: 
			<br>
			<input type="text" name="value1" value=""><label for="InvoiceNo">Número da Fatura</label>
			<input type="text" name="value2" value=""><label for="InvoiceDate">Data da Fatura</label>
			<input type="text" name="value3" value=""><label for="CustomerID">ID do Cliente</label>
			<br>
			<input type="text" name="value4" value=""><label for="ProductCode">ID do Produto</label>
			<input type="text" name="value5" value=""><label for="Quantity">Quantidade Vendida</label>
			<input type="text" name="value6" value=""><label for="UnitPrice">Preço Unitário</label>			
			<input type="text" name="value7" value=""><label for="TaxType">Tipo de Taxa</label>
			<input type="text" name="value8" value=""><label for="TaxPercentage">Percentagem da Taxa</label>
			<a href="#" id="addProd">Acrescentar outro produto </a></h2>
			<br>
			<input type="text" name="value9" value=""><label for="TaxPayable">Total de Imposto</label>
			<input type="text" name="value10" value=""><label for="NetTotal">Total sem Imposto</label>
			<br>			
			<input type="submit">
		</form>		
	<div>	
	</BODY>		
</HTML>