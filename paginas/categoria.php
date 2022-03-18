<main>
    <?php
        //recuperar id categoria
        $id = $p[1] ?? NULL;

        //VERIFICAR SE O ID ESTA VAZIO
        if(empty($id)){
            ?>
            <h1>ERRO</h1>
            <h2 class="center">Categoria invalida</h2>
            <?php
        }else{

            //selecionar a categoria com o id
            $sql = "select nome from categoria where id = :id limit 1";

            $consultaCategoria = $pdo->prepare($sql);
            $consultaCategoria->bindParam(":id", $id);
            $consultaCategoria->execute();
            $dados = $consultaCategoria->fetch(PDO::FETCH_OBJ);

            $nome = $dados->nome;

            echo "<h1>{$nome}</h1>";


            //Selecionar os produtos da categoria

            $sql = "select * from produto where CATEGORIA_ID = :id order by nome";

            $consulta = $pdo ->prepare($sql);

            $consulta->bindParam(":id", $id);

            $consulta->execute();
            ?>

            <div class="grid">
                <?php
                    while($dados= $consulta->fetch(PDO::FETCH_OBJ)){
                        //Separa os dados
                        $id = $dados->id;
                        $nome = $dados->nome;
                        $valor = $dados->valor;
                        $imagem1 = $dados->imagem1;

                        $valor = number_format($valor,2,",",".");

                        echo "<div class='coluna'>
                        <img src='produtos/{$imagem1}'>
                        <h2>{$nome}</h2>
                        <p class='valor'>
                        R$ {$valor}
                        </p>
                        <p>
                            <a href='produto/{$id}' class='btn btn-primary'>Detalhes <i class='fa-solid fa-magnifying-glass'></i></a>
                        </p>
                        </div>";
                    }
                    
                ?>
            </div>
            <?php
        }
        ?>
</main>