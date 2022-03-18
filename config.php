<?php
    $servidor ="localhost";
    $usuario = "root";
    $senha = "";
    $banco = "vitrine";

    try{
        $pdo = new pdo("mysql:host={$servidor};
        dbname={$banco};charset=utf8;",
        $usuario,$senha);

    } catch (Exception $e){
        echo "<p>Erro ao Tentar Conectar!</p>";
        echo $e->getMessage();
    }