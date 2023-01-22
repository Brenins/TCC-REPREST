<?php
     if(!isset($page)) exit;
     foreach($_POST as $key => $value){
         $$key = trim ($value ?? NULL);
    }

    if(!empty($id)){
        $sql = "select id, dtemprestimo , dtdevolucao, iditem, idstatus  from emprestimo e where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id",$id);
        $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_OBJ);
        
        if($dados->idstatus == 2){
            mensagemErro("Não é possivel atualizar registros finalizados!");
        }
    }


?>

<div class="card shadow">
    <div class="card-header">
        <h2 class="float-left">Atualização de status</h2>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/statusEmprestimo" data-parsley-validate="">
            <input type="hidden" readonly name="idemprestimo" id="idemprestimo"
            class="form-control" value="<?=$id?>">
            
            <input type="hidden" readonly name="iditem" id="iditem"
            class="form-control" value="<?=$dados->iditem?>">

            <label for="idstatus">Selecione o status do empréstimo:</label>
            <select name="idstatus" id="idstatus" required data-parsley-required-message="Selecione um status." 
            class="form-control">
                <option value=""></option>
                <?php
                    $sql= "select id, status from status";
                    $consultaCategoria = $pdo->prepare($sql);
                    $consultaCategoria->execute();

                    while ($dadosCategoria = $consultaCategoria->fetch(PDO::FETCH_OBJ)){
                        //Separar dados
                        $id = $dadosCategoria->id;
                        $status = $dadosCategoria->status;
                        echo "<option value='{$id}'>{$status}</option>";
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