<?php
    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }

    if($_POST){

        $sql = "select id from apartamento where idmorador = :idmorador limit 1";
        $consultaAp = $pdo->prepare($sql);
        $consultaAp->bindParam(":idmorador", $idmorador);
        $consultaAp->execute();
        $dadosAp = $consultaAp->fetch(PDO::FETCH_OBJ);

        $apartamento = @$dadosAp->id;


        if(empty($apartamento)){
            mensagemErro("KKKKK TA ERRADO CARAI");
        }


        $sql = "select chave, recebedor, CIDADE_REC as cidade from pix p limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        
        
        $dados = $consulta->fetch(PDO::FETCH_OBJ);
        $cidade = $dados->cidade;
        $chaveSistema = $dados->chave;
        $recebedor = $dados->recebedor;
        
        $parte1 = str_replace('.','',$valor);

        $valorCobrado = str_replace(',','.',$parte1);

        //Estrutura do PIX
        $pix[00]="01";                  //Define se pode ser reutilizada para pagamento
        $pix[26][00]="br.gov.bcb.pix"; //Identificacao Governo
        $pix[26][01]=$chaveSistema;    //Chave Pix (CPF,CNPJ,TELEFONE,ETC)
        $pix[52]="0000";               //Identificador MERCHANT CATEGORY CODE
        $pix[53]="986";                //Tipo de moeda de transação (BRL)
        $pix[54]="$valorCobrado";
        $pix[58]="BR";                 //Codigo do Pais (Brasil)
        $pix[59]=$recebedor;            //Nome do recebedor
        $pix[60]=$cidade;       //Cidade do recebedor
        $pix[62][05]="***";            //Outras Identificacoes
        $chavePIX = montaPix($pix);
        
        $chavePIX.="6304"; //Validador CRC
        $chavePIX.=crcChecksum($chavePIX);//Cria o checksum a partir do crc

        $data = date("Y-m-d");
        $sql = "insert into cobranca (valor, tipo, data_cobranca, pix_cc, idapartamento) values (:valor, :tipo, :datac, :pix, :idapartamento)";
        $insert = $pdo->prepare($sql);
        $insert->bindParam(":valor", $parte1);
        $insert->bindParam(":tipo", $tipo);
        $insert->bindParam(":datac", $data);
        $insert->bindParam(":pix", $chavePIX);
        $insert->bindParam(":idapartamento", $apartamento);
        
        if($insert->execute()){
            mensagemErro("AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA");
        }


        //cobrar($chavePIX, $valorCobrado);
     
    }
?>