<main>
    <?php
        $id = $p[1] ?? NULL;

        if(empty($id)){
            ?>
            <h1>Erro no produto.</h1>
            <p>Produto nao encontrado</p>
            <?php
        }else{
            $sql = "select * from produto where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":id",$id);
            $consulta->execute();

            $dados = $consulta->fetch(PDO::FETCH_OBJ);

            $nome = $dados->nome;
            $valor = $dados->valor;
            $descricao = $dados->descricao;
            $imagem1 = $dados->imagem1;
            $imagem2 = $dados->imagem2;
            ?>
            <br>
            <h1><?=$nome?></h1>
            <div class="grid-produtos">
                <div class="coluna">
                    <a href="produtos/<?=$imagem1?>" title="imagem1" data-lightbox="Foto">
                        <img src="produtos/<?=$imagem1?>" alt="Imagem 1">
                    </a>
                    <p></p>
                    <a href="produtos/<?=$imagem2?>" title="imagem2" data-lightbox="Foto">
                        <img src="produtos/<?=$imagem2?>" alt="Imagem 2">
                    </a>
                </div>
                <div class="coluna">
                    <h3>Descricao do produto:</h3>
                    <?=$descricao?>
                </div>

            </div>


            <?php

        }

    ?>


</main>