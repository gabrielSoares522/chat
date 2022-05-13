<?php $this->layout("_theme", []); ?>

<div class="formulario">
    <form id="fmCadastro" method="post" action="<?= $router->route("Controller.criarConta"); ?>" enctype="multipart/form-data">
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
        <img id = "mostraFoto" src="#" alt=""/>
        <p class="erro"></p>
        <input type="submit" id="btnCadastrar" name="btnCadastrar" value="Cadastrar">
    </form>
    <input type="hidden" name="linkLogin" id="linkLogin" value = "<?= $router->route("Controller.login"); ?>">
</div>

<?php $this->start("js"); ?>
<script>
    $(function(){
        var fotoPerfil = $("#fotoPerfil");
        var mostraFoto = $("#mostraFoto");
        var form = $("#fmCadastro");
        var txtLogin = $("#txtLogin");
        var txtEmail = $("#txtEmail");
        var txtSenha = $("#txtSenha");
        var txtRepSenha = $("#txtRepSenha");
        var erro = $(".erro");
        
        function teste() {
            var letras = "1234567890";
            var randomico = "daniel";

            for(var i=0;i<3;i++) {
                randomico+=letras.substr(Math.floor(Math.random()*letras.length),1);
            }

            txtLogin.val(randomico);
            txtEmail.val(randomico+"@gmail.com");
            txtSenha.val("1234");
            txtRepSenha.val("1234");
        }
        
        fotoPerfil.change(function () {
            if (this.files && this.files[0]) {
                //teste();
                
                var reader = new FileReader();

                reader.onload = function (e) {
                    mostraFoto.attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
        });

        function checarVazio(campo) {
            if(campo.val() =="") {
                erro.text("preencha todos os campos!");
                return true;
            }
            else { return false; }
        }

        form.submit(function (e) {     
            erro.text("");
            e.preventDefault();

            if (checarVazio(txtLogin)) { return; }

            if (checarVazio(txtEmail)) { return; }

            if (checarVazio(txtSenha)) { return; }

            if (checarVazio(txtRepSenha)) { return; }

            if(txtSenha.val() != txtRepSenha.val()) {
                txtSenha.val("");
                txtRepSenha.val("");
                erro.text("senha digitada de forma incorreta!");
                return;
            }

            $.ajax({
                url: form.attr("action"),
                data: new FormData(form[0]),
                type: "POST",
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function (callback) {
                    console.log(callback);
                    
                    if(callback.erro) {
                        erro.text(callback.erro);
                    }

                    if(callback.cadastrado) {
                        $(location).attr('href', $("#linkLogin").val());
                    }
                }
            });
        });
    });
</script>
<?php $this->end(); ?>