<?php

$path = ""; 
header('Content-Type: text/html; charset=utf-8');
if(file_exists("teste.xml")) { 
	$xml=simplexml_load_file("teste.xml");

	//print_r($xml);

	foreach ($xml->children() as $child) {
		if($child->getName()  == 'MasterFiles') {
			foreach ($child->children() as $child1) {
				if($child1->getName() == 'Customer') {
					foreach ($child1->children() as $child2) {
						if( $child2->getName() == 'CustomerID' ) {
							$CustomerID = $child2;
							$path = '?CustomerID=' . $CustomerID;
						}
						if( $child2->getName() == 'CustomerTaxID' ) {
							$CustomerTaxID = $child2;
							$path .= '&CustomerTaxID=' . $CustomerTaxID;
						}
						if( $child2->getName() == 'CompanyName' ) {
							$CustomerName = $child2;
							$path .= '&CustomerName=' . $CustomerName;
						}
						if( $child2->getName() == 'BillingAddress' ) {
							$CustomerAddressDetail = $child2->AddressDetail;
							$path .= '&CustomerAddressDetail=' . $CustomerAddressDetail;
							$CustomerCity = $child2->City;
							$path .= '&CustomerCity=' . $CustomerCity;
							$CustomerPostalCode = $child2->PostalCode;
							$path .= '&CustomerPostalCode=' . $CustomerPostalCode;
							$CustomerCountry = $child2->Country;
							$path .= '&CustomerCountry=' . $CustomerCountry;
						}
						if( $child2->getName() == 'Email' ) {
							$CustomerEmail = $child2;
							$path .= '&CustomerEmail=' . $CustomerEmail;
						}
					}
				}
			}
		}
	}
	

	foreach ($xml->SourceDocuments->children() as $child) {
		foreach ($child->children() as $child2) {
			if($child2->getName() == 'Invoice') {
				foreach ($child2->children() as $child3) {

					 if($child3->getName() == 'InvoiceNo') {
					 	$InvoiceNo = $child3;
					 	$path .= '&InvoiceNo=' . $InvoiceNo;
					 }

					 if($child3->getName() == 'InvoiceDate') {
					 	$InvoiceDate = $child3;
					 	$path .= '&InvoiceDate=' . $InvoiceDate;
					 }

					 if($child3->getName() == 'CustomerID') {
					 	$InvoiceCustomerID = $child3;
					 	$path .= '&InvoiceCustomerID=' . $InvoiceCustomerID;
					 }

					  if($child3->getName() == 'Line') {
					 	foreach ($child3->children() as $child4) {
					 		if($child4->getName() == 'LineNumber') {
					 			$LineNumber = $child4;
					 			$path .= '&LineNumber=' . $LineNumber;
					 		}
					 		if($child4->getName() == 'ProductCode') {
					 			$ProductCode = $child4;
					 			$path .= '&ProductCode=' . $ProductCode;
					 		}
					 		if($child4->getName() == 'ProductDescription') {
					 			$ProductDescription = $child4;
					 			$path .= '&ProductDescription=' . $ProductDescription;
					 		}
					 		if($child4->getName() == 'Quantity') {
					 			$Quantity = $child4;
					 			$path .= '&Quantity=' . $Quantity;
					 		}
					 		if($child4->getName() == 'UnitOfMeasure') {
					 			$UnitOfMeasure = $child4;
					 			$path .= '&UnitOfMeasure=' . $UnitOfMeasure;
					 		}
					 		if($child4->getName() == 'UnitPrice') {
					 			$UnitPrice = $child4;
					 			$path .= '&UnitPrice=' . $UnitPrice;
					 		}	
					 		if($child4->getName() == 'CreditAmount') {
					 			$CreditAmount = $child4;
					 			$path .= '&CreditAmount=' . $CreditAmount;
					 		}	
					 		if($child4->getName() == 'Tax') {
					 			foreach ($child4->children() as $child5) {
					 				if($child5->getName() == 'TaxType') {
					 					$TaxType = $child5;
					 					$path .= '&TaxType=' . $TaxType;
					 				}
					 				if($child5->getName() == 'TaxPercentage') {
					 					$TaxPercentage = $child5;
					 					$path .= '&TaxPercentage=' . $TaxPercentage;
					 				}
					 			}
					 		}	
					 	}
					 }
					 //END OF LINES
					if($child3->getName() == 'DocumentTotals') {
						foreach ($child3->children() as $child4) {
							if($child4->getName() == 'TaxPayable' ) {
								$TaxPayable = $child4;
								$path .= '&TaxPayable=' . $TaxPayable;
							}
							if($child4->getName() == 'NetTotal' ) {
								$NetTotal = $child4;
								$path .= '&NetTotal=' . $NetTotal;
							}
							if($child4->getName() == 'GrossTotal' ) {
								$GrossTotal = $child4;
								$path .= '&GrossTotal=' . $GrossTotal;
							}
						}
					}
				}
			}
		}
	}
	echo $path;
	 /*$redirect_url = "addInvoice.php" . $path; 
	 header("Location: " . $redirect_url);*/
}

else {
	exit("Erro ao abrir o ficheiro");
}

?> 