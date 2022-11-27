<?php
    //Se nao existir a pagina
    if(!isset($page))exit;

    if($_POST){

        //Recuperar os dados enviados
        foreach($_POST as $key => $value){
            $$key = trim ($value ?? NULL);
        }
        //se ja existe um bloco cadastrado
        $sql = "select id from bloco 
        where nome = :nomeBloco or sigla = :sigla and id <> :id 
        limit 1";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":nomeBloco", $nomeBloco);
        $consulta->bindParam(":sigla", $sigla);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        //Verificar se trouxe algo
        if(!empty($dados->id)){
            mensagemErro("Nome do bloco ou sigla já foi utilizada para cadastro, por favor insira novos dados.");
        }

        if(empty($id)){ //INSERIR DADOS NO BANCO.
            $sql = "insert into bloco (nome, sigla) values (:nome, :sigla)";
            $insert = $pdo->prepare($sql);
            $insert->bindParam(":nome", $nomeBloco);
            $insert->bindParam(":sigla", $sigla);

        }

        //VALIDA QUAL UPDATE SERÀ UTILIZADO
        if(!empty($id)){
            $sql = "select id, nome, sigla from bloco where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":id", $id);
            $consulta->execute();
            $dados = $consulta->fetch(PDO::FETCH_OBJ);

            $blocoNomeId = $dados -> nome;
            $blocoSiglaId = $dados -> sigla;
        }

        //Update nome
        if(!empty($id) && $sigla == $blocoSiglaId ){
            $sql = "update bloco set nome = :nome  where id = :id limit 1";
            $insert = $pdo->prepare($sql);
            $insert->bindParam(":id", $id);
            $insert->bindParam(":nome", $nomeBloco);
            echo "Update Nome";

        }elseif(!empty($id) && $nomeBloco == $blocoNomeId ){//Update sigla
            $sql = "update bloco set sigla = :sigla  where id = :id limit 1";
            $insert = $pdo->prepare($sql);
            $insert->bindParam(":id", $id);
            $insert->bindParam(":sigla", $sigla);
            echo "Update SIGLA";
        }else{
            $sql = "update bloco set nome = :nome, sigla = :sigla where id = :id limit 1";
            $insert = $pdo->prepare($sql);
            $insert->bindParam(":id", $id);
            $insert->bindParam(":nome", $nomeBloco);
            $insert->bindParam(":sigla", $sigla);
            echo "UPdate GEral";
        }

        if($insert->execute()){
            mensagemSucesso('listar/blocos');
        }else{
            mensagemErro("Requisição inválida");
        }
    }
?>