CREATE USER IF NOT EXISTS 'royal_user'@'localhost' IDENTIFIED BY 'Rikkyvish@12';
GRANT ALL PRIVILEGES ON royal_gcollection.* TO 'royal_user'@'localhost';
FLUSH PRIVILEGES;
