DROP TABLE Product;

CREATE TABLE Product (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	ProductCode INTEGER,
	ProductDescription VARCHAR,
	UnitPrice NUMBER,
	UnitOfMeasure VARCHAR
);

INSERT INTO Product VALUES (NULL, 125, 'Peça X', 90, 'coisas');
INSERT INTO Product VALUES (NULL, 126, 'Máquina Y', 450, 'coisas');
INSERT INTO Product VALUES (NULL, 32, 'Máquina de espremer Laranjas', 70, 'coisas');