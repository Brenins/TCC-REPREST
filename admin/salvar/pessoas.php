<?php
    date_default_timezone_set("America/Sao_Paulo");
    //Se nao existir a pagina
    if(!isset($page))exit;
    if($_POST){
        //Recuperar os dados enviados
        foreach($_POST as $key => $value){
            $$key = trim ($value ?? NULL);
        }
        
        //Valida data de Nascimento.
        if($dataNascimento >= date("Y-m-d")){
            mensagemErro("A data de nascimento inserida é maior ou igual a data de hoje!");
        }

        //se ja existe um cpf cadastrado
        $cpf = formataCPF($cpf);

       
        $sql ="select id from pessoa where cpf = :cpf AND id <> :idpessoa limit 1";

        $cpfDuplicado = $pdo->prepare($sql);
        $cpfDuplicado->bindParam(":cpf", $cpf);
        $cpfDuplicado->bindParam(":idpessoa", $id);
        $cpfDuplicado->execute();
        
        $dados = $cpfDuplicado->fetch(PDO::FETCH_OBJ);

        if(!empty($dados->id)){
            mensagemErro("Já existe uma pessoa com o CPF informado, por favor insira outro.");
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

    
        if(empty($id)){
            $cpf = formataCPF($cpf);
            $telefone = formataCPF($celular);
            $sql = "insert into pessoa (nome, cpf, rg, dtnascimento, telefone, criado) 
            values (:nome, :cpf, :rg, :dtnascimento, :telefone, :criado)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":nome", $nome);
            $consulta->bindParam(":cpf", $cpf);
            $consulta->bindParam(":rg", $rg);
            $consulta->bindParam(":telefone", $telefone);
            $consulta->bindParam(":dtnascimento", $dataNascimento);
            $consulta->bindParam(":criado",$_SESSION['usuario']['login'] );
        }else{
            $cpf = formataCPF($cpf);
            $telefone = formataCPF($celular);
            $sql = "update pessoa set nome = :nome, cpf = :cpf, rg = :rg, dtnascimento = :dtnascimento, telefone = :telefone, modificado = :modificado where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":nome", $nome);
            $consulta->bindParam(":id", $id);
            $consulta->bindParam(":cpf", $cpf);
            $consulta->bindParam(":rg", $rg);
            $consulta->bindParam(":telefone", $telefone);
            $consulta->bindParam(":dtnascimento", $dataNascimento);
            $consulta->bindParam(":modificado",$_SESSION['usuario']['login'] );
            
        }

        if($consulta->execute()){
            mensagemSucesso("listar/pessoas");
        }

    }
?>