CREATE TABLE role
(
  id   INT AUTO_INCREMENT
    PRIMARY KEY,
  name VARCHAR(42) NOT NULL
)
  ENGINE = InnoDB
  COLLATE = utf8_unicode_ci;

INSERT INTO role (name) VALUES ('administrator');
INSERT INTO role (name) VALUES ('editor');
INSERT INTO role (name) VALUES ('manager');
INSERT INTO role (name) VALUES ('user');

CREATE TABLE user
(
  id                      INT AUTO_INCREMENT
    PRIMARY KEY,
  name                    VARCHAR(42)  NULL,
  email                   VARCHAR(42)  NOT NULL,
  phone                   VARCHAR(42)  NULL,
  address                 VARCHAR(255) NULL,
  roleId                  INT          NOT NULL,
  password                VARCHAR(255) NOT NULL,
  status                  INT          NOT NULL,
  dateCreate              DATETIME     NOT NULL,
  pwdResetToken           VARCHAR(255) NULL,
  pwdResetTokenCreateDate DATETIME     NULL,
  CONSTRAINT UNIQ_8D93D649E7927C74
  UNIQUE (email),
  CONSTRAINT FK_8D93D649B8C2FD88
  FOREIGN KEY (roleId) REFERENCES role (id)
)
  ENGINE = InnoDB
  COLLATE = utf8_unicode_ci;

CREATE INDEX IDX_8D93D649B8C2FD88
  ON user (roleId);


