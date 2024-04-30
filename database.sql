CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  email VARCHAR(255),
  password VARCHAR(255),
  sex CHAR(1),
  age INT,
  date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  date_birth DATE,
  img_profile VARCHAR(255),
  status TINYINT(1)
);

CREATE TABLE posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  text TEXT,
  image VARCHAR(255),
  data_post DATE,
  status INT,
  user_id INT,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE likes_post (
  id_post INT,
  user_id INT,
  PRIMARY KEY (id_post, user_id),
  FOREIGN KEY (id_post) REFERENCES posts(id),
  FOREIGN KEY (user_id) REFERENCES users(id)
);