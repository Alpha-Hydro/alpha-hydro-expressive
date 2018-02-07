ALTER TABLE categories CHANGE parent_id parent_id BIGINT NOT NULL, CHANGE active active TINYINT(1) NOT NULL, CHANGE sorting sorting
  INT NOT NULL, CHANGE deleted deleted INT NOT NULL;

ALTER TABLE categories ENGINE=InnoDB;

DROP INDEX `order` ON categories;
ALTER TABLE categories MODIFY `order` INT(11);
ALTER TABLE categories MODIFY generate INT(11);
ALTER TABLE categories MODIFY active INT(11) NOT NULL;
ALTER TABLE categories MODIFY meta_description TEXT;

ALTER TABLE categories DROP `order`;

DROP INDEX `parent_id` ON categories;
ALTER TABLE categories MODIFY parent_id INT(11);