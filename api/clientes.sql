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
INSERT INTO Customer VALUES (NULL, 4355, 167098356, 'Pastelaria Vai Me Ao Pito', 'Rua Santa Madalena, Numero 67 Res do Chao', 'Porto', 4200, 351, 'pastelariavaimeaopito@hotmail.com');
