<?php
    //Janela de Erro
    function mensagemErro($msg){
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Um erro foi encontrado!',
                text: '<?=$msg?>',
            }).then((result) => {
                history.back(); 
            })
        </script>
        <?php
            exit;
    }//Fim da funcao
    



    function minhaData($data){
        $pedacos = explode("-", $data);

        return  $novo = "$pedacos[2]/$pedacos[1]/$pedacos[0]";
    }

    function formataCPF($CPF){
        $pesquisa = array(".","-","(",")");
        $atualiza = array("");
        $resultado = str_replace($pesquisa,$atualiza,$CPF);

        return $resultado;
    }

    function mensagemErro2($msg){
        ?>
        <script>
            Swal.fire({
                imageUrl: 'images/computer.png',
                title: 'Um erro foi encontrado!',
                text: '<?=$msg?>',
                confirmButtonText: 'Voltar para Dashboard',
            }).then((result) => {
                window.location.href = './paginas/home';
            })
        </script>
        <?php
            exit;
    }//Fim da funcao

    function cobrar($chave, $valor, $cell){


        function mensagem1($valor, $cell){
            $curl = curl_init();
    
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.whatsgw.com.br/api/WhatsGw/Send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
    
            $DATA = [
                "apikey" => "55e52cd3-c124-4368-a534-074558eeb074",
                "phone_number" => "554497019488",
                "contact_phone_number" => "55$cell",
                "message_custom_id" => "perereca",
                "message_type" => "text",
                "message_body" => "REPREST GESTÃO: Uma cobrança foi gerada no valor de R$ $valor, para pagar utilize o código PIX abaixo.",
                "check_status" => "1"
            ],
    
            CURLOPT_POSTFIELDS => json_encode($DATA),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            ));
    
            $response = curl_exec($curl);

            curl_close($curl);

        }

        function mensagem2($chave,$cell){
            $pix = $chave;
            $curl = curl_init();
    
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.whatsgw.com.br/api/WhatsGw/Send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
    
            $DATA = [
                "apikey" => "55e52cd3-c124-4368-a534-074558eeb074",
                "phone_number" => "554497019488",
                "contact_phone_number" => "55$cell",
                "message_custom_id" => "perereca",
                "message_type" => "text",
                "message_body" => $pix,
                "check_status" => "1"
            ],
    
            CURLOPT_POSTFIELDS => json_encode($DATA),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            ));
    
            $response = curl_exec($curl);
            print_r(json_decode($response));
            curl_close($curl);
        }

        mensagem1($valor, $cell);
        mensagem2($chave, $cell);

        mensagemSucesso("cadastros/cobranca");


    }

    function reenvioCobranca(){


    }

    function mensagemSucesso($location){
        ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Salvo com Sucesso!',
                confirmButtonText: 'Ok',
            }).then((result) => {
                window.location.href = '<?=$location?>';
            })
        </script>
        <?php
            exit;
    }//Fim da funcao

?>



