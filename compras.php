<?php
//Para fazer a conexao com o BD
include "conexao.php";

//Recebe os dados vindos do formulario de compra
$nomeComprador = (string)$_POST["nomePessoa"];
$cpf = $_POST["cpf"];
$telefone = $_POST["telefone"];
$idProduto = $_POST["idProduto"];



//pesquisa do item que está sendo comprado
$sqlProduto = "SELECT * FROM produtos WHERE id_produto = '{$idProduto}';";
$query = $conn->query($sqlProduto) or die($conn->error);
$produto = $query->fetch_assoc();
//salvando os valores em variaveis separadas
$nomeProduto = $produto["nome_produto"];
$valorProduto = (int)$produto["valor_produto"];
//multiplicando os valores decimais
$valorProduto = $valorProduto * 100;

$doisdias = new DateInterval('P1D');
$emissao = new DateTime();
$validade = $emissao->add($doisdias);
$validade = $validade->format("Y-m-d");
?>
<?php
   require __DIR__ . '/vendor/autoload.php'; // caminho relacionado a SDK

   use Gerencianet\Exception\GerencianetException;
   use Gerencianet\Gerencianet;

   $clientId = 'Client_Id_4e4327e045ceb277ed5f62db8c46c399c309e0bf';// insira seu Client_Id, conforme o ambiente (Des ou Prod)
   $clientSecret = 'Client_Secret_bb1ad596c70e1c17089cd27ec860816670412681'; // insira seu Client_Secret, conforme o ambiente (Des ou Prod)

    $options = [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'sandbox' => true // altere conforme o ambiente (true = homologação e false = producao)
    ];
    
   $item_1 = [
       'name' => $nomeProduto, // nome do item, produto ou serviço
       'amount' => 1, // quantidade
       'value' => $valorProduto // valor (1000 = R$ 10,00) (Obs: É possível a criação de itens com valores negativos. Porém, o valor total da fatura deve ser superior ao valor mínimo para geração de transações.)
   ];
   $items = [
       $item_1
   ];
   $customer = [
       'name' => $nomeComprador, // nome do cliente
       'cpf' => $cpf , // cpf válido do cliente
       'phone_number' => $telefone // telefone do cliente
   ];
   $discount = [ // configuração de descontos
       'type' => 'currency', // tipo de desconto a ser aplicado
       'value' => 1 // valor de desconto 
   ];
   $configurations = [ // configurações de juros e mora
       'fine' => 200, // porcentagem de multa
       'interest' => 33 // porcentagem de juros
   ];
   $conditional_discount = [ // configurações de desconto condicional
       'type' => 'percentage', // seleção do tipo de desconto 
       'value' => 1, // porcentagem de desconto
       'until_date' => $validade // data máxima para aplicação do desconto
   ];
   $bankingBillet = [
       'expire_at' => $validade, // data de vencimento do titulo
       'message' => 'teste\nteste\nteste\nteste', // mensagem a ser exibida no boleto
       'customer' => $customer,
       'discount' =>$discount,
       'conditional_discount' => $conditional_discount
   ];
   $payment = [
       'banking_billet' => $bankingBillet // forma de pagamento (banking_billet = boleto)
   ];
   $body = [
       'items' => $items,
       'payment' => $payment
   ];
   try {
     $api = new Gerencianet($options);
     $pay_charge = $api->oneStep([],$body);
     $pdfBoleto = $pay_charge["data"]["pdf"]["charge"];
     $idBoleto = $pay_charge["data"]["charge_id"];
     
     //salvando dados da compra no banco de dados
     $SQL = "INSERT INTO compras (id_boleto, link_pdf, id_produto)
     VALUES ('$idBoleto', '$pdfBoleto', '$idProduto')";
     //executando a sql
     $conn->query($SQL) or die($conn->error);
    header("Location: ".$pdfBoleto);


    } catch (GerencianetException $e) {
       print_r($e->code);
       print_r($e->error);
       print_r($e->errorDescription);
   } catch (Exception $e) {
       print_r($e->getMessage());
   }
   ?>

