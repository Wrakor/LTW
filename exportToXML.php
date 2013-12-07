<?php 
 	$xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\" ?><AuditFiles></AuditFiles>");

	$db = new PDO('sqlite:database/documents.db');
 	$stmt = $db->prepare('SELECT * FROM Invoice WHERE InvoiceNo = ?');
 	$stmt->execute(array($_GET['InvoiceNo']));
 	$invoice = $stmt->fetch();

 	$customers =  $db->prepare('SELECT * FROM Customer WHERE CustomerID = ?');
 	$customers->execute(array($invoice['CustomerID']));
 	$customer = $customers->fetch();  

 	$invoices_lines = $db->query('SELECT * FROM Line');
 	$lines = $invoices_lines->fetchAll();

	$products =  $db->query('SELECT * FROM Product');
	$products = $products->fetchAll();

 	$MasterFiles = $xml->addChild('MasterFiles');

 	$Customer = $MasterFiles->addChild('Customer');
 	$CustomerID = $Customer->addChild('CustomerID', $invoice['CustomerID']);
 	$AccountID = $Customer->addChild('AccountID', $invoice['CustomerID']);
 	$CustomerTaxID = $Customer->addChild('CustomerTaxID', $customer['CustomerTaxID']);
 	$CompanyName = $Customer->addChild('CompanyName', $customer['CompanyName']);
 	$BillingAdress = $Customer->addChild('BillingAdress');
 	$AdressDetail = $BillingAdress->addChild('AdressDetail', $customer['AdressDetail']);
 	$City = $BillingAdress->addChild('City', $customer['City']);
 	$PostalCode = $BillingAdress->addChild('PostalCode', $customer['PostalCode']);
 	$Country = $BillingAdress->addChild('Country', $customer['Country']);
 	$Email = $Customer->addChild('Email', $customer['Email']);
 	$SelfBillingIndicator = $Customer->addChild('SelfBillingIndicator', '0');

 	$Product = $MasterFiles->addChild('Product');

 	foreach($lines as $row)
 	{
 		if ($row['idInvoice'] == $invoice['id'])
 		{
	   	$Line = $Product->addChild('Line');
	   	$Line->addChild('LineNumber', $row['LineNumber']);
	   	$Line->addChild('ProductCode', $row['ProductCode']);

	   	$product = $db->prepare('SELECT * FROM Product WHERE ProductCode = ?');
	   	$product->execute(array($row['ProductCode']));
	   	$product = $product->fetch();

	   	$Line->addChild('ProductDescription', $product['ProductDescription']);
	   	$Line->addChild('Quantity', $row['Quantity']);	
	   	$Line->addChild('UnitOfMeasure', $product['UnitOfMeasure']);
	   	$Line->addChild('UnitPrice', $row['UnitPrice']);
	   	$Line->addChild('CreditAmount', $row['CreditAmount']);
	   	$Tax = $Line->addChild('Tax');
	   	$Tax->addChild('TaxType', $row['TaxType']);
	   	$Tax->addChild('TaxPercentage', $row['TaxPercentage']);

	   	$Line->addChild('SettlementAmount', 0);
   }
  }

  $DocumentTotals = $MasterFiles->addChild('DocumentTotals');
  $DocumentTotals->addChild('TaxPayable', $invoice['TaxPayable']);
  $DocumentTotals->addChild('NetTotal', $invoice['NetTotal']);
  $DocumentTotals->addChild('GrossTotal', $invoice['GrossTotal']);

 	Header('Content-type: text/xml');
  print($xml->asXML());
?>

