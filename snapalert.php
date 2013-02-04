<?php
include 'settings.php';

$newDestinationRoot = $photopath.'/images/'.date('Ymd').'/';
if (!file_exists($newDestinationRoot)) { mkdir($newDestinationRoot); }

$newDestination = $photopath.'/images/'.date('Ymd').'/doorbell/';
if (!file_exists($newDestination)) { mkdir($newDestination); }

$files = preg_grep('/^([^.])/', scandir($newDestination));

foreach ($files as $filelist) {
	if (filemtime($newDestination.$filelist) > time()-(5*60)) {
		$event =  'event at '.date("Y-m-d H:i:s",time());

		shell_exec("./findtouser.sh ".$prowlkey." 'Doorbell ' '$event' '' ".$prowlpriority." 'http://".$htaccesspwd."@".$url."/images/".date('Ymd')."/doorbell/".$filelist."' > /dev/null 2>/dev/null &");
		exit;
	}
}



