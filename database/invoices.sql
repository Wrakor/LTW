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


INSERT INTO Invoice VALUES (NULL, 'FT-SEQ/1', '2013-09-27', 555560, 62.1, 270, 332.1);
INSERT INTO Line VALUES (NULL, 1, 1, 125, 3, 90, 270, 'IVA', 23.00);

INSERT INTO Invoice VALUES (NULL, '20355', '2013-08-02', 4355, 145.5, 590, 735.5);
INSERT INTO Line VALUES (NULL, 2, 1, 32, 2, 70, 140, 'Taxa alfandegaria', 30.00);
INSERT INTO Line VALUES (NULL, 2, 2, 126, 1, 450, 450, 'IVA', 23.00);

INSERT INTO Invoice VALUES (NULL, '345678', '2013-05-12', 123654, 136.85, 595, 731.85);
INSERT INTO Line VALUES (NULL, 3, 1, 127, 5, 45, 225, 'IVA', 23.00);
INSERT INTO Line VALUES (NULL, 3, 2, 128, 3, 60, 180, 'IVA', 23.00);
INSERT INTO Line VALUES (NULL, 3, 3, 129, 2, 95, 190, 'IVA', 23.00);


INSERT INTO Invoice VALUES (NULL, '965248', '2013-10-31', 2356, 313.7, 1130, 1443.7);
INSERT INTO Line VALUES (NULL, 4, 1, 130, 3, 80, 240, 'IVA', 23.00);
INSERT INTO Line VALUES (NULL, 4, 2, 131, 1, 125, 125, 'IVA', 23.00);
INSERT INTO Line VALUES (NULL, 4, 3, 132, 2, 130, 260, 'IVA', 23.00);
INSERT INTO Line VALUES (NULL, 4, 4, 133, 5, 33, 165, 'IVA', 23.00);
INSERT INTO Line VALUES (NULL, 4, 5, 134, 4, 45, 180, 'Taxa alfandegaria', 30.00);
INSERT INTO Line VALUES (NULL, 4, 6, 135, 13, 20, 260, 'Taxa alfandegaria', 30.00);

INSERT INTO Invoice VALUES (NULL, '65321', '2013-05-05', 856412, 221.2, 840, 1061.2);
INSERT INTO Line VALUES (NULL, 5, 1, 32, 2, 70, 140, 'Taxa alfandegaria', 30.00);
INSERT INTO Line VALUES (NULL, 5, 2, 135, 13, 20, 260, 'Taxa alfandegaria', 30.00);
INSERT INTO Line VALUES (NULL, 5, 3, 132, 2, 130, 260, 'IVA', 23.00);
INSERT INTO Line VALUES (NULL, 5, 4, 128, 3, 60, 180, 'IVA', 23.00);
