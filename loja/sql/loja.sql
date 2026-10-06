CREATE DATABASE loja;
use loja

CREATE TABLE produtos(
    id_produto INT AUTO_INCREMENT PRIMARY KEY,
    nome_produto VARCHAR(100),
    descricao TEXT,
    valor DOUBLE
);

CREATE TABLE imagens(
    id_imagem INT AUTO_INCREMENT PRIMARY KEY,
    nome_imagem VARCHAR(100),
    fk_id_produto INT,
    FOREIGN KEY(fk_id_produto)REFERENCES produtos(id_produto)
);

DELETE FROM imagens WHERE fk_id_produto = 6;

DELETE FROM produtos WHERE id_produto = 10;