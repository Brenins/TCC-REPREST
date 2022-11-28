<?php




?>

<div class="card">
    <div class="card-header">
        <h2 class="float-left">
            Nova reserva
        </h2>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/reservas" data-parsley-validate="">
            <input type="hidden" readonly name="id" id="id"
            class="form-control" value="<?=$id?>">

            <label for="descricao">Descrição do evento:</label>
            <input type="text" name="descricao" id="descricao"
            class="form-control" required
            data-parsley-required-message="Preencha este campo"
            value="<?=$descricao?>">

            <label for="dtInicio">Inicio do evento:</label>
            <input type="date" name="dtInicio" id="dtInicio"
            class="form-control" required
            data-parsley-required-message="Data de inicio obrigatória."
            value="<?=$dtinicio?>">



            <label for="dtFim">Fim do evento:</label>
            <input type="date" name="dtFim" id="dtFim"
            class="form-control" required
            data-parsley-required-message="Data de fim obrigatória."
            value="<?=$dtfim?>">

            <label for="obs">Observações:</label>
            <input type="obs" name="obs" id="obs"
            class="form-control" required
            data-parsley-required-message="Preencha a observação"
            value="<?=$obs?>">
            
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar
            </button>
        </form>
    </div>
</div>