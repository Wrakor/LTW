<?php 
		//$numFat = $_GET['InvoiceNo'];
		$numFat = 20355; 
			
		$InvoiceNotFound = json_encode(array('error'=> array('code' => 404,'reason'=>'Invoice not found')));
		$url = "http://localhost/LTW/api/getInvoice.php?InvoiceNo=" . $numFat;

		$json = file_get_contents($url,TRUE);
	/*	echo $json;
		echo var_dump(json_decode($json));*/

		$jsonDecoded = json_decode($json,true);

		//echo $jsonDecoded['InvoiceNo'];

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

			//Todos os valores de todas as linhas
	/*		foreach ($lineArray as $line) {
				echo var_dump($line);
					$lineTemp = array();
					foreach ($line as $key => $value) {	
						array_push($lineTemp,$value);
					}
				array_push($lines,$lineTemp);
			}
		}*/

		$path = '?InvoiceNo=' . $jsonDecoded['InvoiceNo'] . '&InvoiceDate=' . $jsonDecoded['InvoiceDate'] . '&LineN=' . count($lineArray);

		foreach ($lineArray as $line) {
			$taxes = $line['Tax'];
			$path .= '&LineNumber=' . $line['LineNumber'] . '&ProductCode=' . $line['ProductCode'] . '&Quantity=' . $line['Quantity'] . '&UnitPrice=' . $line['UnitPrice'] . '&CreditAmount=' . $line['CreditAmount'] . 
			'&TaxType=' . $taxes['TaxType'] . '&TaxPercentage=' . $taxes['TaxPercentage'];
		}

		$path .= '&TaxPayable=' . $jsonDecoded['DocumentTotals']['TaxPayable'] . '&NetTotal=' . $jsonDecoded['DocumentTotals']['NetTotal'] .'&GrossTotal=' . $jsonDecoded['DocumentTotals']['GrossTotal'];

		echo $path;
		//header('Location: http://www.google.pt');
	}
?>		
