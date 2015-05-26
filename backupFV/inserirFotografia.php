<?php include_once('importarBibliotecas.php');?>
<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea'});
</script>
    <?php
function getTipo($x){
    switch ($x){
        case "image/jpeg": return "jpg"; break;
        case "image/png": return "png"; break;
        case "image/bmp": return "bmp"; break;
        case "image/gif": return "gif"; break;
    }
}
    if ( isset ($_POST['nome'])){
        $tipo = getTipo($_FILES['file']['type']);        
        $nome = $_POST['nome'];
        
        include_once('DataAccess.php');
        $da = new DataAccess();
        $id = $da->inserirFotografia($nome, $tipo);  
        $nome = "img/".$nome.".".$tipo;
        move_uploaded_file($_FILES['file']['tmp_name'], $nome);
        echo "<script>
        alert('Inserido com sucesso');
        window.location='index.php';
        </script>";
    }

    
    include_once('menu.php');
    if (isset($_SESSION['id'])){    
        echo "
           <br>
        <div class='ink-grid'>
        <form class='ink-form' method='post' action='inserirFotografia.php' enctype='multipart/form-data'>         
                <legend><h1><font color='#1A9018'>Inserir Fotografia</h1></font></legend>
                <br>
                <input type='text' name='nome' placeholder='nome' required/>
                <input type='file' class='ink-button' accept='image/*' required name='file' placeholder='imagem'/>
                <input type='submit' class='ink-button green' value='inserir'>                       
        </form>
        </div>
           <br>
           <br>";
    }
    include_once('footer.php');
        ?>
