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
            window.location='RemoverDocumento.php?i='+i;
        }
    }
    

</script>


<div class='ink-grid'>
<form class="ink-form "class="ink" method='post' action='EditarDocumento.php'>
                <br>
                <legend><h1><font color='#1A9018'>Pesquisar Documento</font></h1></legend>
                <br>
                <br>
                <input type='text' name='nomeP' placeholder='Insira aqui o Documento'/>
                <input type='submit' class="ink-button green" value='Pesquisar'/>
                <br>
                <br>
        </form>
</div>
        <?php
        //caso o campo nomeP (nome no campo de pesquisa de membro esteja preenchido,
        //irá ser incluida a página editarMembro.php
            if (isset($_POST['nomeP'])){
            include_once('EditarDocumento.php');
            }
            
       

    if(isset($_POST['nomeP'])){
        //mostra formulário para atualizar
        $nome = $_POST['nomeP'];
        include_once('DataAccess.php');
        $da = new DataAccess();
        $res = $da->pesquisarDocumento($nome);
        while($row = mysql_fetch_assoc($res)){      
            $resPastas = $da->getPastas();
            echo "
                <div class='ink-grid'>

                <form class='ink-form' method='post' action='EditarDocumento.php' enctype='multipart/form-data'>
                    <fieldset>
                        <input type='hidden' name='idA' value ='".$row['id']."'/>
                        <input type='text' name='nomeA' value='".$row['nome']."' placeholder='Nome'/>
                        <input type='file' class='ink-button' accept='application/pdf, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' name='FILE' placeholder='Documento'/>
                     <select name='pasta'>
                        <option value='-1'></option>
                            ";
                            while($rowPastas = mysql_fetch_object($resPastas)){
                                if ($row['idPasta'] === $rowPastas->id)
                                    echo "<option value='".$rowPastas->id."' selected>".$rowPastas->pastaReal."</option>";
                                else
                                    echo "<option value='".$rowPastas->id."'>".$rowPastas->pastaReal."</option>";
                            }
                        echo"
                        </select>
                        <input type='submit' class='ink-button green' value='Editar'/>
                       <!-- <a href='RemoverDocumento.php?i=".$row['id']."' style='text-decoration:none'>
                            <input type='button' class='ink-button red' value='Eliminar'/>
                        </a>-->
                        <input type='button' class='ink-button red' onclick='confirmacaoEliminacao(".$row['id'].")' value='Eliminar'/>
                </form>
                </div>";
        }
    }
    
    function getTipo($x){
        switch ($x){
            case "application/pdf": return "pdf"; break;
			case "application/vnd.ms-excel": return "xls"; break;
			case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet": return "xlsx"; break;
             }
    }
    
    if(isset($_POST['nomeA'])){
        //atualizar o documento
        
        $tipo = getTipo($_FILES["FILE"]["type"]);
        if ($tipo != "pdf" && $tipo != "xls" && $tipo != "xlsx"){
             echo "<script>alert('Tipo de ficheiro inválido'); 
                        window.location='EditarDocumento.php';
                    </script>";
        }else{
            $nome = $_POST['nomeA'];
            $documento = $_FILES["FILE"]["name"];
            $id = $_POST['idA'];
            $pasta = $_POST['pasta'];
            include_once('DataAccess.php');
            $da = new DataAccess();
            $da->atualizarDocumento($nome, $documento, $id, $pasta);
            $nome = "Documentos/".$_FILES['FILE']['name'];
            move_uploaded_file($_FILES['FILE']['tmp_name'], $nome);

            echo "<script>alert('Editado com sucesso'); 
                        window.location='Documentos.php';
                    </script>";
        }
    
   }


       include('footer.php');
        ?>
