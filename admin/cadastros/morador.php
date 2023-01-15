<?php
    if(!isset($page)) exit;
    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }

    if(!empty($id)){
        $sql = "select id, criado, modificado, idpessoa where  id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id",$id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);
        $id = $dados->id ?? NULL;
        $idpessoa = $dados->idpessoa ?? NULL;
        $criado = $dados->criado ?? NUll;
        $modificado = $dados->modificado ?? NULL;
    }

?>

<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Cadastrar Morador</h2>
        <div class="float-right">
            <a href="listar/moradores" 
            title="Listar Moradores" 
            class="btn btn-primary">Listar Moradores</a>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/moradores" data-parsley-valdiate="">
            <input type="hidden" readonly name="id" id="id" class="form-control" value="<?=$id?>">

            <div class="alert alert-warning" role="alert">
                Abaixo estão listados apenas as pessoas que não estão definidas como moradores.
            </div>

            <label for="idpessoa">Selecione uma pessoa para cadastrar como morador:</label>
            <select name="idpessoa" id="idpessoa" required data-parsley-required-message="Selecione uma categoria." 
            class="form-control">
                <option value=""></option>
                <?php
                    $sql= "select p.id as id, p.nome as nome from morador m right join pessoa p on m.IDPESSOA = p.ID  where m.id is null";
                    $consultaCategoria = $pdo->prepare($sql);
                    $consultaCategoria->execute();

                    while ($dadosCategoria = $consultaCategoria->fetch(PDO::FETCH_OBJ)){
                        //Separar dados
                        $id = $dadosCategoria->id;
                        $nome = $dadosCategoria->nome;

                        echo "<option value='{$id}'>{$nome}</option>";
                    }
                ?>
            </select>
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar
            </button>
        </form>
    </div>
</div>