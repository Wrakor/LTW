<?php 
		$url = $_POST['url'] . '?InvoiceNo=' . $_POST['InvoiceNo'];
			
		$InvoiceNotFound = json_encode(array('error'=> array('code' => 404,'reason'=>'Invoice not found')));
		$json = file_get_contents($url,TRUE);


		$jsonDecoded = json_decode($json,true);


		if($json == $InvoiceNotFound) {
			  	echo $InvoiceNotFound;
		}
		else {
			$InvoiceDate = $jsonDecoded['InvoiceDate'];
			$CustomerID = $jsonDecoded['CustomerID'];
			$InvoiceNo = $jsonDecoded['InvoiceNo'];
			$lineArray = $jsonDecoded['Line'];
			$TaxPayable = $jsonDecoded['DocumentTotals']['TaxPayable'];
			$NetTotal = $jsonDecoded['DocumentTotals']['NetTotal'];
			$GrossTotal = $jsonDecoded['DocumentTotals']['GrossTotal'];
			$lines = array();



		$path = '?InvoiceDate=' . $jsonDecoded['InvoiceDate'] . '&CustomerID=' . $CustomerID;


		foreach ($lineArray as $line) {
			$taxes = $line['Tax'];
			$path .= '&ProductCode[]=' . $line['ProductCode'] . '&Quantity[]=' . $line['Quantity'] . '&UnitPrice[]=' . $line['UnitPrice'] . 
			'&TaxType[]=' . $taxes['TaxType'] . '&TaxPercentage[]=' . $taxes['TaxPercentage'];
		}

		$path .= '&TaxPayable=' . $jsonDecoded['DocumentTotals']['TaxPayable'] . '&NetTotal=' . $jsonDecoded['DocumentTotals']['NetTotal'];

        $redirect_url = "createInvoice.php" . $path; 
		header("Location: " . $redirect_url);
		
	}
?>		
