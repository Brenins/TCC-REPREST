<?php
    //Validadcao dos dados
    if($_POST){
        $login = trim($_POST["login"] ?? NULL);
        $senha = trim($_POST["senha"] ?? NULL);
        //validar login e senha
        if ((empty($login)) or (empty($senha))) {
            //mostrar um erro na tela
            ?>
            <script>
              Swal.fire({
                icon: 'error',
                title: 'Pera la amigao...',
                text: 'Preencha os campos corretamente.',
              }).then((result) => {
                 history.back(); 
              })
            </script>
            <?php
            exit;
        }
        // Selecionar os dados do banco

        $sql = "select id, nome, login,senha from usuario where login = :login and ativo ='S' limit 1";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":login", $login);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        //Verificar se trouxe resultado

        if(!isset($dados->id)){
          mensagemErro("Usuario nao encontrado ou desativado.");
        }else if(!password_verify($senha,$dados->senha)){
          mensagemErro("Senha incorreta.");
        };
        
        //dados sessao
        $_SESSION["usuario"] = array("id=>$dados->id",
          "nome"=>$dados->nome,
          "login"=>$dados->login);

        //pagina home direcionamento
        echo "<script>location.href='paginas/home';</script>";

    } //Fim do POST
?>

<div class="login">
    <h1 class="text-center">Vitrine Admin</h1>
    <form name="formLogin" method="post">
        <label for="Login">Login:</label>
        <input type="text" name="login" id="login" class="form-control" required>
        <label for="Senha">Senha:</label>
        <input type="password" name="senha" id="senha"
        class="form-control" required data-parsley-required-message="Por favor preencha este campo">
        <br>
        <button type="submit" class="btn btn-success w-100">Efetuar Login</button>
</div>