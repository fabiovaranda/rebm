<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea'});
</script>
<script>
    function confirmacaoEliminacao(i){
        if(confirm('Tem a certeza que deseja eliminar?')){
            window.location='eliminarMensagem.php?i='+i;
        }
    }
    

</script>

<?php

if ( isset ($_POST['mensagem'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $assunto = $_POST['assunto'];
    $mensagem = $_POST['mensagem'];
    include_once('DataAccess.php');
    $da = new DataAccess();
    $res = $da->inserirMensagem($nome, $email, $assunto, $mensagem); 
	
	$to = "empregabilidadebm@gmail.com";
    $subject = "empregabilidadebm.pt: Nova mensagem com o assunto: ".$_POST['assunto'].".";
    $message = "Existe uma nova mensagem no site empregabilidadebm.pt:<br/>".$_POST['mensagem']."<br/>Para visualizar a mensagem, entre com a sua conta no site: http://empregabilidadebm.pt";
	$headers = 'From: empregabilidadebm@gmail.com' . "\r\n" .
    'Reply-To: empregabilidadebm@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
    $retval = mail ($to,$subject,$message,$headers);
    
    echo "<script>
    alert('A mensagem foi enviada com sucesso.');
    window.location='index.php';
    </script>";
}
         
function formularioEnviarMensagem(){
    echo "
<div class='ink-grid'>
    <br>
    <div class='column-group'>
        <div class='large-23 medium-23 small-23'>
            <div class='ink-grid'> 
                <h1><font color='#1A9018'>Mensagem</font></h1>
            </div>                      
        </div> 
        <div class='large-70 medium-70 small-70'>
            <br/><br/><br/>
            <fieldset>
                <form class='ink-form' method='post' action='inserirMensagem.php'>
                <div class='ink-grid'>
                    <div class='column-group'>
                        <div class='control-group'>
                            <label for='text-input'>
                            <b>Nome</b>
                            </label>
                            <div class='control'>
                                <input  name='nome' type='text' placeholder='Insira aqui o seu Nome'>
                            </div>
                        </div>
                    </div>
                    <div class='column-group'>
                        <div class='control-group'>
                            <label for='text-input'>
                            <b>E-mail</b>
                            </label>
                            <div class='control'>
                                <input name='email' type='text' placeholder='Insira aqui o seu E-mail'>
                            </div>
                        </div>
                    </div>
                    <div class='column-group'>
                        <div class='control-group'>
                            <label for='text-input'><b>Assunto</b></label>
                            <div class='control'>
                                <input name='assunto' type='text' placeholder='Insira aqui o Assunto'>
                            </div>
                        </div>
                    </div>
                    <div class='column-group'>
                        <div class='control-group'>
                        <label for='text-input'><b>Mensagem</b></label>
                            <div class='control'>
                                <textarea  name='mensagem' rows='10' placeholder='Escreva sua mensagem'></textarea> 
                            </div>
                        </div>
                    </div>
                    <input type='submit' value='Enviar Mensagem' class='ink-button green'>
                    
                </div>
                 </form> 
                </fieldset>
        </div>
        <div class='large-15 medium-15 small-15'>
        </div>
    </div>
   
</div>
<br><br>";
}

function verMensagens(){
    include_once('DataAccess.php');
    $da = new DataAccess();
    $res = $da->verMensagens();
    echo "<div class='ink-grid'>
        <br/>
	<h1> <font color='#1A9018'>Caixa de Entrada</font></h1>
        </div>";
		$conta = 0;
    while($row = mysql_fetch_assoc($res)){
		$conta++;
        echo "
			<div class='ink-grid'>
			<nav class='ink-navigation space'>
				<ul class ='menu horizontal rounded shadowed grey'>
					<li><b>&nbsp;Nome do Remetente:</b> ".$row['nome']."<br/><b>&nbsp;E-mail:</b> ".$row['email']."<br/><b>&nbsp;Assunto:</b>".$row['assunto'];
        echo "<br/>&nbsp;";
        echo $row['mensagem'];
        echo "<br/></li></ul></nav></div>";
		echo "<div class='ink-grid'>
			  <nav class='ink-navigation space'>
			  <a href='http://www.hotmail.com/' target='_blank'>
				<input type='button' class='ink-button blue' value='Responder via Hotmail'>
			  </a>
			  <a href='http://www.gmail.com/' target='_blank'>
				<input type='button' class='ink-button blue' value='Responder via Gmail'>
			  </a>
			  <input type='button' class='ink-button red' onclick='confirmacaoEliminacao(".$row['id'].")' value='Eliminar'/></nav></div>";
    }
	if ($conta == 0){
	echo "<div class='ink-grid'>
        <br/>
			<h4>Não tem mensagens novas.</h4>
        </div>";
		
	}
}

if(isset($_SESSION['id'])){
    verMensagens();
}else{
    formularioEnviarMensagem();
}

?>



