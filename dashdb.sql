CREATE TABLE register (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(25) NOT NULL,
    lastname VARCHAR(25) NOT NULL,
    email VARCHAR(25) NOT NULL,
    password VARCHAR(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;
INSERT INTO register (email,password) VALUES('admin@gmail.com', '123');


