<?php
//Para fazer a conexao com o BD
include "conexao.php";

//Recebe os dados vindos do formulario de cadastro
$nome = $_POST["nomeProduto"];
$valor = $_POST["valorProduto"];


//Insercao com o Banco
$SQL = "INSERT INTO produtos (nome_produto, valor_produto)
     VALUES ('$nome', '$valor')";

$conn->query($SQL) or die($conn->error);
?>
<script>
    alert('Cadastro do produto realizado com sucesso!');
    window.location = 'cadastro_produtos.php';
</script>