create database wiki;


CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    image VARCHAR(255),
    status int ,
    role_id INT,
    FOREIGN KEY (role_id) REFERENCES role(id)
);

CREATE TABLE role (
    id INT PRIMARY KEY AUTO_INCREMENT,
    roleName VARCHAR(255)
);


CREATE TABLE tag (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tagName VARCHAR(255)
);


CREATE TABLE category (
    id INT PRIMARY KEY AUTO_INCREMENT,
    categoryName VARCHAR(255)
);




CREATE TABLE wiki (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    content TEXT,
    image VARCHAR(255),
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES category(id)
);

CREATE TABLE wiki_tag (
    wiki_id INT,
    tag_id INT,
    FOREIGN KEY (wiki_id) REFERENCES wiki(id),
    FOREIGN KEY (tag_id) REFERENCES tag(id),
    PRIMARY KEY (wiki_id, tag_id)
);