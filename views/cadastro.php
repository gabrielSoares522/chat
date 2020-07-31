<?php $v->layout("_theme", []); ?>

<div class="form_cadastro">
    <form method="post" action="<?= $router->route("Controller.criarConta"); ?>">
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
            var erro = $(".erro");
            var txtLogin = $("#txtLogin");
            var txtEmail = $("#txtEmail");
            var txtSenha = $("#txtSenha");
            var txtRepSenha = $("#txtRepSenha");
            var txtFtPerfil = $("#fotoPerfil");
            
            erro.text("");
            if(txtLogin.val() ==""){
                erro.text("preencha o campo login");
                e.preventDefault();
                return;
            }
            
            if(txtEmail.val() ==""){
                erro.text("preencha o campo email");
                e.preventDefault();
                return;
            }
            
            if(txtSenha.val() ==""){
                erro.text("preencha o campo senha");
                e.preventDefault();
                return;
            }
            if(txtRepSenha.val() ==""){
                erro.text("preencha o campo repetir senha");
                e.preventDefault();
                return;
            }

            if(txtSenha.val() != txtRepSenha.val()){
                txtSenha.val("");
                txtRepSenha.val("");
                erro.text("senha digitada de forma incorreta");
                e.preventDefault();
                return;
            }
        });
    });
</script>
<?php $v->end(); ?>