DROP TABLE Invoice;
DROP TABLE Line;

CREATE TABLE Invoice (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	InvoiceNo VARCHAR NOT NULL,
	InvoiceDate DATE,
	CustomerID INTEGER,
	TaxPayable NUMBER,
	NetTotal NUMBER,
	GrossTotal NUMBER
);

CREATE TABLE Line (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	idInvoice REFERENCES Invoice,
	LineNumber INTEGER,
	ProductCode INTEGER,
	Quantity INTEGER,
	UnitPrice NUMBER,
	CreditAmount NUMBER,
	TaxType VARCHAR, 
	TaxPercentage NUMBER	
);

/*CREATE TABLE Tax (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	IdLine REFERENCES Line,
	TaxType VARCHAR,
	TaxPercentage NUMBER	
);*/


INSERT INTO Invoice VALUES (NULL, 'FT-SEQ/1', '2013-09-27', 555560, 165.6, 720, 885.6);
INSERT INTO Line VALUES (NULL, 1, 1, 125, 3, 90, 270, 'IVA', 23.00);

INSERT INTO Invoice VALUES (NULL, '20355', '2013-08-02', 4355, 42, 140, 182);
INSERT INTO Line VALUES (NULL, 2, 1, 32, 2, 70, 140, 'Taxa alfandegária', 30.00);
INSERT INTO Line VALUES (NULL, 2, 2, 126, 1, 450, 450, 'IVA', 23.00);
