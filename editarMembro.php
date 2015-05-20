<?php
		 include('importarBibliotecas.php');
		 ?>
<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea'});
</script>
        <?php
		
    
        include('menu.php');
        ?>
        <script>
    function confirmacaoEliminacao(i){
        if(confirm('Tem a certeza que deseja eliminar?')){
            window.location='RemoverMembro.php?i='+i;
        }
    }
    

</script>


<div class='ink-grid'>
<form class="ink-form "class="ink" method='post' action='editarMembro.php'>
                <br>
                <legend><h1><font color='#1A9018'>Pesquisar Membro</font></h1></legend>
                <br>
                <br>
                <input type='text' name='nomeP' placeholder='Insira aqui o membro'/>
                <input type='submit' class="ink-button green" value='Pesquisar'/>
                <br>
                <br>
        </form>
</div>
        <?php
        //caso o campo nomeP (nome no campo de pesquisa de membro esteja preenchido,
        //irá ser incluida a página editarMembro.php
            if (isset($_POST['nomeP'])){
            include_once('editarMembro.php');
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
    $res = $da->PesquisarMembro($nome);
    while($row = mysql_fetch_assoc($res)){      
        
        echo "
            <div class='ink-grid'>

            <form class='ink-form' method='post' action='editarMembro.php' enctype='multipart/form-data'>
                <fieldset>
                    <input type='hidden' name='idA' value ='".$row['id']."'/>
                    <input type='text' name='nomeA' value='".$row['nome']."' placeholder='Nome'/>
                    <input type='file' accept='image/*' name='file' placeholder='imagem' class='ink-button' required/>
                    <input type='text' name='linkA' value='".$row['link']."' placeholder='Link'/>
                    <input type='submit' class='ink-button green' value='Editar'/>
                   <!-- <a href='RemoverMembro.php?i=".$row['id']."' style='text-decoration:none'>
                        <input type='button' class='ink-button red' value='Eliminar'/>
                    </a>-->
                    <input type='button' class='ink-button red' onclick='confirmacaoEliminacao(".$row['id'].")' value='Eliminar'/>
            </form>
            </div>";
    }
    }

    if(isset($_POST['nomeA'])){
        //atualizar o membro
        $tipo = getTipo($_FILES['file']['type']); 
        $nome = $_POST['nomeA'];
        $id = $_POST['idA'];
        $logotipo = 'membrosrede/'.$id.'.'.$tipo;
        $logotipoBD = $id.'.'.$tipo;
        $link = $_POST['linkA'];        
        include_once('DataAccess.php');
        $da = new DataAccess();
        $da->EditarMembro($nome,$logotipoBD,$link, $id);       
        move_uploaded_file($_FILES['file']['tmp_name'], $logotipo);
        echo 
        "<script>alert('O membro foi atualizado com sucesso'); 
                    window.location='membrosrede.php';
                </script>";
    }


       include('footer.php');
        ?>
