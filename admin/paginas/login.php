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
                title: 'Atenção!',
                text: 'Preencha os campos corretamente.',
              }).then((result) => {
                 history.back(); 
              })
            </script>
            <?php
            exit;
        }
        // Selecionar os dados do banco

        $sql = "select id, login,senha from funcionario where login = :login and ativo ='S' limit 1";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":login", $login);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        //Verificar se trouxe resultado

        if(!isset($dados->id)){
          mensagemErro("Usuário ou senha incorreta.");
        }else if(!password_verify($senha,$dados->senha)){
          mensagemErro("Usuário ou senha incorreta.");
        };
        
        //dados sessao
        $_SESSION["usuario"] = array("id=>$dados->id",
          "login"=>$dados->login);

        //pagina home direcionamento
        echo "<script>location.href='paginas/home';</script>";

    } //Fim do POST
?>

<div class="login" style="border-radius: 24px; background-color: white;">
    <h1 class="text-center" ><img src="images/Represt-black.png" width="256" height="256" alt="Vitrine Logo"></h1>
    <form name="formLogin" method="post">
        <label for="Login" style="font-weight:bold;">Login:</label>
        <input type="text" name="login" id="login" class="form-control" required>
        <label for="Senha" style="font-weight:bold;">Senha:</label>
        <input type="password" name="senha" id="senha"
        class="form-control" required data-parsley-required-message="Por favor preencha este campo">
        <br>
        <div class="text-center"><button type="submit" class="btn btn-primary  w-50">Efetuar Login</button></div>
</div>