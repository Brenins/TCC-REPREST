<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <form name="formPredial" method="post" action="salvar/Predial" data-parsley-valdiate="">
            <input type="hidden" readonly name="id" id="id" class="form-control" value="<?=$id?>">
            
            <label for="nome">Nome Completo:</label>
            <input type="text" name="nome" id="nome" class="form-control" required 
            data-parsley-required-message="Preencha o nome completo" value="<?=$nome?>" autocomplete="nope">
            
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf" class="form-control" data-inputmask="'mask': '999.999.999-99'" required 
            data-parsley-required-message="Preencha o cpf" value="<?=$cpf?>" autocomplete="nope">
            
            <label for="rg">RG:</label>
            <input type="text" name="rg" id="rg" class="form-control" data-inputmask="'mask': '99.999.999-9'" required 
            data-parsley-required-message="Preencha o RG" value="<?=$rg?>" autocomplete="nope">

            <label for="dataNascimento">Data de Nascimento:</label>
            <input type="date" name="dataNascimento" id="dataNascimento" class="form-control" required 
            data-parsley-required-message="Preencha a data de nascimento" value="<?=$dataNascimento?>" autocomplete="nope">
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar
            </button>
        </form>
    </div>
</div>