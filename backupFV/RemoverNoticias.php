

<?php

$id = $_GET['i'];
include_once('DataAccess.php');
$da = new DataAccess();
$da->eliminarNoticias($id);
echo "<script>
    alert('Eliminado com sucesso');
    window.location='editarNoticias.php';
</script>";
?>

