<?php 
if(empty($_SESSION["login"])){
    header("location:".$router->route("Controller.login"));
}
$this->layout("_theme", []);
?>

<div id="info_usuario">
    <div id="nome_usuario">
        <table>
        <tr>
            <td>
                <img class="fotoPerfil" src="data:image/jpeg;base64,<?= base64_encode($foto); ?>"/>
            </td>
            <td>
                <h1><?= $_SESSION["login"]; ?></h1>
            </td>
            <td>
                <div class="dropdown">
                    <span>menu</span>
                    <div class="dropdown-content">
                        <a href = "<?= $router->route("Controller.login"); ?>">Sair</a>
                    </div>
                </div>
            </td>
        </tr>
        </table>
    </div>
    <div id="lista_contatos">
        <form class="form_abrir_conversa" method="post" action="<?= $router->route("Controller.buscarConversa");?>">
            <input type="hidden" name="hdLoginCov" id="hdLoginCov" value="<?= $_SESSION["login"] ?>"/>
            <input type="hidden" name="hdNovaCov" id="hdNovaCov"/>
            <?php
            if(!empty($contatos)):
                foreach($contatos as $item):
                    $this->insert("contato",["nome"=>$item->nm_contato,"conversa"=>$item->id_conversa]);
                endforeach;
            endif;
            ?>
        </form>
    </div>
    <div id="div_add_contato">
        <form class="form_add_contato" method="post" action="<?= $router->route("Controller.addContato"); ?>">
            <input type="hidden" name="hdLogin" id="hdLogin" value="<?= $_SESSION["login"] ?>"/>
            
            <input type="text" id="txtAddContato" name="txtAddContato"/>
            <input type="submit" value="Adicionar" id="btnAddContato" name="btnAddContato"/>
        </form>
    </div>
</div>
<div id="chat">
    <div id="cabecalho_chat">
        <h2>Contato</h2>
    </div>
    <div id="corpo_chat">
        <ul class="lista_mensagens">
        </ul>
        <form class="fm_atualizar_mensagem" method = "post" action = "<?= $router->route("Controller.atualizarMensagem"); ?>">
        </form>
    </div>
    <div id="form_mensagem">
        <form class="form_add_mensagem" method="post" action = "<?= $router->route("Controller.enviarMsg"); ?>">
            <input type="hidden" name="hdLoginMsg" id="hdLoginMsg" value="<?= $_SESSION["login"] ?>"/>
            <input type="hidden" name="hdConversa" id="hdConversa">
            <input type="text" name="txtMsg" id="txtMsg">
            <button>Enviar</button>
        </form>
    </div>
</div>

<?php $this->start("js"); ?>
<script>
    $(function(){
        setInterval(() => {
            var form = $(".fm_atualizar_mensagem");
            var idConversa = $("#hdConversa").val();
            var login = $("#hdLoginMsg").val();
            var corpoChat = $("#corpo_chat");
            
            if(idConversa=="") { return; }

            $.post(form.attr("action"),{
                idConversa: idConversa,
                login: login
                }, function(data,status) {
                    if(data){
                        var resultado = JSON.parse(data);
                        $(".lista_mensagens").append(resultado.resposta);
                        corpoChat.scrollTop(corpoChat.prop('scrollHeight'));
                    }
                });
        }, 1000);
        
        $(".item_contato").click(function (e){
            var botao = $(this);
            var conversa = $("#hdConversa");
            var cabecalho = $("#cabecalho_chat");
            var novaCov = $("#hdNovaCov");

            cabecalho.html("<h2>"+botao.text()+"</h2>");
            novaCov.val(botao.val());
            conversa.val(botao.val());
        });

        $(".form_abrir_conversa").submit(function (e){
            var form = $(this);
            var chat = $("#chat");
            var corpoChat = $("#corpo_chat");
            
            chat.css("display","block");
            $(".lista_mensagens").html("");

            $.ajax({
                url: form.attr("action"),
                data: form.serialize(),
                type: "POST",
                dataType: "json",
                success: function(callback){
                    if(callback.conversa){
                        $(".lista_mensagens").append(callback.conversa);
                        corpoChat.scrollTop(corpoChat.prop('scrollHeight'));
                    }
                }
            });
            e.preventDefault();
        });

        $(".form_add_contato").submit(function (e){
            e.preventDefault();
            var form = $(this);
            var loginContato = $("#txtAddContato");
            if(loginContato.val() ==""){
                alert("digite o login do contato!");
                return;
            }
            $.ajax({
                url: form.attr("action"),
                data: form.serialize(),
                type: "POST",
                dataType: "json",                
                success: function(callback){
                    if(callback.contato){
                        $("#lista_contatos").prepend(callback.contato);
                    }
                    loginContato.val("");
                }
            });
        });

        $(".form_add_mensagem").submit(function (e){
            e.preventDefault();
            var form = $(this);
            var conversa = $("#hdConversa");
            var mensagem = $("#txtMsg");
            var corpoChat = $("#corpo_chat");

            if(conversa.val() ==""){
                alert("erro no envio da mensagem recarregue a pagina!");
                return;
            }
            
            if(mensagem.val() ==""){
                return;
            }

            $.ajax({
                url: form.attr("action"),
                data: form.serialize(),
                type: "POST",
                dataType: "json",
                success: function(callback){
                    if(callback.enviada){
                        $(".lista_mensagens").append(callback.enviada);
                        corpoChat.scrollTop(corpoChat.prop('scrollHeight'));
                    }
                }
            });
            
            mensagem.val("");
        });
    });
</script>
<?php $this->end(); ?>