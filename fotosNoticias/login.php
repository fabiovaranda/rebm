<?php
include('importarBibliotecas.php');
if (isset($_SESSION['id']))
	echo "<script>window.location='index.php';</script>";

?>
<?php
if(isset($_POST['email'])){
    //estão a tentar fazer login    
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    
    include_once 'DataAccess.php';
    $da = new DataAccess();
    $res = $da->login($email, md5($pwd));
    $row = mysql_fetch_assoc($res);
	echo "id".$row['id'];
    if($row['id'] != ""){
        session_start();
		session_name('empregabilidadebm');
        $_SESSION['id'] = $row['id'];        
		$_SESSION['idTiposDePermissoes'] = $row['idTiposDePermissoes'];   
		if ($_SESSION['idTiposDePermissoes'] != 3)		
			echo "<script>window.location='gerirUtentes.php'</script>";
		else
			echo "<script>window.location='index.php'</script>";	
    }else{
       //email ou pwd errados
        echo "<script>alert('E-mail ou Palavra-Passe Errados')</script>";        
        
    }
}
?>

<body>
<?php
include('menu.php');
include('login.html');
include('footer.php');
?>
</body>
