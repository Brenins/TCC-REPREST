<?php 
    //se n existir variavel page
    if(!isset($page)) exit;
    
?>

<div class="card">
    <div class="card-header">
        <h2 class="float-left">Cadastro de Categoria</h2>
        <div class="float-right">
            <a href="listar/categorias" 
            title="Listar Categorias" 
            class="btn btn-primary">Listar Categorias</a>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/categorias">
            <label for="id">Id da Categoria:</label>
            <input type="text" readonly name="id" id="id"
            class="form-control">
            <label for="nome">Nome da Categoria:</label>
            <input type="text" name="caegoria" id="nome"
            class="form-control" required data-parsley-required-message="Por favor, preencha este campo">
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i>Salvar Dados
            </button>
        </form>
    </div>
</div>