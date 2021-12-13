CREATE TABLE IF NOT EXISTS npmUsers (
	id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
        userFirstName VARCHAR(50) NOT NULL,
        userLastName VARCHAR(50) NOT NULL,
        userEmail VARCHAR(50) NOT NULL,
        department VARCHAR(15) NOT NULL,
        isAdmin BOOL NOT NULL,
        username VARCHAR(50) NOT NULL,
        userPassword VARCHAR(250) NOT NULL
        
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;