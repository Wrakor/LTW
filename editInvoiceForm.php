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
			Data da Fatura: <br><input type="date" name="InvoiceDatea" value="' . $invoice['InvoiceDate'] .'"><br><br>
			ID do Cliente: <br><input type="number" name="CustomerID" value=' . $invoice['CustomerID'] .'><br><br><br>';

			foreach($line as $row)
			{
				echo '<br>
					  ID do Produto: <br><input type="number" name="ProductCode" value=' . $row['ProductCode'] .'><br><br>
					  Quantidade Vendida: <br><input type="number" name="Quantity" value=' . $row['Quantity'] .'><br><br>
					  Pre&ccedil;o Unit&aacute;rio: <br><input type="number" name="UnitPrice" value=' . $row['UnitPrice'] .'><br><br>
					  Total: <br><input type="number" name="CreditAmount" value=' . $row['CreditAmount'] .'><br><br>
					  Tipo de Taxa: <br><input type="text" name="TaxType" value=' . $row['TaxType'] .'><br><br>
					  Percentagem da Taxa: <br><input type="text" name="TaxPercentage" value=' . $row['TaxPercentage'] .'>%<br><br><br>';
			}						
	echo '<br>Total de Imposto: <br><input type="number" name="TaxPayable" value=' . $invoice['TaxPayable'] .'><br><br>
			Total sem Imposto: <br><input type="number" name="NetTotal" value=' . $invoice['NetTotal'] .'><br><br>
			Total : <br><input type="number" name="GrossTotal" value=' . $invoice['GrossTotal'] .'><br><br>
			<input type="submit" value="Editar Fatura">
		</form>';

		?>
	</div>
</div>		