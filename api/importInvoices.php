<?php 
		//$numFat = $_GET['InvoiceNo'];
		$numFat = 20355; 
			
		$InvoiceNotFound = json_encode(array('error'=> array('code' => 404,'reason'=>'Invoice not found')));
		$url = "http://gnomo.fe.up.pt/~ei09138/LTW/api/getInvoice.php?InvoiceNo=" . $numFat;
		$json = file_get_contents($url,TRUE);


		$jsonDecoded = json_decode($json,true);


		if($json == $InvoiceNotFound) {
			  	echo $InvoiceNotFound;
		}
		else {
		   	$InvoiceNo = $jsonDecoded['InvoiceNo'];
			$InvoiceDate = $jsonDecoded['InvoiceDate'];
			$CustomerID = $jsonDecoded['CustomerID'];
			$InvoiceNo = $jsonDecoded['InvoiceNo'];
			$lineArray = $jsonDecoded['Line'];
			$TaxPayable = $jsonDecoded['DocumentTotals']['TaxPayable'];
			$NetTotal = $jsonDecoded['DocumentTotals']['NetTotal'];
			$GrossTotal = $jsonDecoded['DocumentTotals']['GrossTotal'];
			$lines = array();


		$path = '?InvoiceNo=' . $jsonDecoded['InvoiceNo'] . '&InvoiceDate=' . $jsonDecoded['InvoiceDate'] . '&LineN=' . count($lineArray);

		foreach ($lineArray as $line) {
			$taxes = $line['Tax'];
			$path .= '&LineNumber=' . $line['LineNumber'] . '&ProductCode=' . $line['ProductCode'] . '&Quantity=' . $line['Quantity'] . '&UnitPrice=' . $line['UnitPrice'] . '&CreditAmount=' . $line['CreditAmount'] . 
			'&TaxType=' . $taxes['TaxType'] . '&TaxPercentage=' . $taxes['TaxPercentage'];
		}

		$path .= '&TaxPayable=' . $jsonDecoded['DocumentTotals']['TaxPayable'] . '&NetTotal=' . $jsonDecoded['DocumentTotals']['NetTotal'] .'&GrossTotal=' . $jsonDecoded['DocumentTotals']['GrossTotal'];

		echo $path;

        $redirect_url = "addInvoice.php" . $path; 
		header("Location: " . $redirect_url);
		
	}
?>		
