ALTER TABLE products ADD category_id INT NOT NULL AFTER id;
CREATE INDEX category_id ON products (category_id);

UPDATE products
  INNER JOIN categories_xref ON products.id = categories_xref.product_id
SET products.category_id = categories_xref.category_id;

ALTER TABLE products ADD FOREIGN KEY (category_id) REFERENCES categories(id);

ALTER TABLE products CHANGE active active TINYINT(1) NOT NULL, CHANGE deleted deleted INT NOT NULL;
ALTER TABLE products ENGINE=InnoDB ;
ALTER TABLE products ENGINE=MyISAM ;