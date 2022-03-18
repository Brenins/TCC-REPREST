<?php
    require "config.php"
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitrine</title>
    <base href="http://localhost/vitrine/">
    <link rel="shortcut icon" href="imagens/icone.png"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/lightbox.min.css">
</head>
<body>
    <header>
        <a href="index.php" title="Home">
            <img src="imagens/logo.png" alt="Adidas" class="margem" >
        </a>
        <nav>
            <ul>
                <li>
                    <a href="index.php">Home <i class="fa-solid fa-house"></i></a>
                </li>
                <?php
                    //Selecionar todas as categorias
                    $sql = "select * from categoria order by nome";
                    //Preparar o sql para execucao
                    $consulta = $pdo->prepare($sql);
                    //Executar
                    $consulta->execute();

                    while ($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                        //Separar os dados
                        $id = $dados -> id;
                        $nome = $dados-> nome;
                        ?>
                        <li>
                            <a href="categoria/<?=$id?>">
                            <?=$nome?>
                            </a>
                        </li>
                        <?php
                    }
                ?>
                <li>
                    <a href="Contato">Contato</a>
                </li>
            </ul>
        </nav>
    </header>
    <?php
        $pagina = "home";
        // verificar se esta enviando o $getparam

        if (isset($_GET["param"])){
            $pagina = $_GET["param"];
            $p = explode("/",$pagina);
            $pagina = $p[0];
        }
        
        //caminho pagina
        $pagina = "paginas/{$pagina}.php";
        //verificar se o caminho existe

        if (file_exists($pagina)){
            require $pagina;
        }else {
            require "paginas/erro.php";
        }
    ?>

    <footer>
        <p>Desenvolvido Por Brenins</p>
    </footer>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/lightbox.min.js"></script>
    </body>
</html>