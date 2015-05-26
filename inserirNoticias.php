<?php
include('importarBibliotecas.php');
?>
<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
        tinymce.init({
            mode : "specific_textareas",
            editor_selector : "myTextEditor"
            });
</script>

<?php

include('menu.php');

function getTipo($x){
    switch ($x){
        case 'image/jpeg': return 'jpg'; break;
        case 'image/png': return 'png'; break;
        case 'image/bmp': return 'bmp'; break;
        case 'image/gif': return 'gif'; break;
    }
    
}
    if ( isset ($_POST['titulo'])){
        $tipo = getTipo($_FILES['file']['type']);        
        $titulo = $_POST['titulo'];
        $texto = $_POST['texto'];
        $textoApresentacao = $_POST['textoApresentacao'];
        $dataNoticia = $_POST['dataNoticia']; 
        $autor = $_POST['autor'];
		$poster = $_POST['poster'];
		if ($poster == 'on') $poster = 1; else $poster = 0;
        
        include_once('DataAccess.php');
        $da = new DataAccess();
        $id = $da->inserirNoticias($titulo, $texto, $textoApresentacao, $dataNoticia, $autor, $tipo, $poster);  
        $titulo = 'fotosNoticias/'.$id.'.'.$tipo;
        move_uploaded_file($_FILES['file']['tmp_name'], $titulo);
        echo "<script>
        alert('Inserido com sucesso');
        window.location='index.php';
        </script>";
    }
      if (isset($_SESSION['id'])){    
        echo "
        <div class='ink-grid'>
            <form class='ink-form' method='post' action='inserirNoticias.php' enctype='multipart/form-data'> 
            <fieldset>
                <legend><h4> <font color='#1A9018'> Inserir Notícia </font><h4></legend>
                <table width='100%' border='0'>
                    <tr>
                        <td width='50%'>
                                        <input type='text' style='width:90%' name='titulo' placeholder='titulo' required/>  
                        </td>
                        <td width='20%'>
                                     <input type='date' style='width:60%' name='dataNoticia' class='ink-datepicker'  requiredplaceholder='dd-mm-aaaa'/>   
                        </td>
                        <td width='30%'>
                                       <input type='text' style='width:90%' name='autor' placeholder='autor' required/>  
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3'>
                            Texto de Apresentação
                            <textarea  id='textoApresentacao' name='textoApresentacao' cols='153' rows='6' placeholder='Texto de Apresentacao'></textarea>
                         </td>
                    </tr>
                    <tr>
                        <td colspan='3'>
                            Texto 
                            <textarea  id='text-input' name='texto' class='myTextEditor' cols='153' rows='6' placeholder='Texto'></textarea>
                        </td>
                    </tr>
                    <tr>
						
                        <td width='50%'>
                             <input  required type='file' class='ink-button' accept='image/*' name='file' placeholder='imagem da notícia'/>
							 &nbsp; Poster <input type='checkbox' name='poster' /> 
                        </td>
                        <td width='30%'>
                           <input type='submit' class='ink-button green' value='Inserir' />                          
                        </td>
                        
                    </tr>
                </table>
            </fieldset>
            </form>
          </div>";
      }
      
     

        ?>
<?php include('footer.php');?>
        

