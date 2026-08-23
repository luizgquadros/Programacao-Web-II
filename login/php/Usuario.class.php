<?php

class Usuario{
    private $id;
    private $email;
    private $nome;
    private $senha;
    private $pdo;

    function conectar(){
        $dns      = "mysql:dbname=etim;host=localhost"; 
        $userName = "root";
        $userPass = "";

        try {
            $this->pdo = new PDO($dns, $userName, $userPass);
            return true;
        } catch (\Throwable $th) {    
            return false;
        }
    }
    
    function inserirUsuario($nome, $email, $senha){ 
        $sql = "INSERT INTO usuario SET nome = :n, email = :e, senha = :s";
        $stmt = $this->pdo->prepare($sql);    
        $stmt->bindValue(":e", $email);
        $stmt->bindValue(":n", $nome);
        $stmt->bindValue(":s", $senha);

        return $stmt->execute();
    }

    function buscarUsuario($email, $senha){
        $sql = "SELECT * FROM usuario WHERE email = :e AND senha = :s";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":e", $email);
        $stmt->bindValue(":s", $senha);
        $stmt->execute();

        return $stmt->fetch();
    }

    function listarUsuarios ($id){
        //terminar
    }

    function listarUsuario ($id){
        $sql = "SELECT * FROM usuario WHERE id = :i";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":i", $id);

        $stmt->execute();
        if ($stmt->rowCount() > 0){
            return $stmt->fetch();
        }else {
            return array();
        }
    }    
}