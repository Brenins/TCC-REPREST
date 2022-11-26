<?php
    //Se nao existir a pagina
    if(!isset($page))exit;

    if($_POST){

        //Recuperar os dados enviados
        foreach($_POST as $key => $value){
            $$key = trim ($value ?? NULL);
        }
        //se ja existe um bloco cadastrado

        $sql = "select id, nome,sigla , if (nome = :nome, 'S', 'N') as validacao, if (sigla = :sigla,'S','N') as validacao2 from bloco limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":nome", $nome);
        $consulta->bindParam(":sigla", $sigla);
        $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        if($dados->validacao == "S"){
            mensagemErro("Já Existe um bloco cadastrado com esse nome, por favor insira outro nome.");
        }elseif($dados->validacao2 == "S");{
            mensagemErro("Esta sigla já existe no sistema, por favor insira outra.");
        }
        
        if(!empty($id)){
            $sql = "update bloco set nome = :nome, sigla = :sigla  where id = :id limit 1";
            $insert = $pdo->prepare($sql);
            $insert->bindParam(":id", $id);
            $insert->bindParam(":nome", $nome);
            $insert->bindParam(":sigla", $sigla);
        }
        
        if(empty($id)){
            $sql = "insert into bloco (nome, sigla) values (:nome, :sigla)";
            $insert = $pdo->prepare($sql);
            $insert->bindParam(":nome", $nome);
            $insert->bindParam(":sigla", $sigla);
        }

        if($insert->execute()){
            mensagemSucesso('listar/blocos');
        }else{
            mensagemErro("Requisição inválida");
        }
    }
?>