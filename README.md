# NSLS_Assessment
NSLS Assessment Project -  API for Weather Forecast Retrieval

1. Download project files and place inside an existing site or containerized site
2. Create a mysql database or use an existing one
3. Create table for tokens:

CREATE TABLE `tokens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `token` varchar(64) DEFAULT NULL,
  `usagecount` int DEFAULT '0',
  `lastusedon` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

4. Add token data to table
5. Create user and provide permissions to table
6. Open the file /api/weather/office/forecast/controller/inc/config and update database parameters
7. Open the provided example.php in the root directory
8. Add personal valid email address
9. Add valid website address (email and website are used for verification in the weather.gov api)
10. Add a valid token
11. Launch the service





