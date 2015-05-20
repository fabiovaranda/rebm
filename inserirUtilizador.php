<?php
         include('importarBibliotecas.php');
		 
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
		 
        ?>

    <body>
        <?php
        include('menu.php');
        
         if ( isset ($_POST['nome'])){
			
			$email=htmlentities($_POST['email']);  
			
			if(VerificarEnderecodeEmail($email))  
			{			
			    $nome = $_POST['nome'];
				$password = md5($_POST['password']);
				$tipoUtilizador = $_POST ['tipoUtilizador'];
				$entidade = $_POST ['entidadeUtilizador'];
				include_once('DataAccess.php');
				$da = new DataAccess();
				$res = $da->inserirUtilizador($nome, $email, $password, $tipoUtilizador, $entidade); 
				if ($res == 1){
					echo "<script>
					alert('O utilizador foi inserido com sucesso.');
					window.location='inserirUtilizador.php';
					</script>";
				}else{
					echo "<script>
					alert('E-mail já utilizado. Tente de novo');
					window.location='inserirUtilizador.php';
					</script>";
				}
			}
			else  
			  echo "<script>
					alert('E-mail inválido. Tente de novo');
					window.location='inserirUtilizador.php';
					</script>";
        }
      

        if (isset($_SESSION['id'])){
        echo "
           <br>
        <div class='ink-grid'>
        <form class='ink-form' method='post' action='inserirUtilizador.php' enctype='multipart/form-data'>         
                <legend><h1><font color='#1A9018'>Novo Utilizador</h1></font></legend>
                <br>
                <input type='text' name='nome' placeholder='Nome' required style='width:250px'/>
                <input type='text' name='email' placeholder='Email' required style='width:350px'/>
                <input type='password' name='password' placeholder='Password' required/>
				<br/>
				<br/>
               
				";
				include_once('DataAccess.php');
				$da = new DataAccess();
				$res = $da->getFrontOffices();
				echo"<select name='entidadeUtilizador'>
						";
						while($row = mysql_fetch_object($res)){
							echo "<option value='".$row->id."'><font size='10'>".$row->nome."</font></option>";
						}
					echo"
					</select>
					<br/>
					<br/>
					<select name='tipoUtilizador'>
						<option value='1'> Administrador </option>
						<option value='2'> Gestor de Utentes </option>
						<option value='3'> Gestor de Notícias </option>
					</select>
					<br/><br/>
                <input type='submit' class='ink-button green' value='Inserir'>                       
			</form>
        </div>
        
           <br>
           <br>";
		   }
                
        ?>
        <?php
        include('footer.php');
        ?>
    </body>
</html>
   