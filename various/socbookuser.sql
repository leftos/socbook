CREATE USER 'socbook'@'localhost' IDENTIFIED BY 'socbook';

GRANT ALL ON socbook.* TO 'socbook'@'localhost';

FLUSH PRIVILEGES;
