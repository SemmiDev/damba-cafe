DROP DATABASE IF EXISTS webdamba;
CREATE DATABASE webdamba;
USE webdamba;

CREATE TABLE users (
    username VARCHAR(255) NOT NULL PRIMARY KEY,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password) VALUES ('admin', 'admin');

CREATE TABLE menu (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255) NOT NULL,
    category VARCHAR(255) NOT NULL
);

INSERT INTO menu (name, description, price, image, category) VALUES ('Cappucino', 'wuwww sedapp.', 10000, 'kopi-cino.png', 'Coffee');
INSERT INTO menu (name, description, price, image, category) VALUES ('Kopi Hitam', 'wuwww sedapp.', 10000, 'kopi-hitam.png', 'Coffee');

INSERT INTO menu (name, description, price, image, category) VALUES ('Milo', 'wuwww sedapp nye.', 10000, 'milo.png', 'Non Coffee');
INSERT INTO menu (name, description, price, image, category) VALUES ('Green Tea', 'wuwww sedapp nye.', 10000, 'green-tea.png', 'Non Coffee');

INSERT INTO menu (name, description, price, image, category) VALUES ('Naga', 'Minuman berbahan dasar buah naga yang diolah dengan diblend.', 10000, 'naga.png', 'Juice');
INSERT INTO menu (name, description, price, image, category) VALUES ('Apel', 'Minuman berbahan dasar buah apel yang diolah dengan diblend.', 10000, 'jus-apel.png', 'Juice');
INSERT INTO menu (name, description, price, image, category) VALUES ('Jeruk', 'Minuman berbahan dasar buah jeruk yang diolah dengan diblend.', 10000, 'jus-jeruk.png', 'Juice');

INSERT INTO menu (name, description, price, image, category) VALUES ('Mie Goreng', 'Nyam Nyam.', 15000, 'mie-goreng.png', 'Food');
INSERT INTO menu (name, description, price, image, category) VALUES ('Nasi Goreng', 'Nyam Nyam.', 15000, 'nasi-goreng.png', 'Food');
INSERT INTO menu (name, description, price, image, category) VALUES ('Kentang Goreng', 'Nyam Nyam.', 10000, 'kentang-goreng.png', 'Snack');
INSERT INTO menu (name, description, price, image, category) VALUES ('Nugget', 'Nyam Nyam.', 10000, 'nugget.png', 'Snack');

CREATE TABLE orders (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    phone_number INTEGER NOT NULL,
    table_number INT NOT NULL,
    order_date VARCHAR(255) NOT NULL,
    order_time VARCHAR(255) NOT NULL,
    orders_details JSON NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    billing_type VARCHAR(255) NOT NULL,
    order_status VARCHAR(255) DEFAULT 'Pending' -- Pending, Paid
);

CREATE TABLE transaction (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_order INT NOT NULL REFERENCES orders(id),
    payment_type VARCHAR(255) NOT NULL,
    payment_amount DECIMAL(10,2) NOT NULL
);

-- query for get total menu = SELECT COUNT(*) as total FROM menu;
-- query for get total orders = SELECT COUNT(*) as total FROM orders;
-- query for get total transaction = SELECT COUNT(*) as total FROM transaction;
