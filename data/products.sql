ALTER TABLE products ADD category_id INT NOT NULL AFTER id;
CREATE INDEX category_id ON products (category_id);

UPDATE products
  INNER JOIN categories_xref ON products.id = categories_xref.product_id
SET products.category_id = categories_xref.category_id;