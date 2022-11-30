<?php
    if(!isset($page)) exit;
    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }

    //Informações chave pix
    $sql = "select chave, recebedor, CIDADE_REC as cidade from pix p limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->execute();
    
    
    $dados = $consulta->fetch(PDO::FETCH_OBJ);
    $cidade = $dados->cidade;
    $chaveSistema = $dados->chave;
    $recebedor = $dados->recebedor;
    

    if($tipo == 1){
        //LIMPEZA

        $sql = "select valor from taxa where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id",$tipo);
        $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        $valorCobrado = $dados->valor;
        
    }elseif($tipo == 2){




    }elseif($tipo == 3){






    }else{
        mensagemErro("Tipo de cobrança inválida");
    }



    //Estrutura do PIX
    $pix[00]="01";                  //Define se pode ser reutilizada para pagamento
    $pix[26][00]="br.gov.bcb.pix"; //Identificacao Governo
    $pix[26][01]=$chaveSistema;    //Chave Pix (CPF,CNPJ,TELEFONE,ETC)
    $pix[52]="0000";               //Identificador MERCHANT CATEGORY CODE
    $pix[53]="986";                //Tipo de moeda de transação (BRL)
    $pix[54]=$valorCobrado;
    $pix[58]="BR";                 //Codigo do Pais (Brasil)
    $pix[59]=$recebedor;            //Nome do recebedor
    $pix[60]=$cidade;       //Cidade do recebedor
    $pix[62][05]="***";            //Outras Identificacoes
    $chave = montaPix($pix);

    $chave.="6304"; //Validador CRC
    $chave.=crcChecksum($chave);//Cria o checksum a partir do crc


    print_r($chaveSistema);
    enviarCobranca($chave,$valorCobrado,'Breno','44997545924');














?>