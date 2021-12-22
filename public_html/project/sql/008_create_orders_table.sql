CREATE TABLE IF NOT EXISTS Orders(
id int AUTO_INCREMENT PRIMARY KEY,
user_id int,
total_price int,
address text,
payment_method text,
created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (user_id) REFERENCES Users(id)
);