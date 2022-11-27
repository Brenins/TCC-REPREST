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

    function teste($CPF){
        $pesquisa = array(".","-");
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



