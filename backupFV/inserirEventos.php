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
        $descricao = $_POST['descricao'];
        $data = $_POST['data'];
        
        include_once('DataAccess.php');
        $da = new DataAccess();
        $id = $da->inserirEventos($nome, $descricao, $data, $tipo);  
        $nome = "fotosEventos/".$id.".".$tipo;
        move_uploaded_file($_FILES['file']['tmp_name'], $nome);
        echo "<script>
        alert('Inserido com sucesso');
        window.location='index.php';
        </script>";
    }

    include('importarBibliotecas.php');
    include('menu.php');
    if (isset($_SESSION['id'])){    
        echo "
           <br>
          
        <div class='ink-grid'>
        <form class='ink-form' method='post' action='inserirEventos.php' enctype='multipart/form-data'>         
                <legend><h1> <font color='#1A9018'>Inserir Eventos</font></h1></legend>
                <br>
                <input type='text' name='nome' placeholder='nome' />
                <input type='text' name='data' class='ink-datepicker' placeholder='data'/>
                <br><br>
                <textarea id='text-input' name='descricao' rows='10' placeholder='Insira a descrição'></textarea> 
                <br><br>
                <input type='file' class='ink-button' accept='image/*' name='file' placeholder='imagem'/>
                <input type='submit' class='ink-button green' value='Inserir'>                       
        </form>
        </div>
           <br>
           <br>";
    }
    include('footer.php');
        ?>

