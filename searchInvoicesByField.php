<!DOCTYPE html>

<HTML>
	<HEAD>	
		<title> Sistema de faturação online </title>
		<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<link rel="stylesheet" href="../style.css">
		<script language="Javascript" type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script type='text/javascript'>
		$(document).ready(function()
		{
			$("input[name='op']:radio").click(function()
			{
				$value1 = $("input[name='value1']");
				$var = $(this).val();
																		
				if ($var ==  'range')
				{
					if($("input[name='value2']").size() <= 0)
					{
						$value1.after('<input type="text" name="value2" value="">');
						$("input[name='value2']").attr("type",$value1.attr("type"));
					}
				}			
				else
				{
					$("input[name='value2']").remove();
				}

				if ($var == 'contains')
				{
					$("input[name='value1']").attr("type","text");
				}
			});
			
			$("input[name='field']:radio").click(function()
			{
				$value1 = $("input[name='value1']");
				$var = $(this).val();
																		
				if ($var ==  'GrossTotal')
				{
					$("input[name='value1']").attr("type","number");
					$("input[name='value2']").attr("type","number");
					$("input[name='value1']").attr("step","any");
					$("input[name='value2']").attr("step","any");
				}			
				else if($var ==  'InvoiceDate')
					{
						$("input[name='value1']").attr("type","date");
						$("input[name='value2']").attr("type","date");
					}
					else
					{
						$("input[name='value1']").attr("type","text");
						$("input[name='value2']").attr("type","text");
					}
									
				if ($var == 'CompanyName')
				{
					$("input[name='op']:radio[value=min]").remove();
					$("input[name='op']:radio[value=max]").remove();
					$("label[for='min']").remove();
					$("label[for='max']").remove();
				}
				else
				{
					$value1 = $("label[for='contains']");
					
					if ($("input[name='op']:radio[value=min]").size() <= 0 )
					{
						$value1.after('<input type="radio" name="op" value="max"> <label for="max">Max</label>');
						$value1.after('<input type="radio" name="op" value="min"> <label for="min">Min</label>');																		
					}
					
				}
			});
		});
		</script>
	</HEAD>

	<BODY>
	<div id="conteudo">
		<form action="showInvoiceSearch.php" method="GET">
			Atributos da pesquisa: <br>
			<input type="radio" name="op" value="range"><label for="range">Range</label>
			<input type="radio" name="op" value="equal"><label for="equal">Equal</label>
			<input type="radio" name="op" value="contains"><label for="contains">Contains</label>
			<input type="radio" name="op" value="min"> <label for="min">Min</label>
			<input type="radio" name="op" value="max"> <label for="max">Max</label>
			<br><br>
			Campo: <br>
			<input type="radio" name="field" value="InvoiceNo"><label for="InvoiceNo">Nr da fatura</label>
		    <input type="radio" name="field" value="InvoiceDate"><label for="InvoiceDate">Data da fatura</label>
		    <input type="radio" name="field" value="GrossTotal"><label for="GrossTotal">Total Bruto</label>
		    <input type="radio" name="field" value="CompanyName"><label for="CompanyName">Nome da Empresa</label>
		    <br><br>
			Valor: <br>
			<input type="text" name="value1" value="">
			<input type="text" name="value2" value="">
						
			<input type="submit">
			<br><br>
		</form>		
	<div>	
	</BODY>		
</HTML>