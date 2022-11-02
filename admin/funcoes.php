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
?>



