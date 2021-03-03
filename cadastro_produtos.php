<?php
include "conexao.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produtos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
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
            <form name="formCadastro" action="cadastro_bd.php" method="POST" class="need-validation ">
                <h1 class="text-center">Cadastro de novos produtos</h1>
                <label for="nomeProduto" class="h5">Nome do produto:</label>
                <input type="text" name="nomeProduto" id="nomeProduto" class="form-control form-group" required>
                <label for="valorProduto" class="h5">Valor do produto:</label>
                <input type="number" name="valorProduto" id="valorProduto" step="0.01" min="0.01" class="form-control form-group" required>
                <!--buttons de envio e cancelamento-->
                <button type="submit" class="btn btn-primary form-group">Cadastrar</button>
                <button type="reset" class="btn btn-danger form-group">Cancelar</button>
            </form>

        </div>
    </div>
</body>

</html>