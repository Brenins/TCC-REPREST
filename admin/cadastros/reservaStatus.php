<?php
    if ( !isset ( $page ) ) exit;

    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }

?>
<div class="card">
    <div class="card-header">
        <h2 class="float-left">
            Alterando status da reserva
        </h2>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/reserva" data-parsley-validate="">
            <input type="hidden" readonly name="id" id="id"
            class="form-control" value="<?=$id?>">

            <label for="status">Selecione o status:</label>
            <select name="status" id="status" required data-parsley-required-message="Selecione um iyem." 
            class="form-control">
                <option value=""></option>
                <?php
                    $sql= "select id, status from status s order by id";
                    $consulta = $pdo->prepare($sql);
                    $consulta->execute();

                    while ($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                        //Separar dados
                        $id = $dados->id;
                        $status = $dados->status;
                        echo "<option value='{$id}'>$status</option>";
                    }
                ?>
            </select>
            <label for="obs">Observações:</label>
            <input type="text" name="obs" id="obs"
            class="form-control"
            value="<?=@$obs?>">

            <br>
            
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar
            </button>
        </form>
    </div>
</div>