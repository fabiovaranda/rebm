<?php
include('importarBibliotecas.php');
?>
<?php
		 
if (!isset($_SESSION['idTiposDePermissoes']))
	echo "<script>window.location='index.php'</script>";
		 
function VerificarEnderecodeEmail($endereco)  
{  
   $Sintaxe='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';  
   if(preg_match($Sintaxe,$endereco))  
      return true;  
   else  
     return false;  
}

?>

<body>
        <?php
        include('menu.php');
        
        if ( isset ($_POST['nome'])){
			
			$email=htmlentities($_POST['email']);  
			
			if(VerificarEnderecodeEmail($email))  
			{
				$id = $_POST['ID'];
			    $nome = $_POST['nome'];
				$password = $_POST['password'];
				//$entidade = $_POST['entidadeUtilizador'];
				include_once('DataAccess.php');
				$da = new DataAccess();
				$res = $da->updatePerfil($nome, $email, $id, $password, 999); 
				if ($res == 1){
					echo "<script>
					alert('Informações editadas com sucesso.');
					window.location='editarUtilizador.php';
					</script>";
				}else{
					echo "<script>
					alert('E-mail já utilizado por outro utilizador. Tente de novo');
					window.location='editarUtilizador.php';
					</script>";
				}
			}
			else  
			  echo "<script>
					alert('E-mail inválido. Tente de novo');
					window.location='gerirUtilizadores.php?i=$id';
					</script>";
        }
		
		
		

        if (isset($_SESSION['id'])){
			$res = $da->getUtilizador($_SESSION['id']);
			$row = mysql_fetch_object($res);
        echo "
           <br>
        <div class='ink-grid'>
        <form class='ink-form' method='post' action='editarUtilizador.php' enctype='multipart/form-data'>         
                <legend><h1><font color='#1A9018'>Editar Utilizador</h1></font></legend>
                <br>
				<input type='hidden' name='ID' value='".$_SESSION['id']."' />
                <input type='text' autofocus name='nome' placeholder='nome' required value='$row->nome' style='width:250px'/>
                <input type='text' name='email' placeholder='email' value='$row->email' required style='width:350px'/>
                <input type='password' name='password' placeholder='password'/>
                <input type='submit' class='ink-button green' value='editar'>       
				
        </form>
		<br/>Nota: Se não colocar qualquer informação no campo 'password', esta não irá ser alterada
        </div>";
        }
        ?>
		<br/>
		<br/>
        <?php
        include('footer.php');
        ?>
    </body>
</html>
   