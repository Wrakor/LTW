DROP TABLE Customer;

CREATE TABLE Customer (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	CustomerID INTEGER,
	CustomerTaxID INTEGER, 
	CompanyName VARCHAR, 
	AdressDetail VARCHAR,
	City VARCHAR, 
	PostalCode INTEGER,
	Country INTEGER, 
	Email VARCHAR
);

INSERT INTO Customer VALUES (NULL, 555560, 167896322, 'Tornearia Mecanica Correia', 'Rua Professor Jacinto Ferreira, Numero 35', 'Vila Real', 5000, 351, 'torneariamc@sapo.pt');
INSERT INTO Customer VALUES (NULL, 4355, 167098356, 'Pastelaria Ze do Pito', 'Rua Santa Madalena, Numero 67 Res do Chao', 'Porto', 4200, 351, 'pastelariavaimeaopito@hotmail.com');
INSERT INTO Customer VALUES (NULL, 123654, 345685213, 'Carmindo Sobral Lda', 'Rua de Lamais, Numero 55', 'Pacos de Ferreira', 4590, 351, 'cms@gmail.com');
INSERT INTO Customer VALUES (NULL, 2356, 325478962, 'Nacex S.A.', 'Rua da Cochorela, Numero 88', 'Carvalhosa', 4590, 351, 'nacex@gmail.com');
INSERT INTO Customer VALUES (NULL, 856412, 745685418, 'Mecanica Pinto', 'Rua da Boavista, Numero 45', 'Porto', 3215, 351, 'pintomc@hotmail.com');