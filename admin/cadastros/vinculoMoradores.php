<?php
    if(!isset($page)) exit;
    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }
    
    if(!empty($id)){
        $sql = "select id, numeroap,idbloco from apartamento a where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id",$id);
        $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        $idAp = $dados->id;
        $numApartamento = $dados->numeroap;
        $idBloco = $dados->idbloco;
    }
?>
<div class="card shadow">
    <div class="card-header">
        <h2 class="float-left">Vínculo de morador</h2>
        <div class="float-right">
        <a href="listar/apartamentos" title="Listar apartamentos"
            class="btn btn-primary">
                Listar Apartamentos
            </a>
        </div>
    </div>
    <div class="card-body">
        <?php
            if(empty($id)){
                echo "<div class='alert alert-warning' role='alert'> Abaixo estão listados apenas os moradores que não estão vinculados a um apartamento e os apartamentos que estão vazios.</div> ";
            }
        ?>
        <form name="formCadastro" method="post" action="salvar/vinculoMoradores" data-parsley-validate="">
            <input type="hidden" readonly name="id" id="id"
            class="form-control" value="<?=$id?>">

            <label for="idApartamento">Selecione o apartamento:</label>
            <select name="idApartamento" id="idApartamento" required data-parsley-required-message="Selecione um apartamento." 
                class="form-control">
                    <option value=""></option>
                    <?php

                        if(!empty($id)){
                            $sql = "select a.ID as id, a.NUMEROAP as apartamento, 
                            b.NOME as bloco from apartamento a 
                            join bloco b on b.id = a.IDBLOCO where a.id = :id
                            limit 1";
                            $consulta = $pdo->prepare($sql);
                            $consulta->bindParam(":id",$id);
                        }else{
                            $sql= "select a.ID as id, a.NUMEROAP as apartamento, 
                            b.NOME as bloco from apartamento a 
                            join bloco b on b.id = a.IDBLOCO where a.IDMORADOR is null 
                            order by b.nome, a.NUMEROAP";
                            $consulta = $pdo->prepare($sql);
                        }
                        $consulta->execute();
                        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                            //Separar dados
                            $id = $dados->id;
                            $ap = $dados->apartamento;
                            $bloco = $dados->bloco;
                            echo "<option value='{$id}'>$ap - $bloco</option>";
                        }
                    ?>
                >
            </select>

            <label for="morador">Selecione o morador:</label>
            <select name="morador" id="morador" required data-parsley-required-message="Selecione o morador atual." 
                class="form-control">
                    <option value=""></option>
                    <?php
                        $sql= "select m.id as id, p.NOME as nome  from morador m join pessoa p on 
                        m.IDPESSOA = p.ID where m.ATIVO ='S' order by 1;";
                        $consulta = $pdo->prepare($sql);
                        $consulta->execute();
                        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                            //Separar dados
                            $id = $dados->id;
                            $nome = $dados->nome;
                            echo "<option value='{$id}'>$nome</option>";
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
    $("#idApartamento").val("<?=$idAp?>");
</script>