
CREATE TABLE IF NOT EXISTS clients (
	id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
        businessName VARCHAR(50) DEFAULT NULL,
        contactName VARCHAR(50) DEFAULT NULL,
        contactEmail VARCHAR(50) DEFAULT NULL,
        contactPhone VARCHAR(50) DEFAULT NULL,
        websiteAddress VARCHAR(75) DEFAULT NULL,
        assignedUser INT UNSIGNED DEFAULT NULL,
        userNotes VARCHAR(250) DEFAULT NULL
        
        
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;


