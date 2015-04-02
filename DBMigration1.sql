
ALTER TABLE users DROP COLUMN id;
ALTER TABLE users ADD EmployeeID INT(11) NOT NULL BEFORE email
			ADD CONSTRAINT FOREIGN KEY(EmployeeID) REFERENCES Employee(ID);


DELETE * FROM users;
INSERT INTO users (email,password,username,privelege) 
	VALUES (5001,"vince.abru@gmail.com","8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918","VinceAbruzzese","admin"),
		(5002,"jordan.rooks@gmail.com","8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918","JordanRooks","regular"),
		(5004,"andrew.costa@gmail.com","8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918","AndrewCosta","regular"),
		(5003,"nicolas.husser@gmail.com","8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918","NicolasHusser","admin");
 



