<div class="card">
    <div class="card-header">
        <h1 class="float-left">Cadastro de Itens</h1>
        <div class="float-right">
            <a href="listar/itens" class="btn btn-primary">
                Listar Itens
            </a>
        </div>
    </div>
    <div class="card-body">
        <form name="formItens" method="post" action="salvar/itens" enctype="multipart/form-data" data-parsley-validate="">
            <input type="hidden" name="id" id="id" readonly class="form-control" value="<?=$id?>">
            <label for="nome">Nome do Item:</label>
            <input type="text" name="nome" id="nome" 
            required data-parsley-required-message="Por favor preencha este campo" 
            class="form-control" value="<?=$nome?>">
            <br>
            <label for="categoria_id">Selecione a Categoria:</label>
            <select name="categoria_id" id="categoria_id" required data-parsley-required-message="Selecione uma categoria." 
            class="form-control">
                <option value=""></option>
                <?php
                    $sql= "select id, descricao from categoria order by descricao";
                    $consultaCategoria = $pdo->prepare($sql);
                    $consultaCategoria->execute();

                    while ($dadosCategoria = $consultaCategoria->fetch(PDO::FETCH_OBJ)){
                        //Separar dados
                        $id = $dadosCategoria->id;
                        $descricao = $dadosCategoria->descricao;

                        echo "<option value='{$id}'>{$descricao}</option>";
                    }
                ?>
            </select>
            <br>
            <label for="valor">Valor do Item:</label>
            <input type="text" name="valor" id="valor"
            required data-parsley-required-message="Preencha o valor" class="form-control valor"
            value="<?=$valor?>"></input>
            <br>
            <label for="ativo">Ativo:</label>
            <select name="ativo" id="ativo" class="form-control" 
            required data-parsley-required-message="Selecione uma Opcao">
                <option value=""></option>
                <option value="S">Sim</option>
                <option value="N">Nao</option>
            </select>
            <br>
            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Salvar</button>
        </form>
    </div>
</div>