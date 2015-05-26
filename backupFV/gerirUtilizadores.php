<?php
include('importarBibliotecas.php');
?>
<script>
function confirmarEliminarUtilizador(){
	return confirm("Tem a certeza que deseja eliminar o utilizador?");
}
</script>
<?php
		 
if ($_SESSION['idTiposDePermissoes'] != '1')
	echo "<script>window.location='index.php'</script>";
		 
function VerificarEnderecodeEmail($endereco)  
{  
   $Sintaxe='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';  
   if(preg_match($Sintaxe,$endereco))  
      return true;  
   else  
     return false;  
}

if (isset($_GET['el'])){
	include_once('DataAccess.php');
	$da = new DataAccess();
	$da->eliminarUtilizador($_GET['el']);
	echo "<script>alert('Utilizador eliminado com sucesso')</script>";
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
				$tipoUtilizador = $_POST['tipoUtilizador'];
				$entidade = $_POST['entidadeUtilizador'];
				include_once('DataAccess.php');
				$da = new DataAccess();
				
				$res = $da->updatePerfil($nome, $email, $id, $password, $tipoUtilizador, $entidade); 
				if ($res == 1){
					echo "<script>
					alert('O utilizador foi editado com sucesso.');
					window.location='gerirUtilizadores.php?i=$id';
					</script>";
				}else{
					echo "<script>
					alert('E-mail já utilizado por outro utilizador. Tente de novo');
					window.location='gerirUtilizadores.php?i=$id';
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
			include_once('DataAccess.php');
			$da = new DataAccess();
			$res = $da->getTecnicos();
			
			echo "
			  <div class='ink-grid'>
				<h1><font color='#1A9018'>Utilizadores</h1></font>
  			  <table class='ink-table'>
			  <thead>
				<tr>
				  <th class='align-left'>Nome</th>
				  <th class='align-left'>E-mail</th>
				  <th class='align-left'>Entidade</th>
				  <th class='align-left'></th>
				  <th class='align-left'></th>
				</tr>
			  </thead>
			  <tbody>
			";
			while($row = mysql_fetch_object($res)){
			  echo "
				<tr>
				  <td>$row->nome</td>
				  <td>$row->email</td>
				  <td>$row->MNome</td>
				  <td><a href='gerirUtilizadores.php?i=$row->id'><img title='Editar' src='img/edit.png'/></a></td>
				  <td><a href='gerirUtilizadores.php?el=$row->id' onclick='return confirmarEliminarUtilizador()'><img title='Eliminar' src='img/delete.png' style='width:32px'/></a></td>
				</tr>
			  ";
			}
			echo "</tbody></table></div>";
		}
		

        if (isset($_GET['i'])){
			$res = $da->getUtilizador($_GET['i']);
			$row = mysql_fetch_object($res);
        echo "
           <br>
        <div class='ink-grid'>
        <form class='ink-form' method='post' action='gerirUtilizadores.php' enctype='multipart/form-data'>         
                <legend><h1><font color='#1A9018'>Editar Utilizador</h1></font></legend>
                <br>
				<input type='hidden' name='ID' value='".$_GET['i']."' />
                <input type='text' autofocus name='nome' placeholder='nome' required value='$row->nome' style='width:250px'/>
                <input type='text' name='email' placeholder='email' value='$row->email' required style='width:350px'/>
                <input type='password' name='password' placeholder='password'/>
				<br/><br/>
				";
				$da = new DataAccess();
				$res2 = $da->getFrontOffices();
				echo"<select name='entidadeUtilizador'>
					 
				
					";
					while($row2 = mysql_fetch_object($res2)){
						
						if ($row->idInstituicao == $row2->id)
						{
							echo "<option value='".$row2->id."' selected><font size='10'>".$row2->nome."</font></option>";
							}
						else
							echo "<option value='".$row2->id."'><font size='10'>".$row2->nome."</font></option>";
					}
				echo"
				</select><br/> <br/>
				<select name='tipoUtilizador'>";
				switch ($row->idTiposDePermissoes){
					case '1':
					echo "
                    <option value='2' > Gestor de Utentes </option>
                    <option value='3'> Gestor de Notícias </option>
					<option value='1' selected> Administrador </option>"; break;
					case '2':
					echo "
                    <option value='2' selected> Gestor de Utentes </option>
                    <option value='3'> Gestor de Notícias </option>
					<option value='1'> Administrador </option>"; break;
					case '3':
					echo "
                    <option value='2' > Gestor de Utentes </option>
                    <option value='3' selected> Gestor de Notícias </option>
					<option value='1'> Administrador </option>"; break;
					}
                echo "
				</select><br/><br/>
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
   