<?php
//inlcui o arquivo de conexão
include "conexao.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produtos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script type="text/javascript">
        var idProduto = "";
        function valorId(id) {
            document.getElementById('idProduto').value = id;
        }
    </script>
</head>

<body>
    <!--incluindo a navbar de navegacao-->
    <?php
    include "navbar.php";
    ?>
    <!--Background-->
    <div style="background-color: white;">
        <!--bloco principal da pagina-->
        <div style="background-color: rgb(239, 244, 245); border-radius: 10px;" class="container-fluid m-2 p-2">
            <form name="formCadastro" action="compras.php" method="POST" class="need-validation ">

                <!--Executando o select de todos os produtos-->
                <?php
                $SQL = "SELECT * FROM produtos ORDER BY id_produto";
                $query = $conn->query($SQL);
                ?>

                <h5>Antes, digite seu dados:</h5>
                <label for="nomePessoa">Nome completo: </label>
                <input type="text" name="nomePessoa" id="nomePessoa" class="form-control" required>
                <label for="cpf">CPF: </label>
                <input type="number" name="cpf" id="cpf" class="form-control" required>
                <label for="telefone">Telefonde de contato: </label>
                <input type="number" name="telefone" id="telefone" class="form-control" required>
                <input type="hidden" name="idProduto" id="idProduto" value="">
                <br>

                <p class="h4">Tabela de produtos</p>
                <table class="table table-striped bg-white table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Produto</th>
                            <th class="text-center"></th>
                         
                        </tr>
                    </thead>
                    <!--exibindo todos os registros da consulta -->
                    <?php
                    while ($exibir = $query->fetch_assoc()) {
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $exibir["nome_produto"] ?></td>
                           
                            <td class="text-center">
                                <button type="submit" class="btn-success btn form-control" onclick="valorId('<?php echo $exibir['id_produto'];?>')">Comprar</button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </form>

        </div>
    </div>
</body>

</html>