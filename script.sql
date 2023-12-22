CREATE DATABASE address_book;

CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(40),
    email VARCHAR(80),
    mobile VARCHAR(40)
);
