<?php include_once('importarBibliotecas.php'); ?>

<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea'});
</script>
    <?php
        function getTipo($x){
			//echo "<script>alert('$x')</script>";
            switch ($x){
                case "application/pdf": return "pdf"; break;
				case "application/vnd.ms-excel": return "xls"; break;
				case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet": return "xlsx"; break;
                 }
        }
        
        if ( isset ($_POST['nome'])){
            //inserir documento
            //echo "<script>alert('".$_FILES["file"]["type"]."')</script>";
            $tipo = getTipo($_FILES["file"]["type"]);
			//echo "<script>alert('$tipo')</script>";
            if ($tipo != "pdf" && $tipo != "xls" && $tipo != "xlsx"){
             echo "<script>
                alert('Tipo de documento inválido');
                window.location='inserirDocumentos.php';
                </script>";
            }else{
                $nome = $_POST['nome'];
                $pasta = $_POST['pasta'];

                include_once('DataAccess.php');
                $da = new DataAccess();
                $id = $da->inserirDocumento($nome, $_FILES['file']['name'], $pasta);  
                $nome = "Documentos/".$_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], $nome);
                echo "<script>
                    alert('Inserido com sucesso');
                    window.location='Documentos.php';
                </script>";
            }
        }

    
    include_once('menu.php');
    if (isset($_SESSION['id'])){    
        $resPastas = $da->getPastas();
        echo "
           <br>
        <div class='ink-grid'>
        <form class='ink-form' method='post' action='inserirDocumentos.php' enctype='multipart/form-data'>         
                <legend><h1><font color='#1A9018'>Inserir Documento</h1></font></legend>
                <br>
                <input type='text' name='nome' placeholder='nome' />
                <input type='file' class='ink-button' accept='application/pdf, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' name='file' placeholder='Documento'/>
                <select name='pasta'>
                    <option value='-1'></option>
                    ";
                    while($rowPastas = mysql_fetch_object($resPastas)){
                        echo "<option value='".$rowPastas->id."'>".$rowPastas->pastaReal."</option>";
                    }
                echo"
                </select>
                <input type='submit' class='ink-button green' value='inserir'>                       
        </form>
        </div>
           <br>
           <br>";
    }
    
    include_once('footer.php');
        ?>
