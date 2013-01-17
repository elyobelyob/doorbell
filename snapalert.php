<?php
include 'settings.php';
sleep(5);
$prowlpriority;
$dir = '/media/external_hdd/images/'.date('Ymd').'/doorbell/';
$files = preg_grep('/^([^.])/', scandir($dir));

foreach ($files as $filelist) {
	if (filemtime($dir.$filelist) > time()-(5*60)) {
		$event =  'event at '.date("Y-m-d h:i:s",time());

		shell_exec("./findtouser.sh ".$prowlkey." 'Doorbell ' '$event' '' ".$prowlpriority." 'http://".$htaccesspwd."@".$url."/images/".date('Ymd')."/doorbell/".$filelist."' > /dev/null 2>/dev/null &");
		exit;
	}
}



