ALTER TABLE categories CHANGE parent_id parent_id BIGINT NOT NULL, CHANGE active active TINYINT(1) NOT NULL, CHANGE sorting sorting
  INT NOT NULL, CHANGE deleted deleted INT NOT NULL;

ALTER TABLE categories ENGINE=InnoDB;