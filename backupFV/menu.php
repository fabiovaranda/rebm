
<style>
	li a:hover {
		background:#46871E;
	}
</style>

<?php

function mostrarLogin(){
	echo "
	<div class='ink-grid' >
		<div style='position:relative; left:63%; width:450px'>
		<form class='ink-form' method='post' action='login.php'>
		 <div class='control-group'>
			<input type='text' placeholder='e-mail' name='email' />
				<input type='password' placeholder='password' name='password' />
				<input type='submit' class='ink-button' value='Entrar' />
		</div>
		</form>
		</div>
	</div>
	";
	
}

function menuAdminSmall(){
	
	echo "
	<nav class='ink-navigation' >
		<ul class='menu horizontal' style='background-color:#40461B;'>
			<li>
				<a style='text-decoration: none;'  href='editarUtilizador.php'><font color='white'><b>Perfil</b></font></a>
			</li>
			<li>
				<a href='inserirUtentes.php'><font color='white'><b>Inserir Utente</b></font></a>
			</li>
			<li>
				<a href='gerirUtentes.php'><font color='white'><b>Gerir Utentes</b></font></a>
			</li>
			<li>
				<a href='inserirUtilizador.php'><font color='white'><b>Inserir Utilizador</b></font></a>
			</li>
			<li>
				<a href='gerirUtilizadores.php'><font color='white'><b>Editar Utilizadores</b></font></a>
			</li>
			<li>
				<a href='inserirNoticias.php'><font color='white'><b>Inserir Notícia</b></font></a>
			</li>
			<li>
				<a href='editarNoticias.php'><font color='white'><b>Editar Notícias</b></font></a>
			</li>
			<li>
				<a href='gerirVideos.php'><font color='white'><b>Vídeos</b></font></a>
			</li>
			<li>
				<a href='mensagem.php'><font color='white'><b>Mensagens</b></font></a>
			</li>
			<li class='push-right'>
				<a href='logout.php' onclick='return confirmarLogout()'> <font color='white'><b>Sair </b></font></a> 
			</li>
				
		</ul>
	</nav>
	";
	
}

function menuUtilizadorSmall(){
	echo "
	<nav class='ink-navigation'>
		<ul class='menu horizontal' style='background-color:#40461B;'>
			<li>
				<a href='editarUtilizador.php'><font color='white'><b>Perfil</b></font></a>
			</li>
			<li>
				<a href='inserirNoticias.php'><font color='white'><b>Inserir Notícia</b></font></a>
			</li>
			<li>
				<a href='editarNoticias.php'><font color='white'><b>Editar Notícias</b></font></a>
			</li>
			<li class='push-right'>
				<a href='logout.php' onclick='return confirmarLogout()'> <font color='white'><b>Sair </b></font></a> 
			</li>
		</ul>
	</nav>";
}

function menuGestorUtentesSmall(){
	echo "
	<nav class='ink-navigation'>
		<ul class='menu horizontal' style='background-color:#40461B;'>
			<li>
				<a href='editarUtilizador.php'><font color='white'><b>Perfil</b></font></a>
			</li>
			<li>
				<a href='inserirUtentes.php'><font color='white'><b>Inserir Utente</b></font></a>
			</li>
			<li>
				<a href='gerirUtentes.php'><font color='white'><b>Gerir Utentes</b></font></a>
			</li>
			<li>
				<a href='mensagem.php'><font color='white'><b>Caixa de Entrada</b></font></a>
			</li>
			<li class='push-right'>
				<a href='logout.php' onclick='return confirmarLogout()'> <font color='white'><b>Sair </b></font></a> 
			</li>
		</ul>
	</nav>";
}

function gerirMenuTopo(){
	if (isset($_SESSION['id'])){
		   include_once 'DataAccess.php';
		   $da = new DataAccess();
		   $idTipo = $da->getTipoUtilizador($_SESSION['id']);
		   switch($idTipo)
			{
			 case 1: //administrador
				 menuAdminSmall(); 
				 break;
			 case 2: //gestor de utentes
				 menuGestorUtentesSmall();
				 break;
			 case 3: //gestor de notícias
				 menuUtilizadorSmall();
				 break;
			}
	}
	else
		mostrarLogin();
	
}

function curPageURL() {
 $pageURL = 'http';
 if (isset($_SERVER['HTTPS'])){
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 }
 $pageURL .= "://";
 
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 $arr = explode('/',$pageURL);
 return $arr[count($arr)-1]; 
}

function getImagem(){
	$img = mt_rand(0, 2);
	
	switch($img){
		case 0: 
			return "<img src='img/exemplo1.png' align='right' height='171px' >";
		break;
		case 1: 
			return "<img src='img/exemplo2.png' align='right' height='171px' >";
		break;
		case 2: 
			return "<img src='img/exemplo3.png' align='right' height='171px' >";
		break;
	}
}


function menu(){
    $url = curPageURL();
    gerirMenuTopo();
    echo "<div class='ink-grid'>";
	
		
		echo "
			<header class='vspace'>
				<a href='index.php'> <img src='img/customLogo.png'> </a> 
				".getImagem()."
			</header>
			<nav class='ink-navigation' id='nav_menu'>
				<ul class='menu horizontal green rounded shadowed'>";
				if($url == "index.php")
					echo "<li class='active'><a href='index.php'><b>Início</b></a></li>";
				else
					echo "<li><a href='index.php'><b>Início</b></a></li>";

				if ($url == "missaoevisao.php" || $url == "eixodeatuacao.php" )    
				   echo "<li class='active'>";
				else
				   echo "<li>";
				echo "
					<a><b>Sobre nós</b></a>
						<ul class='submenu'>
							<li>
								<a href='missaoevisao.php'>Missão e Visão</a>
							</li>
							<li>
								<a href='eixodeatuacao.php'>Eixos de Atuação</a>
							</li>
							<li>
								<a href='mensagem.php'>Envie-nos uma Mensagem</a>
							</li>
						</ul>
					</li>";
        
				if ($url == "membrosrede.php" || $url == "VantagensparaMembrosdaRede.php" )    
				   echo "<li class='active'>";
				else
				   echo "<li>";

					echo "
						<a><b>Membros</b></a>
							<ul class='submenu'>
							<li>
								<a href='membrosrede.php'>Membros da Rede</a>
							</li>
							<li>
								<a href='VantagensparaMembrosdaRede.php'>Vantagens e Beneficios</a>
							</li>
							</ul>
					</li>";
				if ($url == "Documentos.php" || $url == "fotografias.php" )    
				   echo "<li class='active'>";
				else
				   echo "<li>";

				echo "
					<a><b>Recursos</b></a>
					<ul class='submenu'>
						<li>
							<a href='Documentos.php'>Documentos</a>
						</li>
						<li>
							<a href='fotografias.php'> Fotografias </a>
						</li>
						<li>
							<a href='video.php'> Multimédia </a>
						</li>
					</ul>
					</li>";
				 if ($url == "Anossaperspectiva.php" || $url == "Principaisatividades.php" )    
				   echo "<li class='active'>";
				else
				   echo "<li>";

				echo "
					<a href='Anossaperspectiva.php'><b>Qualificação e Emprego</b></a>
					<ul class='submenu large-100'>
						<li>
							<a href='Principaisatividades.php'> Principais Atividades</a>
						</li>
					</ul>
				</li>";
				if ($url == "anossaperspectiva_R.php" || $url == "PrincipaisAtividades1.php" || $url == "GabinetesdeAtendimento.php" )    
				   echo "<li class='active'>";
				else
				   echo "<li>";
				echo "
					<a href='anossaperspectiva_R.php'><b>Rede de Front Offices</b></a>
					<ul class='submenu large-100'>
						<li>
							<a href='PrincipaisAtividades1.php'> Principais Atividades</a>
						</li>
						<li>
							<a href='GabinetesdeAtendimento.php'>Gabinetes de Atendimento</a>
						</li>
					</ul>
				</li>";
				if ($url == "Anossaperspectiva_E.php" || $url == "PrincipaisAtividades2.php")    
				   echo "<li class='active'>";
				else
				   echo "<li>";
				echo "
				<a href='Anossaperspectiva_E.php'><b>Empreendedorismo e Desenvolvimento Local</b></a>
				<ul class='submenu large-100'>
					<li>
						<a href='PrincipaisAtividades2.php'> Principais Atividades</a>
					</li>
				</ul>
				</li>
			</ul>
		</nav>
</div>";
    
}

function menuUtilizador(){
    $url = curPageURL();
   
    echo "<div class='ink-grid'>";
	gerirMenuTopo();
	echo "
<header class='vspace'>
    <a href='index.php'> <img src='img/customLogo.png'> </a> 
		".getImagem()."

</header>
  <nav class='ink-navigation' id='nav_menu'>
<ul class='menu horizontal green rounded shadowed'>";
if($url == "index.php")
    echo "<li class='active'><a href='index.php'><b>Início</b></a></li>";
else
    echo "<li><a href='index.php'><b>Início</b></a></li>";

if ($url == "missaoevisao.php" || $url == "eixodeatuacao.php" )    
   echo "<li class='active'>";
else
   echo "<li>";

        echo "
        <a><b>Sobre nós</b></a>
        <ul class='submenu'>
            <li>
                <a href='missaoevisao.php'>Missão e Visão</a>
            </li>
            <li>
            <li>
                <a href='eixodeatuacao.php'>Eixos de Atuação</a>
            </li>
        </ul>
    </li>";
        
if ($url == "membrosrede.php" || $url == "VantagensparaMembrosdaRede.php" )    
   echo "<li class='active'>";
else
   echo "<li>";

echo "
    <a><b>Membros</b></a>
<ul class='submenu'>
<li>
    <a href='membrosrede.php'>Membros da Rede</a>
</li>
<li>
    <a href='VantagensparaMembrosdaRede.php'>Vantagens e Beneficios</a>
</li>
</ul>
</li>";
if ($url == "Documentos.php" || $url == "fotografias.php" )    
   echo "<li class='active'>";
else
   echo "<li>";

echo "
    <a><b>Recursos</b></a>
    <ul class='submenu'>
<li>
    <a href='Documentos.php'>Documentos</a>
</li>

<li>
    <a href='fotografias.php'> Fotografias </a>
</li>
<li>
	<a href='video.php'> Multimédia </a>
</li>
</ul>
</li>";
 if ($url == "Anossaperspectiva.php" || $url == "Principaisatividades.php" )    
   echo "<li class='active'>";
else
   echo "<li>";

echo "
     <a href='Anossaperspectiva.php'><b>Qualificação e Emprego</b></a>
     
    <ul class='submenu large-100'>
   
    <li>
    <a href='Principaisatividades.php'> Principais Atividades</a>
    </li>
    </ul>
    </li>";
if ($url == "anossaperspectiva_R.php" || $url == "PrincipaisAtividades1.php" || $url == "GabinetesdeAtendimento.php" )    
   echo "<li class='active'>";
else
   echo "<li>";

echo "
    <a href='anossaperspectiva_R.php'><b>Rede de Front Offices</b></a>
    <ul class='submenu large-100'> 
    
    <li>
    <a href='PrincipaisAtividades1.php'> Principais Atividades</a>
<li>
    <a href='GabinetesdeAtendimento.php'>Gabinetes de Atendimento</a>
    </ul>
</li>
</li>
</li>";
if ($url == "Anossaperspectiva_E.php" || $url == "PrincipaisAtividades2.php")    
   echo "<li class='active'>";
else
   echo "<li>";

echo "
<a href='Anossaperspectiva_E.php'><b>Empreendedorismo e Desenvolvimento Local</b></a>
<ul class='submenu large-100'>

<li>
<a href='PrincipaisAtividades2.php'> Principais Atividades</a>
</li>
</ul>
</li>
</li>
";



echo "

</ul>
</nav>

</div>



";
    
}

function menuAdmin(){
        $url = curPageURL();
   
    echo "<div class='ink-grid'>";
	
	gerirMenuTopo();
	echo "
<header class='vspace'>
    <a href='index.php'> <img src='img/customLogo.png'> </a> 
 ".getImagem()."

</header>
  <nav class='ink-navigation' id='nav_menu'>
<ul class='menu horizontal green rounded shadowed'>";
if($url == "index.php")
    echo "<li class='active'><a href='index.php'><b>Início</b></a></li>";
else
    echo "<li><a href='index.php'><b>Início</b></a></li>";

if ($url == "missaoevisao.php" || $url == "eixodeatuacao.php" )    
   echo "<li class='active'>";
else
   echo "<li>";

        echo "
        <a><b>Sobre nós</b></a>
        <ul class='submenu'>
            <li>
                <a href='missaoevisao.php'>Missão e Visão</a>
            </li>
            <li>
            <li>
                <a href='eixodeatuacao.php'>Eixos de Atuação</a>
            </li>
        </ul>
    </li>";
        
if ($url == "membrosrede.php" || $url == "VantagensparaMembrosdaRede.php" )    
   echo "<li class='active'>";
else
   echo "<li>";

echo "
    <a><b>Membros</b></a>
<ul class='submenu'>
<li>
    <a href='membrosrede.php'>Membros da Rede</a>
</li>
<li>
    <a href='VantagensparaMembrosdaRede.php'>Vantagens e Beneficios</a>
</li>
</ul>
</li>";
if ($url == "Documentos.php" || $url == "fotografias.php" )    
   echo "<li class='active'>";
else
   echo "<li>";

echo "
    <a><b>Recursos</b></a>
    <ul class='submenu'>
<li>
    <a href='Documentos.php'>Documentos</a>
</li>
<li>
    <a href='fotografias.php'> Fotografias </a>
</li>
<li>
	<a href='video.php'> Multimédia </a>
</li>
</ul>
</li>";
 if ($url == "Anossaperspectiva.php" || $url == "Principaisatividades.php" )    
   echo "<li class='active'>";
else
   echo "<li>";

echo "
     <a href='Anossaperspectiva.php'><b>Qualificação e Emprego</b></a>
     
    <ul class='submenu large-100'>
    
    <li>
    <a href='Principaisatividades.php'> Principais Atividades</a>
    </li>
    </ul>
    </li>";
if ($url == "anossaperspectiva_R.php" || $url == "PrincipaisAtividades1.php" || $url == "GabinetesdeAtendimento.php" )    
   echo "<li class='active'>";
else
   echo "<li>";

echo "
    <a href='anossaperspectiva_R.php'><b>Rede de Front Offices</b></a>
    <ul class='submenu large-100'> 
    
    <li>
    <a href='PrincipaisAtividades1.php'> Principais Atividades</a>
<li>
    <a href='GabinetesdeAtendimento.php'>Gabinetes de Atendimento</a>
    </ul>
</li>
</li>
</li>";
if ($url == "Anossaperspectiva_E.php" || $url == "PrincipaisAtividades2.php")    
   echo "<li class='active'>";
else
   echo "<li>";

echo "
<a href='Anossaperspectiva_E.php'><b>Empreendedorismo e Desenvolvimento Local</b></a>
<ul class='submenu large-100'>

<li>
<a href='PrincipaisAtividades2.php'> Principais Atividades</a>
</li>
</ul>
</li>
</li>
";



echo "
</nav>
 </div>";
 }
 
 function menuGestorUtentes(){
        $url = curPageURL();
   
    echo "<div class='ink-grid'>";
	gerirMenuTopo();
	echo "
<header class='vspace'>
    <a href='index.php'> <img src='img/customLogo.png'> </a> 
  ".getImagem()."

</header>
  <nav class='ink-navigation' id='nav_menu'>
<ul class='menu horizontal green rounded shadowed'>";
if($url == "index.php")
    echo "<li class='active'><a href='index.php'><b>Início</b></a></li>";
else
    echo "<li><a href='index.php'><b>Início</b></a></li>";

if ($url == "missaoevisao.php" || $url == "eixodeatuacao.php" )    
   echo "<li class='active'>";
else
   echo "<li>";

        echo "
        <a><b>Sobre nós</b></a>
        <ul class='submenu'>
            <li>
                <a href='missaoevisao.php'>Missão e Visão</a>
            </li>
            <li>
            <li>
                <a href='eixodeatuacao.php'>Eixos de Atuação</a>
            </li>
        </ul>
    </li>";
        
if ($url == "membrosrede.php" || $url == "VantagensparaMembrosdaRede.php" )    
   echo "<li class='active'>";
else
   echo "<li>";

echo "
    <a><b>Membros</b></a>
<ul class='submenu'>
<li>
    <a href='membrosrede.php'>Membros da Rede</a>
</li>
<li>
    <a href='VantagensparaMembrosdaRede.php'>Vantagens e Beneficios</a>
</li>
</ul>
</li>";
if ($url == "Documentos.php" || $url == "fotografias.php" )    
   echo "<li class='active'>";
else
   echo "<li>";

echo "
    <a><b>Recursos</b></a>
    <ul class='submenu'>
<li>
    <a href='Documentos.php'>Documentos</a>
</li>
<li>
    <a href='fotografias.php'> Fotografias </a>
</li>
<li>
	<a href='video.php'> Multimédia </a>
</li>
</ul>
</li>";
 if ($url == "Anossaperspectiva.php" || $url == "Principaisatividades.php" )    
   echo "<li class='active'>";
else
   echo "<li>";

echo "
     <a href='Anossaperspectiva.php'><b>Qualificação e Emprego</b></a>
     
    <ul class='submenu large-100'>
    
    <li>
    <a href='Principaisatividades.php'> Principais Atividades</a>
    </li>
    </ul>
    </li>";
if ($url == "anossaperspectiva_R.php" || $url == "PrincipaisAtividades1.php" || $url == "GabinetesdeAtendimento.php" )    
   echo "<li class='active'>";
else
   echo "<li>";

echo "
    <a href='anossaperspectiva_R.php'><b>Rede de Front Offices</b></a>
    <ul class='submenu large-100'> 
    
    <li>
    <a href='PrincipaisAtividades1.php'> Principais Atividades</a>
<li>
    <a href='GabinetesdeAtendimento.php'>Gabinetes de Atendimento</a>
    </ul>
</li>
</li>
</li>";
if ($url == "Anossaperspectiva_E.php" || $url == "PrincipaisAtividades2.php")    
   echo "<li class='active'>";
else
   echo "<li>";

echo "
<a href='Anossaperspectiva_E.php'><b>Empreendedorismo e Desenvolvimento Local</b></a>
<ul class='submenu large-100'>

<li>
<a href='PrincipaisAtividades2.php'> Principais Atividades</a>
</li>
</ul>
</li>
</li>
";



echo "
</nav>
 </div>";
 }


if(isset($_SESSION['id'])){
   //está logado
   //if / switch com os tipos de permissão do utilizador
   //se for 1 = admin, 2 = gestor de utentes, 3 = gestor de noticias
   //através do $_SESSION['id'] tens que ir buscar o idTipoUtilizador 
   include_once 'DataAccess.php';
   $da = new DataAccess();
   $idTipo = $da->getTipoUtilizador($_SESSION['id']);
   switch($idTipo)
    {
     case 1: //administrador
         menuAdmin(); 
         break;
     case 2: //gestor de utentes
         menuGestorUtentes();
         break;
     case 3: //gestor de notícias
         menuUtilizador();
         break;
    }
}else{
   //não está logado
   menu();
}
?>


<script>
    function confirmarLogout(){
        return confirm('Tem a certeza que deseja sair?');
    }
</script>