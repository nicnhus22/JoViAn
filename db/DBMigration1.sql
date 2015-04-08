
ALTER TABLE users ADD EmployeeID INT(11) NOT NULL REFERENCES Employee(ID);

DELETE FROM users;
INSERT INTO users (email,password,username,privelege,EmployeeID) 
	VALUES ("vince.abru@gmail.com","8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918","VinceAbruzzese","admin",5001),
		("jordan.rooks@gmail.com","8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918","JordanRooks","regular",5002),
		("andrew.costa@gmail.com","8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918","AndrewCosta","regular",5004),
		("nicolas.husser@gmail.com","8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918","NicolasHusser","admin",5003);
 



