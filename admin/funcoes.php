<?php
    //Janela de Erro
    function mensagemErro($msg){
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Pera la amigao...',
                text: '<?=$msg?>',
            }).then((result) => {
                history.back(); 
            })
        </script>
        <?php
            exit;
    }//Fim da funcao