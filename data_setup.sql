CREATE TABLE webdata.leads (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
session_id VARCHAR(60) NOT NULL,
email VARCHAR(50) NULL,
firstname VARCHAR(30) NULL,
lastname VARCHAR(30) NULL,
phone VARCHAR(20) NULL,
address VARCHAR(60) NULL,
square_footage VARCHAR (15) NULL,
status INT(1),
updated_at timestamp,
created_at timestamp default current_timestamp
)

CREATE TABLE webdata.users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(50) NOT NULL,
hash VARCHAR(120) NOT NULL,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
role INT(1),
status INT(1),
updated_at timestamp,
created_at timestamp default current_timestamp
)