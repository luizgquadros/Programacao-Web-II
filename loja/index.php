<?php
require 'classe\Produto.class.php';
$produto = new Produto();
$retorno = $retorno->conecta();

if ($retorno) {
    echo "<scrpit>
    alert('Conecatdo ao banco!')
    </script>";
} else {
    echo "Banco indisponível. Tente mais tarde";
}
echo "<h1>";