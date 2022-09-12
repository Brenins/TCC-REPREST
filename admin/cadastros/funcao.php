<?php

?>

<div class="card">
    <div class="card-header">
        <h2 class="float-left">Cadastro de Funções</h2>
        <div class="float-right">
            <a href="listar/funcao" 
            title="Listar Funcao" 
            class="btn btn-primary rounded-pill">Listar Funções</a>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/funcao" data-parsley-valdiate="">
            <input type="hidden" readonly name="id" id="id" class="form-control" value="<?=$id?>">
            
            <label for="nome">Nome da Funcao:</label>
            <input type="text" name="nome" id="nome" class="form-control" required 
            data-parsley-required-message="Preencha o nome completo" value="<?=$nome?>" autocomplete="nope">
            <br>
            <button type="submit" class="btn btn-success rounded-pill">
                <i class="fas fa-check"></i> Salvar
            </button>
        </form>
    </div>
</div>