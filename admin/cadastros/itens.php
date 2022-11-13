<?php
    if(!isset($page)) exit;
    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }


    if(!empty($id)){
        $sql = "select id, nome, ativo, vlitem, idcategoria from item where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id",$id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);
        $id = $dados->id ?? NULL;
        $nome = $dados->nome ?? NULL;
        $ativo = $dados->ativo ?? NULL;
        $vlitem = $dados->vlitem ?? NULL;
        $idcategoria = $dados->idcategoria ?? NULL;
        $criado = $dados->criado ?? NULL;
        $modificado = $dados->modificado ?? NULL;


        $vlitem = number_format($vlitem,2,',','.');
    }

?>

<!-- Código HTMl da Tela -->

<div class="card">
    <div class="card-header">
        <h1 class="float-left">Cadastro de Itens</h1>
        <div class="float-right">
            <a href="listar/itens" class="btn btn-primary">
                Listar Itens
            </a>
        </div>
    </div>
    <div class="card-body">
        <form name="formItens" method="post" action="salvar/itens" enctype="multipart/form-data" data-parsley-validate="">
            <input type="hidden" name="id" id="id" readonly class="form-control" value="<?=$id?>">
            <label for="nome">Nome do Item:</label>
            <input type="text" name="nome" id="nome" 
            required data-parsley-required-message="Por favor preencha este campo" 
            class="form-control" value="<?=@$nome?>">
            <br>
            
            <label for="categoria">Selecione a Categoria:</label>
            <select name="categoria" id="categoria" required data-parsley-required-message="Selecione uma categoria." 
            class="form-control">
                <option value=""></option>
                <?php
                    $sql= "select id, descricao from categoria order by descricao";
                    $consultaCategoria = $pdo->prepare($sql);
                    $consultaCategoria->execute();

                    while ($dadosCategoria = $consultaCategoria->fetch(PDO::FETCH_OBJ)){
                        //Separar dados
                        $id = $dadosCategoria->id;
                        $descricao = $dadosCategoria->descricao;

                        echo "<option value='{$id}'>{$descricao}</option>";
                    }
                ?>
            </select>
            <br>
            
            <label for="valor">Valor do Item:</label>
            <input type="text" name="vlitem" id="vlitem"
            required data-parsley-required-message="Preencha o valor" class="form-control valor"
            value="<?=@$vlitem?>"></input>
            <br>
            <label for="ativo">Disponível:</label>
            <select name="ativo" id="ativo" class="form-control" 
            required data-parsley-required-message="Selecione uma Opcao">
                <option value=""></option>
                <option value="S">Sim</option>
                <option value="N">Nao</option>
            </select>
            <br>
            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Salvar</button>
        </form>
    </div>
</div>
<script>
    $("#ativo").val("<?=$ativo?>");
    $(document).ready(function(){
                $('.valor').maskMoney({
                    thousands:'.',
                    decimal:','
                });
                $('.texto').summernote({
                    height: 400
                });
                $('#categoria').val(<?=$idcategoria?>);
            })
</script>