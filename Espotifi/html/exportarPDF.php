<?php
session_start();
?>
<?php

//require_once 'lib/pdf/dompdf_config.inc.php';
use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;
require_once '../dompdf/autoload.inc.php';


$html='
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Denuncias de usuarios</title>
</head>
<body>
<h1>Estadisticas</h1>
'.$_SESSION['anio'].'
'.$_SESSION['usuariosPorPais'].'
'.$_SESSION['graficoUsuariosBaneados'].'
'.$_SESSION['graficoRankingReproduccionesPlaylist'].'
'.$_SESSION['graficoRankingVotosPlaylist'].'
</body>
</html>';


$pdf = new DOMPDF();

# Definimos el tamaño y orientación del papel que queremos.
$pdf ->set_paper("A4", "portrait");

# Cargamos el contenido HTML.
$pdf ->load_html(utf8_decode($html));

# Renderizamos el documento PDF.
$pdf ->render();

# Enviamos el fichero PDF al navegador.
$pdf ->stream('Estadisticas');
?>