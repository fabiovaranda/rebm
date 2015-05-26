<?php

session_start();

session_name('empregabilidadebm');
session_destroy();

echo "<script>window.location='index.php'</script>";
?>
