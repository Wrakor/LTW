DROP TABLE Product;

CREATE TABLE Product (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	ProductCode INTEGER,
	ProductDescription VARCHAR,
	UnitPrice NUMBER,
	UnitOfMeasure VARCHAR
);

INSERT INTO Product VALUES (NULL, 125, 'Peca X', 90, 'coisas');
INSERT INTO Product VALUES (NULL, 126, 'Maquina Y', 450, 'coisas');
INSERT INTO Product VALUES (NULL, 32, 'Maquina de espremer Laranjas', 70, 'coisas');