<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Formulario de Cadastro de Produtos</title>
</head>

<body>

    <section>

        <form action="" method="post" enctype="multipart/form-data">

            <h1>Envio de Imagens</h1>

            <label for="nome">Nome do Produto</label>
            <input type="text" name="nome" class="sombra">

            <label for="desc">Descrição</label>
            <textarea name="desc" class="sombra"></textarea>

            <label for="valor">Valor</label>
            <input type="text" name="valor" class="sombra">

            <input type="file" name="foto[]" multiple class="sombra meuInput">

            <input type="submit" id="botao">

            <a href="produtos.php" class="sombra">Ver todos os produtos</a>

        </form>

    </section>

</body>
</html>

<?php

if(isset($_POST['nome'])){

    $nome = addslashes($_POST['nome']);
    $valor = addslashes($_POST['valor']);
    $descricao = addslashes($_POST['desc']);
    $nome_arquivo = '';

    //cria o vetor para guardar o nome das fotos se o usuario enviar
    $fotos = array();

    //checa se foi enviada alguma foto
    if(isset($_FILES['foto'])){

        $tipo = '';

        for($i = 0; $i < count($_FILES['foto']['name']); $i++){

            if($_FILES['foto']['type'][$i] == 'image/jpeg'){
                $tipo = ".jpg";

            }else if($_FILES['foto']['type'][$i] == 'image/png'){
                $tipo = ".png";

            }else{
                $tipo = "outro";
            }

            //se o arquivo nao for JPG ou PNG, dispara a mensagem
            if($tipo == "outro"){

                echo "<script>alert('Só é possível enviar arquivos JPG e PNG')</script>";

            }else{

                $nome_arquivo = md5(
                    $_FILES['foto']['name'][$i] . rand(1,999)
                ) . $tipo;

                move_uploaded_file(
                    $_FILES['foto']['tmp_name'][$i],
                    "imagens/" . $nome_arquivo
                );

                array_push($fotos, $nome_arquivo);
            }
        }
    }

    //Verifica se todos os campos foram preenchidos no formulario
    if(!empty($nome) && !empty($valor) && !empty($descricao)){

        require 'classe\Produto.class.php';

        $produto = new Produto();

        $retorno = $produto->conecta();

        if($retorno){

            $produto->enviarProduto(
                $nome,
                $descricao,
                $valor,
                $fotos
            );

            echo "<script>alert('Produto enviado com sucesso!')</script>";

        }else{

            echo "<script>alert('Banco indisponivel. Tente mais tarde!')</script>";

            exit;
        }
    }
}

?>