CREATE DATABASE teste;
USE teste;

CREATE TABLE usuario (
id INT AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(100) NOT NULL UNIQUE,
nome varchar(50),
senha VARCHAR(255) NOT NULL

);


