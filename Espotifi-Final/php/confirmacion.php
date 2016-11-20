<?php
include "../clases/database.php";

//$valor = $_GET("valor");
$nombreId = $_GET["nombreId"];

$db = new database();
$db->conectar();
$db->habilita($nombreId);

header("location: ../html/index.php");



?>