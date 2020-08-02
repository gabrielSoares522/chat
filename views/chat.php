<?php 
if(empty($_SESSION["login"])){
    header("location:".$router->route("Controller.login"));
}
$v->layout("_theme", []);
?>

<div id="info_usuario">
    <div id="nome_usuario">
        <p><?= $_SESSION["login"]; ?></p>
        <div class="dropdown">
            <span>Menu</span>
            <div class="dropdown-content">
                <a href = "<?= $router->route("Controller.sair"); ?>">Sair</a>
            </div>
        </div>
    </div>
    <div id="lista_contatos">
        <?php
        if(!empty($contatos)):
            foreach($contatos as $item):
                $v->insert("contato",["nome"=>$item->nm_contato,"conversa"=>$item->id_conversa]);
            endforeach;
        endif;
        ?>
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
        <p>Contato</p>
    </div>
    <div id="corpo_chat">
        <ul>
        <?php
            for($i=0;$i<14;$i++):
                $tipo =($i%2)?"recebida":"enviada";
                $v->insert("mensagem",["tipo"=>$tipo,"texto"=>"teste"]);
            endfor;
        ?>
        </ul>
    </div>
    <div id="form_mensagem">
        <form class="form_add_mensagem" method="post" action = "">
            <input type="hidden" name="hdConversa" id="hdConversa">
            <input type="text" name="txtMsg" id="txtMsg">
            <button>Enviar</button>
        </form>
    </div>
</div>

<?php $v->start("js"); ?>
<script>
    $(function(){
        $(".item_contato").click(function (e){
            var botao = $(this);
            var chat = $("#chat");
            var conversa = $("#hdConversa");
            var corpoChat = $("#corpo_chat");

            chat.css("display","block");
            conversa.val(botao.val());
            corpoChat.scrollTop(corpoChat.prop('scrollHeight'));
        });

        $(".form_add_contato").submit(function (e){
            e.preventDefault();
            var form = $(this);
            var loginContato = $("#txtAddContato");

            $.ajax({
                url: form.attr("action"),
                data: form.serialize(),
                type: "POST",
                dataType: "json",
                beforeSend: function(){

                },
                success: function(callback){
                    if(callback.contato){
                        $("#lista_contatos").prepend(callback.contato);
                    }
                },
                complete: function(){

                }
            });
        });
    });
</script>
<?php $v->end(); ?>