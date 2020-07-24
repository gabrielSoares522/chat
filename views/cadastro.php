<?php $v->layout("_theme", []); ?>

<div class="form_cadastro">
    <form method="get" action="<?= $router->route("Controller.login"); ?>">
        <label for="txtLogin">Login</label>
        <input type="text" name="txtLogin" id="txtLogin">
        <label for="txtEmail">Email</label>
        <input type="email" name="txtEmail" id="txtEmail">
        <label for="txtSenha">Senha</label>
        <input type="password" name="txtSenha" id="txtSenha">
        <label for="txtRepSenha">Repetir Senha</label>
        <input type="password" name="txtRepSenha" id="txtRepSenha">
        <label>Foto de perfil</label>
        <input type="file" name="fotoPerfil" id="fotoPerfil" accept="image/*">
        <p class="erro"></p>
        <input type="submit" id="btnCadastrar" name="btnCadastrar" value="Cadastrar">
    </form>
</div>

<?php $v->start("js"); ?>
<script>
    $(function(){
        $("form").submit(function (e){
            e.preventDefault();
            var erro = $(".erro");
            var txtLogin = $("#txtLogin");
            var txtEmail = $("#txtEmail");
            var txtSenha = $("#txtSenha");
            var txtRepSenha = $("#txtRepSenha");
            var txtFtPerfil = $("#fotoPerfil");
            
            erro.text("");
            if(txtLogin.val() ==""){
                erro.text("preencha o campo login");
                return;
            }
            
            if(txtEmail.val() ==""){
                erro.text("preencha o campo email");
                return;
            }
            
            if(txtSenha.val() ==""){
                erro.text("preencha o campo senha");
                return;
            }
            if(txtRepSenha.val() ==""){
                erro.text("preencha o campo repetir senha");
                return;
            }

            if(txtSenha.val() != txtRepSenha.val()){
                txtSenha.val("");
                txtRepSenha.val("");
                erro.text("senha digitada de forma incorreta");
                return;
            }
        });
    });
</script>
<?php $v->end(); ?>