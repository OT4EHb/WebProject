SET foreign_key_checks = 0;
CREATE OR REPLACE TABLE cards(
	card_id MEDIUMINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	card_name VARCHAR(30) NOT NULL,
	card_description TEXT NOT NULL,
	card_img VARCHAR(30) NOT NULL
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
CREATE OR REPLACE TABLE card_info(
	card_id MEDIUMINT UNSIGNED,
	card_gramm SMALLINT UNSIGNED,
	card_price SMALLINT UNSIGNED NOT NULL,
	FOREIGN KEY (card_id) REFERENCES cards (card_id),
	PRIMARY KEY (card_id,card_gramm)
) ENGINE = INNODB;
CREATE OR REPLACE TABLE userss(
	user_id MEDIUMINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(30) NOT NULL,
	pass VARCHAR(256) NOT NULL
) ENGINE = INNODB;
CREATE OR REPLACE TABLE orders(
	order_id MEDIUMINT UNSIGNED PRIMARY KEY,
	company VARCHAR(50) NOT NULL,
	FIO VARCHAR(100) NOT NULL,
	tel VARCHAR(20) NOT NULL,
	email VARCHAR(30) NOT NULL,
	order_date DATE NOT NULL,
	descript TEXT NOT NULL,
	FOREIGN KEY (order_id) REFERENCES userss (user_id)
) ENGINE = INNODB;
CREATE OR REPLACE TABLE order_card(
	order_id MEDIUMINT UNSIGNED,
	card_id MEDIUMINT UNSIGNED,
	card_gramm SMALLINT UNSIGNED,
	size BIGINT UNSIGNED NOT NULL,
	FOREIGN KEY (order_id) REFERENCES orders (order_id),
	FOREIGN KEY (card_id, card_gramm) 
		REFERENCES card_info (card_id, card_gramm),
	PRIMARY KEY (order_id, card_id, card_gramm)
) ENGINE = INNODB;
SET foreign_key_checks = 1;