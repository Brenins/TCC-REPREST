<?php
    //se n existir variavel page
    if(!isset($page)) exit;
    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }

    $login = $senha = $ativo = NULL;


    if(!empty($id)){
        $sql = "select id, login, senha, ativo, idpessoa, criado, modificado from funcionario where  id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id",$id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);
        $id = $dados->id ?? NULL;
        $login = $dados->login ?? NULL;
        $ativo = $dados->ativo ?? NULL;
        $idpessoa = $dados->idpessoa ?? NULL;
        $criado = $dados->criado ?? NUll;
        $modificado = $dados->modificado ?? NULL;
    }
?>
<div class="card shadow">
    <div class="card-header">
        <h2 class="float-left">Cadastro de Funcionário</h2>
        <div class="float-right">
            <a href="listar/funcionarios" 
            title="Listar Funcionarios" 
            class="btn btn-primary">Listar Funcionários</a>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/funcionario" data-parsley-valdiate="">
            <input type="hidden" readonly name="id" id="id" class="form-control" value="<?=$id?>">

            <div class="alert alert-warning" role="alert">
                Abaixo serão listados apenas os nomes das pessoas que não estão registradas como funcionários, caso não encontre o nome desejado, verifique se o mesmo está cadastrado no sistema acessando a tela de <a class="alert-link" href="">Lista de Pessoas</a>.
            </div>

            <label for="idpessoa">Selecione uma pessoa para cadastrar como Funcionário:</label>
            <select name="idpessoa" id="idpessoa" required data-parsley-required-message="Selecione uma pessoa." 
                class="form-control">
                    <option value=""></option>
                    <?php

                        $sql= "select p.id, p.nome  from pessoa p left join funcionario f on p.id = f.idpessoa where f.idpessoa is null ";
                        $consultaPessoa = $pdo->prepare($sql);
                        $consultaPessoa->execute();

                        while ($dadosPessoa = $consultaPessoa->fetch(PDO::FETCH_OBJ)){
                            //Separar dados
                            $id = $dadosPessoa->id;
                            $nome = $dadosPessoa->nome;

                            echo "<option value='{$id}'>{$nome}</option>";
                        }
                    ?>
                >
            </select>

            <label for="idfuncao">Selecione a função do funcionário:</label>
            <select name="idfuncao" id="idfuncao" required data-parsley-required-message="Selecione uma função/cargo"

                class="form-control">
                    <option value=""></option>
                    <?php
                        $sql= "select id, nome from funcao order by nome";
                        $consultaFuncao = $pdo->prepare($sql);
                        $consultaFuncao->execute();

                        while ($dadosFuncao = $consultaFuncao->fetch(PDO::FETCH_OBJ)){
                            //Separar dados
                            $id = $dadosFuncao->id;
                            $nome = $dadosFuncao->nome;
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
    $("#ativo").val("<?=$ativo?>");
</script>