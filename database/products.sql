DROP TABLE Product;

CREATE TABLE Product (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	ProductCode INTEGER,
	ProductDescription VARCHAR,
	UnitPrice NUMBER,
	UnitOfMeasure VARCHAR
);

INSERT INTO Product VALUES (NULL, 125, 'Peca X', 90, 'kg');
INSERT INTO Product VALUES (NULL, 126, 'Maquina Y', 450, 'kg');
INSERT INTO Product VALUES (NULL, 127, 'Peca A', 45, 'kg');
INSERT INTO Product VALUES (NULL, 128, 'Peca B', 60, 'kg');
INSERT INTO Product VALUES (NULL, 130, 'Rotor', 80, 'Watts');
INSERT INTO Product VALUES (NULL, 131, 'Centralina', 125, 'Volts');
INSERT INTO Product VALUES (NULL, 132, 'Quadrante', 130, 'coisas');
INSERT INTO Product VALUES (NULL, 133, 'Alternador', 33, 'Amperes');
INSERT INTO Product VALUES (NULL, 134, 'Airbag', 45, 'coisas');
INSERT INTO Product VALUES (NULL, 135, 'Caixa Velocidades', 20, 'kg');

INSERT INTO Product VALUES (NULL, 32, 'Maquina de espremer Laranjas', 70, 'kg');
INSERT INTO Product VALUES (NULL, 129, 'Bananas', 5, 'kg');
INSERT INTO Product VALUES (NULL, 33, 'Farinha', 10, '5kg');