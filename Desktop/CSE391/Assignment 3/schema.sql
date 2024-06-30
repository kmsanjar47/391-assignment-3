CREATE DATABASE car_workshop;

USE car_workshop;

CREATE TABLE mechanics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    max_clients_per_day INT NOT NULL
);

CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    car_color VARCHAR(50) NOT NULL,
    car_license_number VARCHAR(50) NOT NULL,
    car_engine_number VARCHAR(50) NOT NULL
);

CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    mechanic_id INT,
    appointment_date DATE,
    FOREIGN KEY (client_id) REFERENCES clients(id),
    FOREIGN KEY (mechanic_id) REFERENCES mechanics(id)
);
