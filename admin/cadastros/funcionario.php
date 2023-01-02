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
<div class="card">
    <div class="card-header">
        <h2 class="float-left">Cadastro de Funcionário</h2>
        <div class="float-right">
            <ul class="nav nav-pills">
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown" data-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="fas fa-bars"></i>  Menu</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="cadastros/funcionario">Cadastrar Funcionário</a>
                        <a class="dropdown-item" href="listar/funcionarios">Lista de Funcionários</a>
                        <a class="dropdown-item" href="cadastros/funcao">Cadastro de Função</a>
                        <a class="dropdown-item" href="cadastros/usuarios">Definir Login de Funcionário</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/funcionario" data-parsley-valdiate="">
            <input type="hidden" readonly name="id" id="id" class="form-control" value="<?=$id?>">

            <div class="alert alert-warning" role="alert">
                Abaixo estão listadas apenas as pessoas que não estão definidas como funcionários.
            </div>

            <label for="idpessoa">Selecione uma pessoa para cadastrar como Funcionário:</label>
            <select name="idpessoa" id="idpessoa" required data-parsley-required-message="Selecione uma pessoa." 
                class="form-control">
                    <option value=""></option>
                    <?php
                        $sql= "select id, nome from pessoa order by nome";
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


            <label for="ativo">Ativo:</label>
            <select name="ativo" id="ativo" class="form-control" 
            required data-parsley-required-message="Selecione uma Opcao">
                <option value=""></option>
                <option value="S">Sim</option>
                <option value="N">Nao</option>
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