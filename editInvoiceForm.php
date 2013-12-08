<?php 
	include 'header.php';

	echo '<div id="conteudo">
		  <div class="texto">';

	if ($_SESSION['permission'] == "reader")
	{
		echo 'Precisa de ter permissões de writer para editar documentos!';
		exit();
	}

	$db = new PDO('sqlite:database/documents.db');
  	$invoices = $db->query('SELECT * FROM Invoice WHERE InvoiceNo = ?');	
  	$invoices->execute(array($_GET['InvoiceNo']));
  	$invoice = $invoices->fetch();
	
	$idGets = $db->query('SELECT id FROM Invoice WHERE InvoiceNo = ?');
	$idGets->execute(array($_GET['InvoiceNo']));
  	$idGet = $idGets->fetch();
		
	$lines = $db->query('SELECT * FROM Line WHERE idInvoice = ?');
	$lines->execute(array($idGet[0]));
	$line = $lines->fetchAll();
	
	echo '<form action="editInvoice.php" method="POST">
			<h2>Editar Fatura:</h2><br>
			Numero de Fatura: <br><input type="text" name="InvoiceNo" value='. $invoice['InvoiceNo'] .' readonly><br><br>
			Data da Fatura: <br><input type="date" name="InvoiceDate" value="' . $invoice['InvoiceDate'] .'"><br><br>
			ID do Cliente: <br><input type="number" name="CustomerID" value=' . $invoice['CustomerID'] .'><br><br><br>';
			$LineNumber = array();
			foreach($line as $row)
			{				
				array_push($LineNumber, $row['LineNumber']);
				echo '<br>
					  Numero da Linha: <br><input type="text" name="LineNumber" value='. $row['LineNumber'] .' readonly><br><br>
					  ID do Produto: <br><input type="number" name="ProductCode[]" value=' . $row['ProductCode'] .'><br><br>
					  Quantidade Vendida: <br><input type="number" name="Quantity[]" value=' . $row['Quantity'] .'><br><br>
					  Pre&ccedil;o Unit&aacute;rio: <br><input type="number" name="UnitPrice[]" value=' . $row['UnitPrice'] .'><br><br>					  
					  Tipo de Taxa: <br><input type="text" name="TaxType[]" value=' . $row['TaxType'] .'><br><br>
					  Percentagem da Taxa: <br><input type="text" name="TaxPercentage[]" value=' . $row['TaxPercentage'] .'>%<br><br><br>';
			}						
	echo '<br>Total de Imposto: <br><input type="number" name="TaxPayable" value=' . $invoice['TaxPayable'] .'><br><br>
			Total sem Imposto: <br><input type="number" name="NetTotal" value=' . $invoice['NetTotal'] .'><br><br>
			<input type="submit" value="Editar Fatura">
		</form>';

		?>
	</div>
</div>		