CREATE TABLE IF NOT EXISTS OrderItems(
id int AUTO_INCREMENT PRIMARY KEY,
order-id int,
item_id int,
quantity text,
unit_price text,
FOREIGN KEY (order_id) REFERENCES Orders(id),
FOREIGN KEY (item_id) REFERENCES Products(id),
UNIQUE KEY (item_id, order_id),
check (quantity >= 0)