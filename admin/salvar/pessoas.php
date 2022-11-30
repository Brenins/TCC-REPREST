<?php
    //Se nao existir a pagina
    if(!isset($page))exit;
    if($_POST){

        
        //Recuperar os dados enviados
        foreach($_POST as $key => $value){
            $$key = trim ($value ?? NULL);
        }

        $cpf = teste($cpf);

        //se ja existe um cpf cadastrado

        $sql ="select id from pessoa where cpf = :cpf AND id <> :idpessoa limit 1";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":cpf", $cpf);
        $consulta->bindParam(":idpessoa", $idpessoa);
        $consulta->execute();
        
        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        if(!empty($dados->id)){
            mensagemErro("Preenchido");
        }




        function validaCPF($cpf) {
 
            // Extrai somente os números
            //$cpf = preg_replace( '/[^0-9]/is', '', $cpf );
             
            // Verifica se foi informado todos os digitos corretamente
            if (strlen($cpf) != 11) {
                mensagemErro("CPF inválido, por favor insira outro CPF.");
            }
        
            // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
            if (preg_match('/(\d)\1{10}/', $cpf)) {
                mensagemErro("CPF com números repetidos, por favor insira outro CPF.");
            }
        
            // Faz o calculo para validar o CPF
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    mensagemErro("CPF inválido, por favor insira outro CPF.");
                }
            }
            return true;
        }


        ValidaCPF($cpf);

        if ( empty ( $idpessoa ) ) {
            
            $celular = teste($celular);

            //inserir no banco
            $sql = "insert into  pessoa (nome,cpf,rg,dtnascimento,telefone ,criado) values (:nome,:cpf,:rg,:dtnascimento, :telefone,:criado)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":nome", $nome);
            $consulta->bindParam(":cpf", $cpf);
            $consulta->bindParam(":rg", $rg);
            $consulta->bindParam(":dtnascimento", $dataNascimento);
            $consulta->bindParam(":telefone", $celular);
            $consulta->bindParam(":criado",$_SESSION['usuario']['login']);

        }else{

            $celular = teste($celular);
            //fazer o update, mas sem a senha
            $sql = "update pessoa set  nome = :nome, cpf = :cpf, rg = :rg, dtnascimento = :dtnascimento, telefone = :telefone, modificado = :modificado  where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":nome", $nome);
            $consulta->bindParam(":cpf", $cpf);
            $consulta->bindParam(":rg", $rg);
            $consulta->bindParam(":dtnascimento", $dataNascimento);
            $consulta->bindParam(":telefone", $celular);
            $consulta->bindParam(":modificado",$_SESSION['usuario']['login']);
            $consulta->bindParam(":id", $idpessoa);
        }

        if(!$consulta->execute()){
            mensagemErro("Nao foi possivel salvar o registro.");
        }else{
            mensagemSucesso("listar/pessoas");
        }
    }
?>