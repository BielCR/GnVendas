<?php
//Para fazer a conexao com o BD
include "conexao.php";

//Recebe os dados vindos do formulario de cadastro
$nomeComprador = $_POST["nomePessoa"];
$cpf = $_POST["cpf"];
$telefone = $_POST["telefone"];
$idProduto = $_POST["idProduto"];



//pesquisa do item que está sendo comprado
$sqlProduto = "SELECT * FROM produtos WHERE id_produto = '{$idProduto}'";
$query = $conn->query($sqlProduto) or die($conn->error);
$produto = $query->fetch_assoc();






//Insercao com o Banco
$SQL = "INSERT INTO compras (linkPdf  , idBoleto )
     VALUES ('$nome', '$valor');";

$conn->query($SQL) or die($conn->error);
?>
<script>
    alert('Cadastro do produto realizado com sucesso!');
    window.location = 'cadastro_produtos.php';
</script>



<?php
 
require __DIR__.'/vendor/autoload.php'; // caminho relacionado a SDK
 
use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;
 
$clientId = 'Client_Id_4e4327e045ceb277ed5f62db8c46c399c309e0bf'; // insira seu Client_Id, conforme o ambiente (Des ou Prod)
$clientSecret = 'Client_Secret_bb1ad596c70e1c17089cd27ec860816670412681'; // insira seu Client_Secret, conforme o ambiente (Des ou Prod)
 
$options = [
  'client_id' => $clientId,
  'client_secret' => $clientSecret,
  'sandbox' => true // altere conforme o ambiente (true = desenvolvimento e false = producao)
];
 
$item_1 = [
    'name' => $produto["nome_produto"], // nome do item, produto ou serviço
    'amount' => 1, // quantidade
    'value' => $produto["valor_produto"] // valor (1000 = R$ 10,00) (Obs: É possível a criação de itens com valores negativos. Porém, o valor total da fatura deve ser superior ao valor mínimo para geração de transações.)
];
 
 
$items =  [
    $item_1,
];

// Exemplo para receber notificações da alteração do status da transação:
// $metadata = ['notification_url'=>'sua_url_de_notificacao_.com.br']
// Outros detalhes em: https://dev.gerencianet.com.br/docs/notificacoes

// Como enviar seu $body com o $metadata
// $body  =  [
//    'items' => $items,
//    'metadata' => $metadata
// ];

$body  =  [
    'items' => $items
];

try {
    $api = new Gerencianet($options);
    $charge = $api->createCharge([], $body);
 
    print_r($charge);
} catch (GerencianetException $e) {
    print_r($e->code);
    print_r($e->error);
    print_r($e->errorDescription);
} catch (Exception $e) {
    print_r($e->getMessage());
}