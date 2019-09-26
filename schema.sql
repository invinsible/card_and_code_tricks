CREATE DATABASE cct_db
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE cct_db;

CREATE TABLE tricks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  difficult ENUM("Легко", "Средне", "Тяжело"),
  preparation TINYINT,
  steps TEXT,
  video_link VARCHAR(2000),
  video_author VARCHAR(63),
  views INT,
  reaction ENUM("Хорошо", "Нейтрально", "Плохо"),
  comment TEXT
);

CREATE TABLE techniques (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  difficult ENUM("Легко", "Средне", "Тяжело"),
  description TEXT,
  video_link VARCHAR(2000),
  video_author VARCHAR(63),
  comment TEXT
);


CREATE TABLE requisite (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  availability TINYINT,
  description TEXT,
  amount TINYINT UNSIGNED,
  photo_link VARCHAR(2000),
  comment TEXT
);

CREATE TABLE decks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  availability TINYINT,
  color VARCHAR(63),
  description TEXT,
  amount TINYINT UNSIGNED,
  photo_link VARCHAR(2000),
  comment TEXT
);

CREATE TABLE trick_technique (
    trick_id INT,
    technique_id INT,
    PRIMARY KEY (trick_id, technique_id)
);

CREATE TABLE trick_requisite (
    trick_id INT,
    requisite_id INT,
    PRIMARY KEY (trick_id, requisite_id)
);

/* Индексы для фокусов */
CREATE INDEX difficult ON tricks(difficult);
CREATE INDEX preparation ON tricks(preparation);
CREATE INDEX views ON tricks(views);

/* Индексы для техник, реквизита и колод */
CREATE INDEX difficult ON techniques(difficult);
CREATE INDEX availability ON requisite(availability);
CREATE INDEX availability ON decks(availability);