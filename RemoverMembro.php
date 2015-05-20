
<?php

$id = $_GET['i'];
include_once('DataAccess.php');
$da = new DataAccess();
$da->RemoverMembro($id);
echo "<script>
    alert('Eliminado com sucesso');
    window.location='index.php';
</script>";
?>

