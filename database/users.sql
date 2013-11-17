DROP TABLE User;

CREATE TABLE User(
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	Name VARCHAR, 
	Password VARCHAR,
	Permission VARCHAR
);

INSERT INTO User VALUES (NULL, "admin", "strongpassword", "admin");
INSERT INTO User VALUES (NULL, "reader", "anotherstrongpassword", "read");
INSERT INTO User VALUES (NULL, "writer", "onemorestrongpassowrd", "write");
