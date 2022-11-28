<?php
    if(!isset($page)) exit; 

    $sql = "select id, chave, recebedor, cidade_rec from pix where id = 1 limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->execute();
    $dados = $consulta->fetch(PDO::FETCH_OBJ);
    $id = $dados->id;
    $chave = $dados->chave;
    $recebedor = $dados->recebedor;
    $cidade = $dados->cidade_rec;
?>

<div class="card">
    <div class="card-header">
        <h2 class="float-left">Configurações do PIX</h2>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/pix" data-parsley-validate="">
            <input type="hidden" readonly name="id" id="id"
            class="form-control" value="<?=$id?>">
            <label for="chave">Chave PIX:</label>
            <input type="text" name="chave" id="chave"
            class="form-control"  required 
            data-parsley-required-message="Por favor, preencha este campo"
            value="<?=@$chave?>">

            <label for="recebedor">Nome do Recebedor:</label>
            <input type="text" name="recebedor" id="recebedor"
            class="form-control"  required 
            data-parsley-required-message="Por favor, preencha este campo"
            value="<?=@$recebedor?>">

            <label for="cidade">Cidade do Recebedor:</label>
            <input type="text" name="cidade" id="cidade"
            class="form-control"  required 
            data-parsley-required-message="Por favor, preencha este campo"
            value="<?=@$cidade?>">
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar
            </button>
        </form>
    </div>
</div>