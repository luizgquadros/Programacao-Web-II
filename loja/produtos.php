<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'classes/Produto.class.php';
$p = new Produto();
$produtos = $p->listarProdutos();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Produtos Cadastrados</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
    <section class="secao-produtos">
        <a href="index.php" class="sombra">Cadastrar novo produto</a>
        <h1>Produtos Cadastrados</h1>

        <?php if(empty($produtos)): ?>
            <p class="aviso-vazio">Nenhum produto cadastrado ainda.</p>
        <?php else: ?>
            <div class="lista-produtos">
                <?php foreach($produtos as $produto): ?>
                    <div class="produto-card sombra">

                        <?php if(!empty($produto['imagens'])): ?>
                            <div class="produto-fotos">
                                <?php foreach($produto['imagens'] as $img): ?>
                                    <img src="imagens/<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($produto['nome_produto']); ?>">
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="produto-sem-foto">Sem foto</div>
                        <?php endif; ?>

                        <h2><?php echo htmlspecialchars($produto['nome_produto']); ?></h2>
                        <p class="produto-desc"><?php echo nl2br(htmlspecialchars($produto['descricao'])); ?></p>
                        <p class="produto-preco">R$ <?php echo number_format($produto['valor'], 2, ',', '.'); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</body>
</html>