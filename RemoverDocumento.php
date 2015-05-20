
<?php

$id = $_GET['i'];
include_once('DataAccess.php');
$da = new DataAccess();
$da->RemoverDocumento($id);
echo "<script>
    alert('Eliminado com sucesso');
    window.location='Documentos.php';
</script>";
?>

