<?php

include('phpqrcode/qrlib.php');

function dameUrl(){
	$_SERVER['REQUEST_URI'] = "TPFinalWeb2/Espotifi-Final/html/miPlaylist.php?idPlaylist=". $_REQUEST["idPlaylist"];
	$url = "http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'];
	return $url;
}

$url = dameUrl();

QRcode::png($url);


echo '<img src="vcardqr.php"/>';
?>

