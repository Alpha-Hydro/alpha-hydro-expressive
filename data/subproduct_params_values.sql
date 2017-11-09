ALTER TABLE subproduct_params_values ADD id INT NOT NULL PRIMARY KEY AUTO_INCREMENT;
CREATE UNIQUE INDEX subproduct_params_values_id_uindex ON subproduct_params_values (id);