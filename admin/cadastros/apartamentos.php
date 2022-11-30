<?php
    if(!isset($page)) exit;
    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }

?>

<div class="card">
    <div class="card-header">
        <h2 class="float-left">Cadastro de Apartamento</h2>
        <div class="float-right">
            <ul class="nav nav-pills w-auto p-3 ">
                <li class="nav-item dropdown m-3">
                    <a class="nav-link active dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i> Menu</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="cadastros/blocos">Cadastrar blocos habitacionais</a>
                        <a class="dropdown-item" href="cadastros/apartamentos">Cadastrar apartamento</a>
                        <a class="dropdown-item" href="cadastros/lazer">Cadastrar area de lazer</a>
                        <a class="dropdown-item" href="listar/blocos">Listar blocos habitacionais</a>
                        <a class="dropdown-item" href="listar/apartamentos">Listar apartamentos</a>
                        <a class="dropdown-item" href="listar/lazer">Listar areas de lazer</a>

                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/apartamentos" data-parsley-validate="">
            <input type="hidden" readonly name="id" id="id"
            class="form-control" value="<?=$id?>">

            <label for="numeroap">Número do Apartamento:</label>
            <input type="number" name="numeroap" id="numeroap" min="1" max="300"
            class="form-control"  required 
            data-parsley-required-message="Por favor, preencha este campo"
            value="<?=@$numeroap?>">

            <label for="idbloco">Selecione o bloco habitacional do apartamento:</label>
            <select name="idbloco" id="idbloco" required data-parsley-required-message="Selecione um bloco habitacional." 
                class="form-control">
                    <option value=""></option>
                    <?php
                        $sql= "select id, nome from bloco order by nome";
                        $consultaBloco = $pdo->prepare($sql);
                        $consultaBloco->execute();

                        while ($dadosBloco = $consultaBloco->fetch(PDO::FETCH_OBJ)){
                            //Separar dados
                            $id = $dadosBloco->id;
                            $nome = $dadosBloco->nome;
                            echo "<option value='{$id}'>{$nome}</option>";
                        }
                    ?>
                >
            </select>
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar
            </button>
        </form>
    </div>
</div>
<script>
    $("#idbloco").val("<?=$id?>");
</script>