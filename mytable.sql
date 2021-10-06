CREATE DATABASE taskdb
use taskdb

CREATE TABLE tasks (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(300) NOT NULL,
  description TEXT,
  state INT NOT NULL CHECK (state = 1 OR state = 2 OR state = 9),
  category INT NOT NULL,
  due_date DATE,
  PRIMARY KEY (id)
);

CREATE TABLE categories (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(300) NOT NULL,
  PRIMARY KEY (id)
);

ALTER TABLE tasks ADD FOREIGN KEY fk_cat(category) REFERENCES categories(id);

INSERT INTO tasks (name, description, state, category, due_date)
 VALUE ('tatsuya', '仕事するぞ', 1, 1, '2021-09-09');

INSERT INTO todos (title, is_done) VALUE ('bbb', true);
INSERT INTO todos (title) VALUE ('ccc');


INSERT INTO categories (name) VALUE ('仕事');
INSERT INTO categories (name) VALUE ('買い物');
INSERT INTO categories (name) VALUE ('家事');

INSERT INTO tasks (name, description, state, category, due_date)
 VALUE ('tatsuya', 'youtube', 1, 2, '2021-09-23');

SELECT tasks.name AS name, description, state, categories.name AS category, due_date FROM tasks JOIN categories ON tasks.category = categories.id;

DELETE FROM tasks WHERE id = 35;

ALTER TABLE `tasks` auto_increment = 1;
ALTER TABLE `categories` auto_increment = 1;