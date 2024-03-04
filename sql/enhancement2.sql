-- Query 1
INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, comment) VALUES ("Tony", "Stark", "tony@starkent.com", "Iam1ronM@n", "I am the real Ironman");

-- Query 2
UPDATE clients SET clientLevel = 3 WHERE clientId = 1;

-- Query 3
UPDATE inventory SET invDescription = REPLACE(invDescription, 'small interiors', 'spacious interiors') WHERE invId = 12;

-- Query 4
SELECT carclassification.classificationName, inventory.invModel FROM carclassification INNER JOIN inventory ON carclassification.classificationId=inventory.classificationId WHERE carclassification.classificationName = 'SUV';

-- Query 5
DELETE FROM inventory WHERE invMake = 'Jeep' AND invModel = 'Wrangler';

-- Query 6
UPDATE inventory SET invImage = CONCAT('/phpmotors', invImage), invThumbnail = CONCAT('/phpmotors', invThumbnail);

