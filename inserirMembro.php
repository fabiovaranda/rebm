<?php include('importarBibliotecas.php'); ?>
<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea'});
</script>
    <?php
    
    include('menu.php');

    function verificarLink($link){
        //verificar se tem http://
        //se n tiver, adicionar. Caso contrário retorna
        //$da = new DataAccess();
        //$da->getLink();
        
    }
    
    if ( isset ($_POST['nome'])){
        $nome = $_POST['nome'];
        $link = $_POST['link'];        
        include_once('DataAccess.php');
        $da = new DataAccess();
        $da->InserirMembro($nome, $link, $_FILES['file']['name']);  

        move_uploaded_file($_FILES['file']['tmp_name'], "membrosrede/". $_FILES['file']['name']);
        echo "<script>
        alert('Inserido com sucesso');
        window.location='index.php';
        </script>";
    }
    
    if (isset($_SESSION['id'])){    
        echo "
           <br>
          
        <div class='ink-grid'>
        <form class='ink-form' method='post' action='inserirMembro.php' enctype='multipart/form-data'>         
                <legend><h1> <font color='#1A9018'>Inserir Membro</font></h1></legend>
                <br>
                <input type='text' name='nome' placeholder='nome'/>
                <input type='text' name='link' placeholder='página web do membro'/>
                <input type='file' accept='image/*' class ='ink-button' name='file' placeholder='logotipo'/>
                <input type='submit' value='Inserir' class='ink-button green'/>                          
        </form>
        </div>
           <br>
           <br>";
    }
    include('footer.php');
        ?>

