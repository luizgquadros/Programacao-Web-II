<?php

class Produto{

    private $id_produto;
    private $nome;
    private $descricao;
    private $valor;
    private $pdo;

    public function conecta(){

        try{

            $dns = "mysql:dbname=loja;host=localhost";

            $dbUser = "root";

            $dbPass = "887766";

            $this->pdo = new PDO(
                $dns,
                $dbUser,
                $dbPass
            );

            return true;

        }catch(\Throwable $th){

            return false;
        }
    }

    public function enviarProduto(
        $nome,
        $descricao,
        $valor,
        $fotos = array()
    ){

        #inserir Produto na tabela produtos
        #=================================

        $sql = "INSERT INTO produtos SET
                nome_produto = :p,
                valor = :v,
                descricao = :d";

        $sql = $this->pdo->prepare($sql);

        $sql->bindValue(":p", $nome);
        $sql->bindValue(":v", $valor);
        $sql->bindValue(":d", $descricao);

        if($sql->execute()){

            $id_produto = $this->pdo->lastInsertId();
        }

        #inserir Imagem na tabela imagens
        #================================

        if(count($fotos) > 0){

            for($i = 0; $i < count($fotos); $i++){

                $nome_foto = $fotos[$i];

                $sql = "INSERT INTO imagens
                        (nome_imagem, fk_id_produto)
                        VALUES (:n, :fk)";

                //$sql = "INSERT INTO imagens SET
                //nome_imagem = :n, fk_id_produto = :fk";

                $sql = $this->pdo->prepare($sql);

                $sql->bindValue(":n", $nome_foto);

                $sql->bindValue(":fk", $id_produto);

                $sql->execute();
            }
        }
    }

    public function buscarProdutos(){

        $sql = "SELECT *,
                (SELECT nome_imagem
                 FROM imagens
                 WHERE fk_id_produto = produtos.id_produto
                 LIMIT 1) AS foto_capa
                FROM produtos";

        $sql = $this->pdo->query($sql);

        if($sql->rowCount() > 0){

            return $sql->fetchAll();

        }else{

            return array();
        }
    }

    public function buscarProduto($id_produto){

        $sql = "SELECT * FROM produtos
                WHERE id_produto = :id";

        $sql = $this->pdo->prepare($sql);

        $sql->bindValue(":id", $id_produto);

        $sql->execute();

        if($sql->rowCount() > 0){

            return $sql->fetch();

        }else{

            return array();
        }
    }

    public function buscarImagem($id){

        $sql = "SELECT * FROM imagens
                WHERE fk_id_produto = :id";

        $sql = $this->pdo->prepare($sql);

        $sql->bindValue(":id", $id);

        $sql->execute();

        if($sql->rowCount() > 0){

            return $sql->fetchAll();

        }else{

            return array();
        }
    }

    public function deletarProduto($id_produto){

        // O conteúdo interno dessa função está recolhido
        // na imagem do PDF.

    }

}