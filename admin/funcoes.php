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


    function enviarCobranca($chave, $valor, $nomeMorador, $telefone){
        ?>
        <script>
            Swal.fire({
                    imageUrl: 'images/zap.png',
                    title: 'Verifique as informações antes de enviar!',
                    html: 
                    '<p>PIX: <?=$chave?></p>' + 
                    '<p>Valor: R$<?=$valor?></p>' +
                    '<p>Morador: <?=$nomeMorador?>' +
                    '<p>WhatsApp: <?=$telefone?></p>',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    window.location.href = 'https://wa.me/55<?=$telefone?>?text=Olá, estamos te enviando a chave para pagamento do seus débitos no valor de R$<?=$valor?>, CHAVE PARA PAGAMENTO: <?=$chave?> ';
                })
        </script>    
        
        <?php
            exit;

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

    function enviaZap($numero,$mensagem){
        $url = "https://wa.me/$numero?text=$mensagem";
        ?>
        <script> window.open(<?=$url?>)</script>
        <?php
    }



?>



