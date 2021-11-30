CREATE TABLE IF NOT EXISTS Products(
    id int AUTO_INCREMENT PRIMARY  KEY,
    name varchar(30) UNIQUE,
    description text,
    category varchar(30) UNIQUE,
    stock int DEFAULT  0,
    cost int DEFAULT  99999,
    image text,
    visibility tinyint(1) default 1,
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP
)