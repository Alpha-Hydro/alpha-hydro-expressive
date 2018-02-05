ALTER TABLE subproduct_params_values ADD id INT NOT NULL PRIMARY KEY AUTO_INCREMENT;
CREATE UNIQUE INDEX subproduct_params_values_id_uindex ON subproduct_params_values (id);

ALTER TABLE db1057313_ah2018.categories_xref ENGINE=InnoDB;
ALTER TABLE db1057313_ah2018.categoryIndex ENGINE=InnoDB;
ALTER TABLE db1057313_ah2018.forum ENGINE=InnoDB;
ALTER TABLE db1057313_ah2018.media ENGINE=InnoDB;
ALTER TABLE db1057313_ah2018.media_categories ENGINE=InnoDB;
ALTER TABLE db1057313_ah2018.productIndex ENGINE=InnoDB;
ALTER TABLE db1057313_ah2018.product_params ENGINE=InnoDB;
ALTER TABLE db1057313_ah2018.subproducts ENGINE=InnoDB;
ALTER TABLE db1057313_ah2018.subproduct_params ENGINE=InnoDB;