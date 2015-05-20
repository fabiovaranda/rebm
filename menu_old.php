<?php

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

function menu(){
    $url = curPageURL();
   
    echo "<div class='ink-grid'>
<header class='vspace'>
    <a href='index.php'> <img src='img/customLogo.png'> </a> 
  <img src='img/headerDS.gif' align='right'height='171px' >

</header>
  <nav class='ink-navigation' id='nav_menu'>
<ul class='menu horizontal green rounded shadowed'>";
if($url == "index.php")
    echo "<li class='active'><a href='index.php'><b>Início</b></a></li>";
else
    echo "<li><a href='index.php'><b>Início</b></a></li>";

if ($url == "missaoevisao.php" || $url == "eixodeatuacao.php" || $url == "mensagem.php")    
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


<li class='push-right'> <a href='login.php'><b> Entrar </b> </a> </li>
    
</ul>
</nav>

</div>";
    
}

function menuUtilizador(){
    $url = curPageURL();
   
    echo "<div class='ink-grid'>
<header class='vspace'>
    <a href='index.php'> <img src='img/customLogo.png'> </a> 
  <img src='img/headerDS.gif' align='right'height='171px' >

</header>
  <nav class='ink-navigation' id='nav_menu'>
<ul class='menu horizontal green rounded shadowed'>";
if($url == "index.php")
    echo "<li class='active'><a href='index.php'><b>Início</b></a></li>";
else
    echo "<li><a href='index.php'><b>Início</b></a></li>";

if ($url == "missaoevisao.php" || $url == "eixodeatuacao.php" || $url == "mensagem.php")    
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

<li class='active'>
		<li class='push-right'>
			<a href=''><b>Gestão</b></a> 
			<ul class='submenu'>
				<li>
					<a href='editarUtilizador.php'><b>Perfil</b></a>
				</li>
				<li>
					<a href='inserirNoticias.php'><b>Inserir Notícia</b></a>
				</li>
				<li>
					<a href='editarNoticias.php'><b>Editar Notícias</b></a>
				</li>
				<li>
					<a href='logout.php' onclick='return confirmarLogout()'> <b>Sair </b></a> 
				</li>
			</ul>
</li>
</li>

</ul>
</nav>

</div>



";
    
}

function menuAdmin(){
        $url = curPageURL();
   
    echo "<div class='ink-grid'>
<header class='vspace'>
    <a href='index.php'> <img src='img/customLogo.png'> </a> 
  <img src='img/headerDS.gif' align='right'height='171px' >

</header>
  <nav class='ink-navigation' id='nav_menu'>
<ul class='menu horizontal green rounded shadowed'>";
if($url == "index.php")
    echo "<li class='active'><a href='index.php'><b>Início</b></a></li>";
else
    echo "<li><a href='index.php'><b>Início</b></a></li>";

if ($url == "missaoevisao.php" || $url == "eixodeatuacao.php" || $url == "mensagem.php")    
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

 
echo "<li class='active'>
		<li class='push-right'>
				<a href=''><b>Gestão</b></a> 
				<ul class='submenu'>
					<li>
						<a href='editarUtilizador.php'><b>Perfil</b></a>
					</li>
					<li>
						<a href='inserirUtentes.php'><b>Inserir Utente</b></a>
					</li>
					<li>
						<a href='gerirUtentes.php'><b>Gerir Utentes</b></a>
					</li>
					<li>
						<a href='inserirUtilizador.php'><b>Inserir Utilizador</b></a>
					</li>
					<li>
						<a href='gerirUtilizadores.php'><b>Editar Utilizadores</b></a>
					</li>
					<li>
						<a href='inserirNoticias.php'><b>Inserir Notícia</b></a>
					</li>
					<li>
						<a href='editarNoticias.php'><b>Editar Notícias</b></a>
					</li>
					<li>
						<a href='mensagem.php'><b>Caixa de Entrada</b></a>
					</li>
					<li>
						<a href='logout.php' onclick='return confirmarLogout()'> <b>Sair </b></a> 
					</li>
				</ul>
</li>
</nav>
 </div>";
 }
 
 function menuGestorUtentes(){
        $url = curPageURL();
   
    echo "<div class='ink-grid'>
<header class='vspace'>
    <a href='index.php'> <img src='img/customLogo.png'> </a> 
  <img src='img/headerDS.gif' align='right' height='171px' >

</header>
  <nav class='ink-navigation' id='nav_menu'>
<ul class='menu horizontal green rounded shadowed'>";
if($url == "index.php")
    echo "<li class='active'><a href='index.php'><b>Início</b></a></li>";
else
    echo "<li><a href='index.php'><b>Início</b></a></li>";

if ($url == "missaoevisao.php" || $url == "eixodeatuacao.php" || $url == "mensagem.php")    
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

 
echo "<li class='active'>
		<li class='push-right'>
				<a href=''><b>Gestão</b></a> 
				<ul class='submenu'>
					<li>
						<a href='editarUtilizador.php'><b>Perfil</b></a>
					</li>
					<li>
						<a href='inserirUtentes.php'><b>Inserir Utente</b></a>
					</li>
					<li>
						<a href='gerirUtentes.php'><b>Gerir Utentes</b></a>
					</li>
					<li>
						<a href='mensagem.php'><b>Caixa de Entrada</b></a>
					</li>
					<li>
						<a href='logout.php' onclick='return confirmarLogout()'> <b>Sair </b></a> 
					</li>
				</ul>
</li>
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