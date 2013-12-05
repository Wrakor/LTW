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
			else
			{
				$("input[name='value1']").attr("type","text");
				$("input[name='value2']").attr("type","text");
			}
								
			if ($var == 'ProductDescription')
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
<div style="min-width: 1000px;">
	<form action="showProductSearch.php" method="GET">
		Atributos da pesquisa: <br>
		<input type="radio" name="op" value="range"><label for="range">Range</label>
		<input type="radio" name="op" value="equal"><label for="equal">Equal</label>
		<input type="radio" name="op" value="contains"><label for="contains">Contains</label>
		<input type="radio" name="op" value="min"> <label for="min">Min</label>
		<input type="radio" name="op" value="max"> <label for="max">Max</label>
		<br><br>
		Campo: <br>
		<input type="radio" name="field" value="ProductCode"><label for="ProductCode">Codigo do Produto</label>
	    <input type="radio" name="field" value="ProductDescription"><label for="ProductDescription">Nome do Produto</label>		    
	   <br><br>
		Valor: <br><input type="text" name="value1" value="">
			   <input type="text" name="value2" value="">
		
		<input type="submit">
	</form>		
<div>	