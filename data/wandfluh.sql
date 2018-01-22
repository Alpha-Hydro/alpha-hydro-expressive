ALTER TABLE wf_category ADD path VARCHAR(128) NULL;
ALTER TABLE wf_category ADD full_path VARCHAR(128) NULL;
ALTER TABLE wf_category ADD active TINYINT(1) DEFAULT 1 NOT NULL;
ALTER TABLE wf_category ADD sorting INT(11) DEFAULT 0 NOT NULL;
ALTER TABLE wf_category ADD deleted TINYINT(1) DEFAULT 0 NOT NULL;
ALTER TABLE wf_category ADD meta_description TEXT NULL;
ALTER TABLE wf_category ADD meta_keywords VARCHAR(255) NULL;
ALTER TABLE wf_category ADD meta_title VARCHAR(255) NULL;
ALTER TABLE wf_category ADD content_markdown TEXT NULL;
ALTER TABLE wf_category ADD content_html TEXT NULL;
ALTER TABLE wf_category MODIFY description TEXT;

ALTER TABLE wf_product ADD image VARCHAR(128) NULL;
ALTER TABLE wf_product ADD description TEXT NULL;
ALTER TABLE wf_product ADD content_markdown TEXT NULL;
ALTER TABLE wf_product ADD content_html TEXT NULL;
ALTER TABLE wf_product ADD path VARCHAR(128) NULL;
ALTER TABLE wf_product ADD full_path VARCHAR(128) NULL;
ALTER TABLE wf_product ADD active TINYINT DEFAULT 1 NOT NULL;
ALTER TABLE wf_product ADD deleted TINYINT DEFAULT 0 NOT NULL;
ALTER TABLE wf_product ADD sorting INT(11) DEFAULT 0 NOT NULL;
ALTER TABLE wf_product ADD meta_description TEXT NULL;
ALTER TABLE wf_product ADD meta_keywords VARCHAR(255) NULL;
ALTER TABLE wf_product ADD meta_title VARCHAR(255) NULL;
ALTER TABLE wf_product MODIFY name VARCHAR(255) NOT NULL;

INSERT INTO pages VALUES ('', 'wandfluh', 'Гидроаппаратура Wandfluh', NULL, NULL, NULL, 'Гидроаппаратура Wandfluh', NULL, NULL, 0, 1, 0, NULL, now());

/*Убираем кавычки*/
UPDATE wf_category SET name = REPLACE(name, '\"', '');
UPDATE wf_category SET image = REPLACE(image, '\"', '');

CREATE UNIQUE INDEX wf_category_full_path_uindex ON wf_category (full_path);
ALTER TABLE wf_category MODIFY path VARCHAR(128) NOT NULL;
ALTER TABLE wf_category MODIFY full_path VARCHAR(128) NOT NULL;

UPDATE wf_product SET data_sheet_no = REPLACE(data_sheet_no, '\"', '');
UPDATE wf_product SET data_sheet_pdf = REPLACE(data_sheet_pdf, '\"', '');

UPDATE wf_product_construction SET name = REPLACE(name, '\"', '');
UPDATE wf_product_control SET name = REPLACE(name, '\"', '');
UPDATE wf_product_size SET name = REPLACE(name, '\"', '');
UPDATE wf_product_type SET name = REPLACE(name, '\"', '');

UPDATE wf_category_properties SET value = REPLACE(value, '\"', '');