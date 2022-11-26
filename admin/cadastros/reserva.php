<?php

?>

<div class="card">
    <div class="card-header">
        <h2 class="float-left">Parametrização de Taxas</h2>
    </div>
    <div class="card-body">
    <form name="formCadastro" method="post" action="" data-parsley-valdiate="">
            <input type="hidden" readonly name="id" id="id" class="form-control" value="">
            
            <label for="cpf">Taxa de Multa:</label>
            <input type="text" name="cpf" id="cpf" class="form-control" data-inputmask="'mask': '999.999.999-99'" required 
            data-parsley-required-message="Preencha o cpf" value="<?=$cpf?>" autocomplete="nope">
            
            <label for="rg">Taxa para perda de itens:</label>
            <input type="text" name="rg" id="rg" class="form-control"  maxlength="16" required 
            data-parsley-required-message="Preencha o RG" value="<?=$rg?>" autocomplete="nope">

            <label for="rg">Taxa para atraso de devolução:</label>
            <input type="text" name="rg" id="rg" class="form-control"  maxlength="16" required 
            data-parsley-required-message="Preencha o RG" value="<?=$rg?>" autocomplete="nope">

            <label for="rg">Taxa de limpeza:</label>
            <input type="text" name="rg" id="rg" class="form-control"  maxlength="16" required 
            data-parsley-required-message="Preencha o RG" value="<?=$rg?>" autocomplete="nope">

            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar
            </button>
        </form>
    </div>
</div>
