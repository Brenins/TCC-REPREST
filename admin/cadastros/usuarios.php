<?php
    if(!isset($page)) exit;

    $login = $senha = $ativo = NULL;
?>

<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Criação de Usuário</h2>
    </div>
    <div class="card-body">
        <?php
            if(empty($id)){
                echo "<div class='alert alert-warning' role='alert'> Abaixo estão listados apenas os funcionarios que não possuem um usuário cadastrado.</div> ";
            }
        ?>
        
        <form name="formCadastro" method="post" action="salvar/usuarios" data-parsley-valdiate="">            
            <input type="hidden" readonly name="id" id="id" class="form-control" value="<?=$id?>">

            <label for="idfuncionario">Selecione um Funcionário:</label>
            <select name="idfuncionario" id="idfuncionario" required data-parsley-required-message="Selecione uma pessoa." 
                class="form-control" > 
                    <option  value=""></option>
                    <?php
                        if(!empty($id)){
                            $sql = "select f.id as id, p.NOME as nome, f.login as login, f.ATIVO as ativo, f.CRIADO as criado  from funcionario f join pessoa p on f.IDPESSOA  = p.ID where f.id = :id limit 1";
                            $consulta = $pdo->prepare($sql);
                            $consulta->bindParam(":id",$id);
                            $consulta->execute();
                    
                            $dados = $consulta->fetch(PDO::FETCH_OBJ);
                            $id = $dados->id;
                            $login = $dados->login;
                            $criado = $dados->criado;
                            $fnome = $dados->nome;

                            echo "<option value='{$id}'>{$fnome}</option>";
                        }else{

                            $sql= "select f.ID as id, p.NOME as nome  from funcionario f join pessoa p on f.IDPESSOA = p.ID where f.ATIVO = 'S' and login is null";
                            $consultaPessoa = $pdo->prepare($sql);
                            $consultaPessoa->execute();
    
                            while ($dadosPessoa = $consultaPessoa->fetch(PDO::FETCH_OBJ)){
                                //Separar dados
                                $id = $dadosPessoa->id;
                                $nome = $dadosPessoa->nome;
    
                                echo "<option value='{$id}'>{$nome}</option>";
                            }
                        }
                    ?>
                >
            </select>

            <label for="login">Login do Usuario:</label>
            <input type="text" name="login" id="login" class="form-control" required 
            data-parsley-required-message="Preencha Este Campo" value="<?=$login?>" autocomplete="nope">
            
            <label for="senha">Digite sua senha:</label>
            <input type="password" name="senha" id="senha" class="form-control" required 
            data-parsley-required-message="Digite a sua senha" autocomplete="off">
            
            <label for="senha2">Confirme sua senha:</label>
            <input type="password" name="senha2" id="senha2" class="form-control" required 
            data-parsley-required-message="Digite a sua senha" autocomplete="off">

            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar
            </button>
        </form>
    </div>
</div>
<script>
    $("#ativo").val("<?=$ativo?>");
    $("#idfuncionario").val("<?=$id?>");
</script>