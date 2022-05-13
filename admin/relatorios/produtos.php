<?php
    if(!isset($page))exit;
?>

<div class="card shadow-lg">
    <div class="card-header">
        <h2>Relatorio de Produtos</h2>
    </div>
    <div class="card-body">
        <form name="formBusca" method="post" action="relatorios/produtos">
            <div class="row d-flex align-items-end">
                <div class="col-12 col-md-4">
                    <label for="valorInicial">Valor Inicial:</label>
                    <input type="text" name="valorInicial" 
                    id="valorInicial" class="form-control">
                </div>
                <div class="col-12 col-md-4">
                    <label for="valorInicial">Valor Final:</label>
                    <input type="text" name="valorFinal" 
                    id="valorFinal" class="form-control">
                </div>
                <div class="col-12 col-md-4" >
                    <button type="submit" class="btn btn-success w-100"> Buscar</button>
                </div>
            </div>

        </form>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.form-control').maskMoney({thousands:'.',decimal:','});
    })
</script>