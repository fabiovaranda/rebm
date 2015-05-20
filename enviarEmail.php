<?php
include('importarBibliotecas.php');
if (!isset($_SESSION['id']))
	echo "<script>window.location='index.php';</script>";
?>
<?php include('menu.php'); ?>
<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea'});
</script>

<?php
	if (isset($_GET['i'])){
		$idUtente = $_GET['i'];
		include_once ('DataAccess.php');
		$da = new DataAccess();
		$email = $da->getEmailUtente($idUtente);		
	}else
		echo "<script>window.location='gerirUtentes.php'</script>";
	
	if ( isset ($_POST['mensagem'])){
		$idTecnico = $_SESSION['id'];
		$res = $da->getFrontOfficeSinalizador($idTecnico);
		$row = mysql_fetch_object($res);
		$nomeTecnico = $row->TNome;
		$frontOffice = $row->FNome;
		$to = $_POST['email'];
		$subject = "empregabilidadebm.pt - nova mensagem com o assunto: ".$_POST['assunto'].".";
		$message = "Mensagem enviada por $nomeTecnico do <i>Front Office</i> $frontOffice: <br/><br/>".$_POST['mensagem'];
		$headers = 'From: REBM empregabilidadebm@gmail.com' . "\r\n" .
		'Reply-To: empregabilidadebm@gmail.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		$retval = mail ($to,$subject,$message,$headers);
		
		echo "<script>
			alert('E-mail enviado com sucesso.');
			window.location='gerirUtentes.php';
		</script>";
	}
?>
<div class='ink-grid'>
    <br>
    <div class='column-group'>        
		<div class='large-15 medium-15 small-15'>
			&nbsp;
		</div>
        <div class='large-70 medium-70 small-70'>
            <br/>
			<center>
            <fieldset>
                <form class='ink-form' method='post' action='enviarEmail.php?i=<?php echo $_GET['i']; ?>'>
                <div class='ink-grid'>
                    <div class='column-group'>
                        <div class='control-group'>
                            <label for='text-input'>
                            <b>E-mail</b>
                            </label>
                            <div class='control'>
                                <input name='email' type='text' value='<?php echo $email; ?>' title='E-mail do Utente'>
                            </div>
                        </div>
                    </div>
                    <div class='column-group'>
                        <div class='control-group'>
                            <label for='text-input'>
                            <b>Assunto</b>
                            </label>
                            <div class='control'>
                                <input  name='assunto' type='text' placeholder='Assunto...'>
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
			</center>
		</div>
		<div class='large-15 medium-15 small-15'>
			&nbsp;
		</div>
    </div>
</div>
<br/>

<?php include('footer.php'); ?>

</body>
</html>