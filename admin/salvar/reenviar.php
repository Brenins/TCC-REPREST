<?php
    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }
    
    $sql = "
        select
            c.id,
            c.valor,
            c.tipo,
            c.data_cobranca as datac,
            c.data_atualizacao as dataa,
            c.pix_cc as pix,
            p.nome as morador,
            s.status as status_name,
            p.telefone as celular
        from
            cobranca c
        left join apartamento a 
            on c.idapartamento = a.id 
        left join morador m
            on m.id = a.idmorador 
        left join status s
            on s.id = c.idstatus
        left join pessoa p
            on p.id = m.idpessoa
        where c.id = :id limit 1
    ";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id", $id);
    $consulta->execute();
    $dados = $consulta->fetch(PDO::FETCH_OBJ);

    $chave = $dados->pix;
    $valor = $dados->valor;
    $cell = $dados->celular;

    cobrar($chave, $valor, $cell);
?>