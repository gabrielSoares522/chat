<?php 
session_start();
unset($_SESSION["login"]);
session_destroy();

$this->layout("_theme", []);
?>
<div class ="banner_inicial">
    <div class="form_login">
        <h1 id="tituloChat">Chat</h1>
        <form method="post" action="<?= $router->route("Controller.entrar"); ?>">
            <input type="text" name="txtLogin" id="txtLogin" placeholder="digite seu login"><br>
            <input type="password" name="txtSenha" id="txtSenha" placeholder="digite sua senha"><br>
            <button type="submit" name="btnEntrar" id="btnEntrar" value="Entrar">Entrar</button>
            <p class="erro"></p>
        </form>
        <p>Não tem uma conta? <a href = "<?= $router->route("Controller.cadastro"); ?>">Cadastre-se</a></p>
        <p><a href = "<?= $router->route("Controller.redefineSenha"); ?>">Esqueceu a senha?</a></p>
    </div>
</div>


<?php $this->start("js"); ?>
<script>
    $(function(){
        $("form").submit(function (e){
            var erro = $(".erro");
            var txtLogin = $("#txtLogin");
            var txtSenha = $("#txtSenha");
            
            erro.text("");
            if(txtLogin.val() ==""){
                erro.text("preencha o campo login");
                e.preventDefault();
                return;
            }
            if(txtSenha.val() ==""){
                erro.text("preencha o campo senha");
                e.preventDefault();
                return;
            }
            
        });
    });
</script>
<?php $this->end(); ?>