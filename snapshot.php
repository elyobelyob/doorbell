<?php
require_once('settings.php');

$url = 'http://'.$photourl.'/snapshot.cgi\?user='.$photouser.'\&pwd='.$photopwd;
$newDestinationRoot = $photopath.'/images/'.date('Ymd').'/';

if (!file_exists($newDestinationRoot)) { mkdir($newDestinationRoot); }

$newDestination = '/media/external_hdd/images/'.date('Ymd').'/doorbell/';

if (!file_exists($newDestination)) { mkdir($newDestination); }

for ($i=0; $i<9; $i++) {
	$timecreate = date('His');
	$cmd = "wget -q $url -O ".$newDestination.$timecreate.".jpg";
	exec($cmd);
	sleep(1);
}
