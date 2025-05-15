CREATE OR REPLACE TABLE cards(
	card_id MEDIUMINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	card_name VARCHAR(30) NOT NULL,
	card_description TEXT NOT NULL
) ENGINE = INNODB;
CREATE OR REPLACE TABLE animals(
	animal_id SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	animal_name VARCHAR(10) NOT NULL
) ENGINE = INNODB;
INSERT INTO animals VALUES
	(0,'fish'),
	(0,'turtle'),
	(0,'spider'),
	(0,'bird');
CREATE OR REPLACE TABLE card_animal(
	card_id MEDIUMINT UNSIGNED,
	animal_id SMALLINT UNSIGNED,
	FOREIGN KEY (card_id) REFERENCES cards (card_id),
	FOREIGN KEY (animal_id) REFERENCES animals (animal_id),
	PRIMARY KEY (card_id, animal_id)
) ENGINE = INNODB;