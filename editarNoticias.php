<?php
include('importarBibliotecas.php');
include('menu.php');
?>
<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
        tinymce.init({
			//selector:'textarea'
            mode : "specific_textareas",
            editor_selector : "myTextEditor"
			});
</script>

<script>
    function confirmacaoEliminacao(i){
        if(confirm('Tem a certeza que deseja eliminar esta Notícia?')){
            window.location='RemoverNoticias.php?i='+i;
        }
    }
	
    function contaCaracteres(x){
		//alert(tinyMCE.get('textoApresentacao'+x[1].value).getContent().length);
		if (tinyMCE.get('textoApresentacao'+x[1].value).getContent().length > 450){
			alert('Excedeu o n.º limite de caracteres para o texto de apresentação');
			return false;
			}
		else
			return true;
	}
		
	function mostrarTodasNoticias(){
		var conta = document.getElementById('noticiasVisiveis').value;
		var nomeDiv = 'divNot'+conta;
		var repeat = 0;
		while(repeat <5){
			conta++;
			nomeDiv = 'divNot'+conta;
			if(document.getElementById(nomeDiv) != null){
				document.getElementById(nomeDiv).style.display='block';
			}else{	
				document.getElementById('btVerMaisNoticias').style.display='none';
				break;
				
			}
			repeat++;
		}
		document.getElementById('noticiasVisiveis').value =conta; 
		
	}
</script>


<div class='ink-grid'>
<form class="ink-form "class="ink" method='post' action='editarNoticias.php'>
	<br>
	<br>
	<legend><h1><font color='#1A9018'>Pesquisar Notícia</font></h1></legend>
	<br>
	<input type='text' name='nomeP' placeholder='Insira aqui a notícia'/>
	<input type='submit' class="ink-button green" value='Pesquisar'/>
	<br>
	<br>
</form>
</div>

<?php
//caso o campo nomeP (nome no campo de pesquisa de notícia esteja preenchido,
//irá ser incluida a página editarNoticias.php
if (isset($_POST['nomeP'])){
    include_once('editarNoticias.php');
}
            
function getTipo($x){
    switch ($x){
        case 'image/jpeg': return 'jpg'; break;
        case 'image/png': return 'png'; break;
        case 'image/bmp': return 'bmp'; break;
        case 'image/gif': return 'gif'; break;
    }
    
}

if(isset($_POST['nomeP'])){
    //mostra formulário para atualizar
    $nome = $_POST['nomeP'];
    include_once('DataAccess.php');
    $da = new DataAccess();
    $res = $da->pesquisarNoticias($nome);
	$conta = 0;
    while($row = mysql_fetch_assoc($res)){      
		$conta++;
		if ($conta<6)
			echo "<div class='ink-grid' id='divNot".$conta."'>";
		else
			echo "<div class='ink-grid' id='divNot".$conta."' style='display:none'>";
		
		echo "
            <form class='ink-form' method='post' action='editarNoticias.php' enctype='multipart/form-data' onsubmit='return contaCaracteres(this)' >
                <fieldset>
                    <legend><h4> <font color='black' >Editar Notícia</font></h4></legend>
                    <table width='100%' border='0'>
                    <tr>
                        <td width='50%'>
                            <input type='hidden' name='idA' value ='".$row['id']."'/>
                            <input type='text' style='width:70%' name='tituloA' value='".$row['titulo']."' placeholder='Título' />
                        </td>
                        <td width='20%'>
                           <input type='text' style='width:90%' name='dataNoticiaA' class='ink-datepicker' value='".$row['dataNoticia']."' placeholder='aaaa-mm-dd'/> 
                        </td>
                        <td width='30%'>
                            <input type='text' style='width:90%' name='autorA' value='".$row['autor']."' placeholder='Autor'/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3'>
                            <br/>
                            Texto de Apresentação 
							
                            <textarea id='textoApresentacao".$row['id']."' name='textoApresentacao' cols='153' rows='2' placeholder='Texto de Apresentacao'>".$row['textoApresentacao']."</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3'>
                            <br/>
                            Texto
                            <textarea  id='text-input".$row['id']."' name='textoA' class='myTextEditor' cols='153' rows='6' placeholder='Texto'>".$row['texto']."</textarea>
                            <br/><br/>
                        </td>
                    </tr>
                    <tr>
                        <td width='50%'>
                            <input type='file' accept='image/*' name='file' placeholder='imagem' class='ink-button'/>
							";
							if ($row['poster'] == 1)
								echo "&nbsp; Poster <input type='checkbox' name='poster' checked/> ";
							else
								echo "&nbsp; Poster <input type='checkbox' name='poster' /> ";
							echo "
                        </td>
                        <td width='30%'>
                            <input type='submit' class='ink-button green' value='Atualizar' />                 
                        </td>
                        <td width='20%'>
                            <input type='button' class='ink-button red' onclick='confirmacaoEliminacao(".$row['id'].")' value='Eliminar'/>
                        </td>
                    </tr>
                    </table>
                </fieldset>
            </form>
            </div>";
    }

	echo "
		<div class='ink-grid'>
			<input type='hidden' id='contaNoticias' value='$conta'/>
			<input type='hidden' id='noticiasVisiveis' value='5'/>";
	  echo "<center><input id='btVerMaisNoticias' type='button' class='ink-button green' onclick='mostrarTodasNoticias()' value='Ver mais notícias'/></center>";
	echo "</div>";
}

if(isset($_POST['tituloA'])){
    if ($_FILES['file']['name'] != ""){
        $tipo = getTipo($_FILES['file']['type']); 
        $titulo = $_POST['tituloA'];
        $texto = $_POST['textoA'];
        $textoApresentacao = $_POST['textoApresentacao'];
        $dataNoticia = $_POST['dataNoticiaA'];
        $autor = $_POST['autorA'];    
		$poster = $_POST['poster'];
		if ($poster == 'on') $poster = 1; else $poster = 0;
        $id = $_POST['idA'];
        $imagem = $id.'.'.$tipo;

        include_once('DataAccess.php');
        $da = new DataAccess();
        $da->editarNoticias($titulo, $texto, $textoApresentacao, $dataNoticia, $autor, $id, $imagem, $tipo, $poster);
        $imagem = 'fotosNoticias/'.$id.'.'.$tipo;
        move_uploaded_file($_FILES['file']['tmp_name'], $imagem);
    }else{
        $tipo = "";
        $titulo = $_POST['tituloA'];
        $texto = $_POST['textoA'];
        $textoApresentacao = $_POST['textoApresentacao'];
        $dataNoticia = $_POST['dataNoticiaA'];
        $autor = $_POST['autorA']; 
		$poster = $_POST['poster'];
		if ($poster == 'on') $poster = 1; else $poster = 0;		
        $id = $_POST['idA'];
        $imagem = "";

        include_once('DataAccess.php');
        $da = new DataAccess();
        $da->editarNoticias($titulo, $texto, $textoApresentacao, $dataNoticia, $autor, $id, $imagem, $tipo, $poster);        
    }
    echo 
        "<script>alert('Notícia atualizada com sucesso'); 
                window.location='index.php';
            </script>";
    
}
include('footer.php');
?>
