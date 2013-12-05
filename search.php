<?php
	include 'header.php';

	echo '<div id="conteudo">';
	echo '<div class="texto">';
	echo '<div id ="pesquisas_avancadas">';

	echo '<h2> Faturas: </h2> <br>'; 
	include "searchInvoicesByField.php";		
	echo '<br>';
	echo '<h2> Clientes: </h2> <br>';
	include "searchCustomersByField.php";
	echo '<br>';
	echo '<h2> Produtos: </h2> <br>';
	include "searchProductsByField.php";
	echo '<br></div>';
?>
	</div>
	</div>
</body>
</html>
