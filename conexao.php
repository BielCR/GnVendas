<?php
    session_start();

    //Parametros para acesso ao BD
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $nomeBD = "gn_vendas";
    $conn = new mysqli($servidor, $usuario, $senha, $nomeBD);

    //Verificando a conexão
    if ($conn->connect_error) {
	    die("Falha na conexão: " . $conn->connect_error);
	} 
?>