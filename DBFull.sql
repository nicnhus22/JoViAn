USE kgc353_4;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `privelege` ENUM('admin', 'regular') NOT NULL DEFAULT 'regular',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO users (email,password,username,privelege) VALUES ("admin@admin.com","8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918","admin","admin");

CREATE TABLE IF NOT EXISTS Employee (
ID INT NOT NULL PRIMARY KEY,
Name VARCHAR(255) NOT NULL,
WeeklyPay DECIMAL(25,2) NOT NULL,
MonthlyPay DECIMAL(25,2) NOT NULL,
AnnualPay DECIMAL(25,2) NOT NULL,
Commission INT(3) NOT NULL,
DOE DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS PC (
ID INT NOT NULL PRIMARY KEY,
Name VARCHAR(255) NOT NULL,
CPU DECIMAL(25,2) NOT NULL,
RAM INT NOT NULL,
HD INT NOT NULL,
Price DECIMAL(25,2) NOT NULL,
Quantity INT NOT NULL
);

CREATE TABLE IF NOT EXISTS Laptop (
ID INT NOT NULL PRIMARY KEY,
Name VARCHAR(255) NOT NULL,
CPU DECIMAL(25,2) NOT NULL,
RAM INT NOT NULL,
HD INT NOT NULL,
Screen DECIMAL(3,1) NOT NULL,
Price DECIMAL(25,2) NOT NULL,
Quantity INT NOT NULL
);

CREATE TABLE IF NOT EXISTS Software (
ID INT NOT NULL PRIMARY KEY,
Name VARCHAR(255) NOT NULL,
Size DECIMAL(5,2) NOT NULL,
Type VARCHAR(255) NOT NULL,
Price DECIMAL(25,2) NOT NULL,
Quantity INT NOT NULL
);

CREATE TABLE IF NOT EXISTS Part (
ID INT NOT NULL PRIMARY KEY,
Name VARCHAR(255) NOT NULL,
Value DECIMAL(25,2) NOT NULL,
Type VARCHAR(255) NOT NULL,
Price DECIMAL(25,2) NOT NULL,
Quantity INT NOT NULL
);

CREATE TABLE IF NOT EXISTS OnlineSale (
ProductID INT NOT NULL CHECK(ProductID IN(SELECT ID FROM PC UNION SELECT ID FROM Laptop UNION SELECT ID FROM Software UNION SELECT ID FROM Part)),
StoreName VARCHAR(255) NOT NULL,
Date DATE NOT NULL,
CName VARCHAR(255) NOT NULL,
CAddress VARCHAR(255) NOT NULL,
ShippingAddress VARCHAR(255) NOT NULL,
PRIMARY KEY (ProductID, StoreName, Date, CName, CAddress),
EmployeeID INT,
FOREIGN KEY (EmployeeID) REFERENCES Employee(ID)
);

CREATE TABLE IF NOT EXISTS Sale (
ProductID INT NOT NULL CHECK(ProductID IN(SELECT ID FROM PC UNION SELECT ID FROM Laptop UNION SELECT ID FROM Software UNION SELECT ID FROM Part)),
EmployeeID INT NOT NULL,
Date DATE NOT NULL,
CName VARCHAR(255) NOT NULL,
CAddress VARCHAR(255) NOT NULL,
PRIMARY KEY (ProductID, EmployeeID, Date, CName, CAddress)
);

CREATE TABLE IF NOT EXISTS Repair (
ComputerID INT NOT NULL CHECK(ComputerID IN(SELECT ID FROM PC UNION SELECT ID FROM Laptop)),
EmployeeID INT NOT NULL,
Date date NOT NULL,
CName VARCHAR(255) NOT NULL,
CAddress VARCHAR(255) NOT NULL,
Type VARCHAR(255) NOT NULL,
ServiceCost DECIMAL(25,2) NOT NULL,
PRIMARY KEY (ComputerID,EmployeeID,Date,CName,CAddress)
);

CREATE TABLE IF NOT EXISTS Upgrade (
ComputerID INT NOT NULL CHECK(ComputerID IN(SELECT ID FROM PC UNION SELECT ID FROM Laptop)),
EmployeeID INT NOT NULL,
Date DATE NOT NULL,
CName VARCHAR(255) NOT NULL,
CAddress VARCHAR(255) NOT NULL,
ServiceCost DECIMAL(25,2) NOT NULL,
PRIMARY KEY (ComputerID,EmployeeID,CName,CAddress,Date),
PartID INT NOT NULL,
FOREIGN KEY (PartID) REFERENCES Part(ID)
);

CREATE TABLE IF NOT EXISTS Install (
SoftwareID INT NOT NULL CHECK(SoftwareID IN(SELECT ID FROM Software)),
EmployeeID INT NOT NULL,
Date DATE NOT NULL,
CName VARCHAR(255) NOT NULL,
CAddress VARCHAR(255) NOT NULL,
ServiceCost DECIMAL(25,2) NOT NULL,
PRIMARY KEY (SoftwareID,EmployeeID,CName,CAddress,Date)
);

INSERT INTO Employee (ID, Name, WeeklyPay, MonthlyPay, AnnualPay, Commission, DOE)
VALUES (5001, 'Vince Abruzzese', 1000, 4000, 48000, 8, '2008-04-17'),
	   (5002, 'Jordan Rooks', 1250, 5000, 60000, 6, '2006-07-21'),
	   (5003, 'Nicolas Husser', 1250, 5000, 60000, 9, '2007-12-13'),
	   (5004, 'Andrew Costa', 1500, 6000, 72000, 10, '2005-03-28'),
	   (5005, 'Phillip Graham', 750, 3000, 36000, 4, '2011-06-01'),
	   (5006, 'Janice Johnson', 500, 2000, 24000, 3, '2012-04-08'),
	   (5007, 'Amanda Ryan', 1750, 7000, 84000, 14, '2005-03-21'),
	   (5008, 'Francis Thornton', 500, 2000, 24000, 3, '2013-06-22'),
	   (5009, 'Sophie Brooks', 750, 3000, 36000, 5, '2010-07-23'),
	   (5010, 'Alex Daniels', 1000, 4000, 48000, 7, '2007-05-13'),
	   (5011, 'Brenda Bishop', 800, 3200, 38400, 5, '2009-01-07'),
	   (5012, 'Scott McGill', 600, 2400, 28800, 4, '2012-12-12'),
	   (5013, 'Erik Stevenson', 1000, 4000, 48000, 6, '2007-05-25'),
	   (5014, 'Melissa Tyler', 500, 2000, 24000, 2, '2015-02-10'),
	   (5015, 'Marcus Zimmerman', 600, 2400, 28800, 2, '2015-03-21')
ON DUPLICATE KEY UPDATE ID = VALUES(ID);

INSERT INTO PC (ID, Name, CPU, RAM, HD, Price, Quantity)
VALUES (1001, 'HP Desktop PC A8-6410', 2.66, 4, 1000, 419.99, 20),
	   (1002, 'Acer Desktop A10-7800', 3.5, 12, 2000, 679.99, 17),
	   (1003, 'Asus Desktop M11AD-CA003Q', 2.9, 8, 2000, 699.99, 11),
	   (1004, 'Lenovo Desktop M58-7483', 3.0, 4, 1000, 349.99, 16),
	   (1005, 'IBM ThinkCentre E6550', 2.3, 2, 250, 129.99, 23),
	   (1006, 'HP ENVY 70-329', 3.4, 12, 1000, 1099.99, 14),
	   (1007, 'Dell Optiplex DT755', 2.53, 4, 750, 469.99, 12),
	   (1008, 'Lenovo IdeaCentre Desktop I4460', 3.2, 6, 1000, 599.99, 17),
	   (1009, 'Asus Desktop M52BC', 2.66, 8, 2000, 759.99, 9),
	   (1010, 'CyberPower PC Gamer FX-8350', 4.2, 32, 2000, 1299.99, 10),
	   (1011, 'Apple Mac Mini', 1.4, 4, 500, 549.99, 26),
	   (1012, 'HP Compaq Elite 8100', 2.93, 4, 750, 389.99, 15),
	   (1013, 'Apple Mac Pro', 3.5, 16, 2000, 4299.99, 9),
	   (1014, 'Acer Desktop AECD2566', 3.4, 8, 1000, 999.99, 14),
	   (1015, 'Asus Desktop G10AC', 3.6, 8, 1000, 1639.99, 6)
ON DUPLICATE KEY UPDATE ID = VALUES(ID);

INSERT INTO Laptop (ID, Name, CPU, RAM, HD, Screen, Price, Quantity)
VALUES (2001, 'Acer Aspire Laptop X290', 2.16, 4, 500, 15.6, 379.99, 25),
	   (2002, 'Asus EeeBook Notebook E440', 1.33, 4, 500, 11.6, 249.99, 19),
	   (2003, 'Toshiba Satellite Laptop XC90', 1.9, 4, 750, 17.3, 729.99, 12),
	   (2004, 'Asus Transformer Book E320', 1.33, 2, 500, 10.1, 349.99, 8),
	   (2005, 'Apple Macbook Pro', 2.5, 4, 1000, 13.3, 1349.99, 14),
	   (2006, 'HP Pavillion Notebook', 2.1, 8, 1000, 17.3, 799.99, 16),
	   (2007, 'MSI GP70 Laptop', 3.2, 8, 1000, 17.3, 959.99, 6),
	   (2008, 'Apple Macbook Air', 1.4, 4, 1000, 13.3, 1099.99, 15),
	   (2009, 'HP EliteBook Laptop C60', 2.53, 4, 500, 12.1, 299.99, 11),
	   (2010, 'Lenovo ThinkPad E540', 2.5, 4, 500, 15.6, 779.99, 12),
	   (2011, 'Dell Latitude XT2', 1.6, 2, 120, 12.1, 329.99, 5),
	   (2012, 'ASUS G751 ROG Republic of Gaming', 3.5, 16, 1000, 17.3, 1499.99, 18),
	   (2013, 'Lenovo G50-80 Signature Edition Laptop', 2.16, 4, 500, 12.1, 429.99, 12),
	   (2014, 'Dell XPS 13 Signature Edition Laptop', 2.35, 8, 750, 13.3, 999.99, 21),
	   (2015, 'Samsung ATIV Book 9 Plus', 3.2, 8, 1000, 15.1, 1099.99, 11)
ON DUPLICATE KEY UPDATE ID = VALUES(ID);

INSERT INTO Software (ID, Name, Size, Type, Price, Quantity)
VALUES (3001, 'Microsoft Office 365', 3.5, 'Work', 69.99, 50),
	   (3002, 'Microsoft Windows 7', 18, 'Operating System', 79.99, 20),
	   (3003, 'Microsoft Windows 8', 20, 'Operating System', 119.99, 40),
	   (3004, 'Microsoft Visual Studio 2013', 8.8, 'Work', 199.99, 12),
	   (3005, 'Norton Anti-Virus 2015', 1.2, 'Anti-Virus', 89.99, 31),
	   (3006, 'McAfee Internet Security 2015', 0.8, 'Anti-Virus', 69.99, 16),
	   (3007, 'Adobe Acrobat V.11 Standard', 1.5, 'Work', 364.99, 22),
	   (3008, 'Nuance PDF Create', 0.5, 'Work', 49.99, 25),
	   (3009, 'Roxio Easy VHS to DVD 3 Plus', 1.5, 'Music and Video', 69.99, 29),
	   (3010, 'Adobe Photoshop Elements 13', 5, 'Graphics Design', 129.99, 41),
	   (3011, 'Summitsoft Website Creator', 4.2, 'Graphics Design', 39.99, 12),
	   (3012, 'TurboTax Standard, Tax Year 2014', 1.5, 'Tax', 29.99, 8),
	   (3013, 'Sim City: PC Game', 2.2, 'Game', 34.99, 15),
	   (3014, 'Call of Duty: Black Ops II', 2.5, 'Game', 19.99, 9),
	   (3015, 'Diablo III', 3.2, 'Game', 39.99, 23)
ON DUPLICATE KEY UPDATE ID = VALUES(ID);

INSERT INTO Part (ID, Name, Value, Type, Price, Quantity)
VALUES (4001, 'Intel Core i7-4790K Processor', 4, 'CPU', 419.99, 40),
	   (4002, 'Intel Core I5 4690K 3.5GHz Quad Core Processor', 3.5, 'CPU', 289.99, 33),
	   (4003, 'Intel Core i3-4150 3.5GHz Processor', 3.5, 'CPU', 139.99, 52),
	   (4004, 'AMD FX-9590 Eight-Core 5.0Ghz AM3+ CPU', 5, 'CPU', 279.99, 20),
	   (4005, 'AMD A8-7600 Standard Edition Processor - 3.8GHz', 3.8, 'CPU', 123.99, 45),
	   (4006, 'AMD Athlon X4 860K - Black Edition Processor', 3.7, 'CPU', 89.99, 17),
	   (4007, 'Crucial Ballistix Elite DDR4 16GB Kit Memory', 16, 'RAM', 311.99, 23),
	   (4008, 'ADATA XPG V2 Series 16GB 2400MHz Memory Module Kit', 16, 'RAM', 199.99, 31),
	   (4009, 'ADATA XPG DDR3 8GB 1600MHz V1.0 Desktop Memory', 8, 'RAM', 84.99, 22),
	   (4010, 'ADATA Premier Series 4GB 1333MHz-DDR3 Memory', 4, 'RAM', 44.99, 10),
	   (4011, 'Seagate Barracuda 3TB Hard Drive Internal', 3000, 'HD', 114.99, 14),
	   (4012, 'Toshiba 2TB Internal Hard Disk Drive', 2000, 'HD', 103.99, 26),
	   (4013, 'WD Blue 1TB Desktop Hard Drive', 1000, 'HD', 71.99, 29),
	   (4014, 'Seagate Barracuda 500GB Internal HDD', 500, 'HD', 59.99, 54),
	   (4015, 'WD Blue 750 GB Mobile Hard Drive', 750, 'HD', 77.99, 40)
ON DUPLICATE KEY UPDATE ID = VALUES(ID);

INSERT INTO OnlineSale (ProductID, StoreName, Date, CName, CAddress, ShippingAddress, EmployeeID)
VALUES (2001, 'Ebay', '2014-10-17', 'Harold Zimmerman', '9698 Foggy Brook Trail, Prettyboy, NF, A3E-4B1, CA', '9698 Foggy Brook Trail, Prettyboy, NF, A3E-4B1, CA', NULL),
(1004, 'Ebay', '2014-11-12', 'William Jackson', '7443 Shady Place, Globe Set, AB, T4V-7Y2, CA', '4766 Thunder Villas, Deer Lodge, MB, R9O-2R3, CA', 5010),
(3015, 'Ebay', '2014-01-04', 'Mario Holloway', '1650 Dewy Bear Green, Hell Gate, NW, X0K-5Z2, CA', '1650 Dewy Bear Green, Hell Gate, NW, X0K-5Z2, CA', 5002),
(4005, 'Ebay', '2013-12-10', 'Andy Andrews', '3233 Merry Crossing, Tin Top, MB, R8T-1Z9, CA', '3233 Merry Crossing, Tin Top, MB, R8T-1Z9, CA', NULL),
(4007, 'Ebay', '2014-10-17', 'Vicki Colon', '7877 Stony Range, Kokomo, NS, B5V-4P8, CA', '2849 Bright Oak Heights, Waldron, NF, A6J-8V7, CA', 5015),
(2002, 'Ebay', '2014-11-11', 'Virginia Phelps', '6922 Clear Blossom Impasse, Antler, NF, A0F-7W4, CA', '6922 Clear Blossom Impasse, Antler, NF, A0F-7W4, CA', NULL),
(1001, 'Ebay', '2014-03-16', 'Della Dean', '3527 Cozy Lake Townline, Dodge, PE, C9J-2P2, CA', '3527 Cozy Lake Townline, Dodge, PE, C9J-2P2, CA', 5010),
(2001, 'Ebay', '2014-07-08', 'Troy Warner', '4486 Little Lagoon Village, Cardston, NS, B1N-1Y2, CA', '5955 Shady Hickory Woods, Black Warrior Town, QC, H0D-9H3, CA', NULL),
(2015, 'Ebay', '2014-06-07', 'Renee Hodges', '9052 Amber Apple Heath, Half Moon, ON, M8F-2U1, CA', '9052 Amber Apple Heath, Half Moon, ON, M8F-2U1, CA', 5001),
(2010, 'Ebay', '2015-03-02', 'Jason Anderson', '7826 Foggy Robin Subdivision, Oven Fork, YK, Y1O-8V4', '7826 Foggy Robin Subdivision, Oven Fork, YK, Y1O-8V4', 5001),
(1011, 'Ebay', '2015-01-25', 'Miranda Frazier', '1496 Honey Byway, Coffee City, YK, Y4C-5K7, CA', '5485 Pleasant Autumn Close, Perdue, MB, R6E-7P4, CA', NULL),
(3015, 'Ebay', '2015-02-10', 'Kristy Fuller', '9663 Dusty Anchor Abbey, Snowshoe, AB, T4Q-8R5, CA', '1817 Cinder Leaf Bend, Tinmouth, BC, V1E-9A5, CA', NULL),
(4012, 'Ebay', '2015-03-02', 'Chris Castillo', '6992 Cotton Way, Scarface, NU, X5N-7P6, CA', '6992 Cotton Way, Scarface, NU, X5N-7P6, CA', NULL),
(4004, 'Ebay', '2013-08-21', 'Constance Miller', '4027 Lost Bluff Place, Pilaklakha, YK, Y1A-5L1, CA', '9787 Heather Fox Ramp, Lick Springs, NF, A1L-7L0, CA', 5004),
(4005, 'Ebay', '2012-12-12', 'Cary Harvey', '3631 Quiet Mountain Pathway, Charity, SK, S5J-2P8, CA', '3631 Quiet Mountain Pathway, Charity, SK, S5J-2P8, CA', 5007)
ON DUPLICATE KEY UPDATE ProductID = VALUES(ProductID), StoreName = VALUES(StoreName), Date = VALUES(Date), CName = VALUES(CName), CAddress = VALUES(CAddress);

INSERT INTO Sale (ProductID, EmployeeID, Date, CName, CAddress)
VALUES (2012, 5005, '2014-10-17', 'Jacquelyn Barber', '3459 Rocky Rabbit Circle, Crummies, NU, X4Q-3U5, CA'),
(1014, 5004, '2014-05-05', 'Emmett Ramirez', '4194 Burning Passage, Perennial, SK, S6P-4F3, CA'),
(3001, 5010, '2014-03-14', 'Becky Luna', '5336 Red Sky Nook, Frick, NF, A9P-4H7, CA'),
(4002, 5009, '2013-11-10', 'Carlos Gutierrez', '614 Tawny Expressway, Pipyak, NB, E0A-4P2, CA'),
(4009, 5011, '2014-07-09', 'Armando Sanders', '1758 Quiet Mountain Beach, Happyland, YK, Y0I-6V9, CA'),
(3002, 5002, '2013-10-11', 'Freda Davidson', '4443 Quaking Swale, Savage, ON, N2N-5D3, CA'),
(1015, 5003, '2013-12-16', 'Angel Weaver', '9961 Hidden Zephyr Dale, Geneva, NU, X5G-6I7, CA'),
(2008, 5006, '2014-02-02', 'Billy Saunders', '7828 Sunny Corner, Yellow Grass, BC, V3C-0W2, CA'),
(2008, 5008, '2014-05-07', 'Lynn Simpson', '7755 Broad Goose Lane, Puseyville, NB, E4J-8O4, CA'),
(3001, 5012, '2015-02-11', 'Manuel Kelly', '294 Merry Lookout, Cabinet, BC, V5G-4H9, CA'),
(1014, 5013, '2015-01-13', 'Simon Brewer', '9917 Dewy Pathway, Gays Creek, NB, E5G-3G1, CA'),
(4002, 5014, '2015-02-10', 'Lucy Burton', '8300 Grand Street, Ozawkie, AB, T1W-7K9, CA'),
(4001, 5015, '2014-07-09', 'Darrin Griffin', '1542 Emerald Branch Gate, Happytown, MB, R7G-1T9, CA'),
(3013, 5005, '2014-09-09', 'Lorene Brooks', '245 Silver Fox Boulevard, Exile, ON, N7Z-8L6, CA'),
(2004, 5007, '2012-07-26', 'Silvia Steele', '3401 Green Meadow, Rainbow, PE, C6E-8R5, CA')
ON DUPLICATE KEY UPDATE ProductID = VALUES(ProductID), EmployeeID = VALUES(EmployeeID), Date = VALUES(Date), CName = VALUES(CName), CAddress = VALUES(CAddress);

INSERT INTO Repair (ComputerID, EmployeeID, Date, CName, CAddress, Type, ServiceCost)
VALUES (2012, 5003, '2014-11-11', 'Jacquelyn Barber', '3459 Rocky Rabbit Circle, Crummies, NU, X4Q-3U5, CA', 'Hardware:CPU Replacement', 120.99),
(1014, 5009, '2014-11-24', 'Emmett Ramirez', '4194 Burning Passage, Perennial, SK, S6P-4F3, CA', 'Software: OS Reinstall', 61.99),
(2004, 5011, '2014-01-25', 'Tiffany Craig', '6693 Foggy Glen, Nolichucky, NU, X1Q-2A8, CA', 'Hardware: Graphic Card Ventilator Replacement', 80.99),
(2008, 5007, '2013-12-11', 'Pearl Becker', '4035 Crystal Cider Jetty, Maxinkuckee, NU, X8C-5H7, CA', 'Software: Virus Clean up', 49.99),
(2009, 5002, '2014-07-09', 'Terry Carter', '3509 Burning Log Estates, Hay River, ON, M7G-0J0, CA', 'Software: Malware Clean up', 35.99),
(1001, 5004, '2013-11-11', 'Allan Turner', '3456 Bright Deer Run, Indianapolis, NS, B8B-9A3, CA', 'Hardware: CPU Replacement', 120.99),
(1015, 5008, '2015-01-24', 'Kristi Wilson', '4861 Silent Fox Inlet, Blowing Cave, NF, A4V-3A6, CA', 'Hardware: Mother board Replacement', 144.99),
(2008, 5012, '2014-06-12', 'Billy Saunders', '7828 Sunny Corner, Yellow Grass, BC, V3C-0W2, CA', 'Hardware: HD Replacement', 90.99),
(1014, 5011, '2014-10-20', 'Lynn Simpson', '7755 Broad Goose Lane, Puseyville, NB, E4J-8O4, CA', 'Software: OS Reinstall', 61.99),
(2015, 5015, '2014-02-18', 'Theodore Richards', '576 Round Crescent, West Nipissing, NB, E6N-7A6, CA', 'Software: Virus Clean up', 49.99)
ON DUPLICATE KEY UPDATE ComputerID = VALUES(ComputerID), EmployeeID = VALUES(EmployeeID), Date = VALUES(Date), CName = VALUES(CName), CAddress = VALUES(CAddress);

INSERT INTO Upgrade (ComputerID, EmployeeID, Date, CName, CAddress, ServiceCost, PartID)
VALUES (1001, 5001, '2014-11-25', 'Anita Summers', '1008 Noble Gardens, Turner Valley, Manitoba, R8C-1C3, CA', 39.99, 4004),
	   (2002, 5003, '2014-12-29', 'Douglas Cross', '6115 Cinder Jetty, Mortlach, Manitoba, R4G-2R6, CA', 24.99, 4001),
	   (2004, 5006, '2014-10-28', 'Colleen Valdez', '720 Middle Avenue, Tofield, Ontario, N4O-7K3, CA', 44.99, 4006),
	   (2009, 5012, '2015-02-28', 'Kerry Sherman', '6589 Hidden Creek Mountain, Billy Goat Hill, Britsh Columbia, V7Z-4N8, CA', 14.99, 4011),
	   (1011, 5013, '2015-03-05', 'Ellis Bennett', '3001 Misty Route, Sweet Air, Quebec, J4F-8W3, CA', 11.99, 4012),
	   (1011, 5002, '2014-06-26', 'Brenda Walker', '9255 Foggy Elk Avenue, Tuluksak, Yukon, Y1W-5S4, CA', 8.99, 4013),
	   (1005, 5005, '2015-01-04', 'Monica Ford', '3965 Grand Shadow Highlands, Zip City, Manitoba, R9U-1V4, CA', 24.99, 4008),
	   (1005, 5007, '2014-05-21', 'Guy Watkins', '4872 Rocky Dale Manor, Hi Hat, Nunavut, X3U-6F6, CA', 16.99, 4009),
	   (2011, 5001, '2014-09-18', 'Arthur Schmidt', '6139 Tawny Pony Range, Rabbit Lake, Prince Edward Island, C5G-3F9, CA', 12.99, 4014),
	   (2011, 5004, '2014-12-12', 'Lena Wolfe', '8283 Broad Highway, Truly, Saskatchewan, S3Q-1E8, CA', 9.99, 4015),
	   (2004, 5002, '2013-12-29', 'Bill Castillo', '6823 Silver Anchor Corners, Fate, Ontario, K8P-7A9, CA', 14.99, 4011),
	   (2007, 5009, '2015-01-22', 'Otis Perez', '3256 Amber Campus, Goat Town, Northwest Territories, X1W-2W6, CA', 39.99, 4004),
	   (1005, 5001, '2015-02-03', 'Ronnie King', '9089 Thunder Range, B-Say-Tah, Britsh Columbia, V1Z-4H1, CA', 12.99, 4013),
	   (1014, 5002, '2015-03-24', 'Kari Fernandez', '7530 Velvet Village, Benefit, Britsh Columbia, V4Z-7U8, CA', 24.99, 4007),
	   (1001, 5004, '2015-04-01', 'Tom Delgado', '5034 Little Embers Grove, Coats, Quebec, G1E-7M1, CA', 25.99, 4001)
ON DUPLICATE KEY UPDATE ComputerID = VALUES(ComputerID), EmployeeID = VALUES(EmployeeID), Date = VALUES(Date), CName = VALUES(CName), CAddress = VALUES(CAddress);

INSERT INTO Install (SoftwareID, EmployeeID, Date, CName, CAddress, ServiceCost)
VALUES (3001, 5001, '2015-01-08', 'Tammy Jackson', '1845 Burning Treasure Road, Morden, MB, R9I-2S9, CA', 2.99),
	   (3001, 5003, '2015-01-09', 'Ben Collins', '3892 Wishing Brook Dale, Blowtown, NW, X5Z-1T2, CA', 2.99),
	   (3001, 5012, '2015-01-12', 'Nina Bowers', '732 Merry Lagoon Acres, Lost City, QC, G5U-6E9, CA', 2.99),
	   (3001, 5001, '2015-01-18', 'Sarah Pena', '4907 Colonial Forest, Israel, BC, V8J-6W0, CA', 2.99),
	   (3003, 5001, '2014-12-16', 'Marvin Wells', '7462 Gentle Harbour, Mankota, AB, T5O-7Y3, CA', 4.99),
	   (3003, 5002, '2014-12-11', 'Walter Bailey', '9801 Dusty Drive, Ben Wheeler, QC, H3U-2R1, CA', 4.99),
	   (3003, 5003, '2014-12-15', 'Elsa Ramirez', '8517 Broad Wood, Naicam, NU, X2X-7N8, CA', 4.99),
	   (3002, 5004, '2015-02-03', 'Gene Moran', '1861 Middle Limits, Hubbard, AB, T3P-9D3, CA',3.99),
	   (3005, 5006, '2015-03-25', 'Patrick Boyd', '5186 Foggy Glade, Three Trees, NW, X2F-5R0, CA', 1.99),
	   (3005, 5009, '2015-03-04', 'Jennifer Nunez', '6031 Cozy Robin Passage, Two Rock, YK, Y0O-0O3, CA', 1.99),
	   (3005, 5015, '2015-03-04', 'Robert Graves', '9699 Sleepy Shadow Corners, Trump, PE, C9T-2U0, CA', 1.99),
	   (3006, 5014, '2015-03-04', 'Marty Greene', '1816 Old Plaza, Village Seven, ON, K8S-3T4, CA', 0.99),
	   (3006, 5001, '2015-02-11', 'Melinda Nash', '449 Silver Farm, Turkeytown, NU, X2F-4Z1, CA', 0.99),
	   (3010, 5003, '2014-10-22', 'Kent Strickland', '6520 Rustic Trace, Smile, NF, A2R-4U0, CA', 3.99),
	   (3010, 5005, '2014-11-23', 'Irene Weber', '223 Little Landing, Plumbsock, NS, B5M-2C1, CA', 3.99)
ON DUPLICATE KEY UPDATE SoftwareID = VALUES(SoftwareID), EmployeeID = VALUES(EmployeeID), Date = VALUES(Date), CName = VALUES(CName), CAddress = VALUES(CAddress);