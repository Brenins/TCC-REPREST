<div class="banner">
    <?php
        //selecionar os daos do banner
        $sql = "select * from banner order by rand() limit 1";
        $consulta = $pdo->prepare($sql);

        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        //Separar o dado necessario

        $banner = $dados->banner;
    ?>
    <img src="imagens/<?=$banner?>" alt="banner">
</div>
<main>
    <br>
    <h1>Produtos em Destaque</h1>
    <br>
    <div class="grid">
        <?php
            //Selecionar produtos vitrine
            $sql= "select * from produto order by rand() limit 6";
            //Preparar sql exec
            $consulta = $pdo->prepare($sql);
            //executar sql

            $consulta->execute();
            while ($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                $id = $dados->id;
                $nome = $dados->nome;
                $valor = $dados->valor;
                $imagem1 = $dados->imagem1;

                $valor = number_format($valor,2,",",".")
                ?>
                <div class="coluna">
                    <img src="produtos/<?=$imagem1?>">
                    <h2><?=$nome?></h2>
                    <p class="valor">
                        R$<?=$valor?>
                    </p>
                    <p>
                        <a href='produto/<?=$id?>' class='btn btn-primary'>Detalhes <i class="fa-solid fa-magnifying-glass"></i></a>
                    </p>
                </div>
                <?PHP
            }//FIM DO WHILE
        ?>
    </div>
    <br>
</main>