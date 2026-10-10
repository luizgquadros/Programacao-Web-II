<?php

require "classe/Produto.class.php";

$produto = new Produto();

if(!$produto->conecta()){

    echo "<script>alert('Erro ao conectar com o banco de dados');</script>";

    exit;
}

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = $_GET['id'];

    $dadosDoProduto = $produto->buscarProduto($id);

    $imagensDoProduto = $produto->buscarImagem($id);

    /*
    echo "<pre>";
    print_r($dadosDoProduto);
    */

}else{

    echo "<script>alert('Produto não encontrado');</script>";

    exit;
}

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Exibir Produto</title>

    <link rel="stylesheet" href="css/exibir.css">

</head>

<body>

    <section>

        <h1>
            <?php echo $dadosDoProduto['nome_produto']; ?>
        </h1>

        <h2>
            <?php
                echo "R$ " .
                number_format(
                    $dadosDoProduto['valor'],
                    2,
                    ',',
                    '.'
                );
            ?>
        </h2>

        <p>
            <span>Descrição:</span>
            <?php echo $dadosDoProduto['descricao']; ?>
        </p>

        <?php foreach($imagensDoProduto as $imagem): ?>

            <div class="caixa-img">

                <img src="imagens/<?php echo $imagem['nome_imagem']; ?>">

            </div>

        <?php endforeach; ?>

    </section>

</body>

</html>