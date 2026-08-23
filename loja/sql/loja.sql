CREATE DATABASE loja_etim;
use loja_etim

CREATE TABLE produto(
    id_produto INT AUTO_INCREMENT PRIMARY KEY,
    nome_produto VARCHAR(100),
    descricao TEXT,
    valor DOUBLE
);

CREATE TABLE imagem(
    id_imagem INT AUTO_INCREMENT PRIMARY KEY,
    nome_imagem VARCHAR(100),
    fk_id_produto INT,
    FOREIGN KEY(fk_id_produto)REFERENCES produto(id_produto)
);