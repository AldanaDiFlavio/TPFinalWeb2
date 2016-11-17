<?php

include('phpqrcode/qrlib.php');
//include('phpqrcode/qrconfig.php');
// how to build raw content - QRCode with simple Business Card (VCard)
// here our data

function dameUrl(){
	$_SERVER['REQUEST_URI'] = "/espotifiBACKUP/html/miPlaylist.php?idPlaylist=". $_REQUEST["idPlaylist"];
	$url = "http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'];
	return $url;
}

$url = dameUrl();



// we building raw data
/*$codeContents = 'BEGIN:VCARD'."\n";
$codeContents .= 'FN:'.$name."\n";
$codeContents .= 'TEL;WORK;VOICE:'.$phone."\n";
$codeContents.= 'EMAIL:'.$email."\n";
$codeContents .= 'END:VCARD';
$codeContents .='IMAGE: '.$imagen."\n";*/

// generating
QRcode::png($url);
// displaying

echo '<img src="vcardqr.php"/>';
?>

