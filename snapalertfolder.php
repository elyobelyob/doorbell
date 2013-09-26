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

		require dirname(__FILE__).'/scripts/php-notifyMyAndroid/nmaApi.class.php';

		$nma = new nmaApi(array('apikey' => 'a040189cdfc9422b0c650fd7e135731569e85f25fcdfc828'));
		//$message = "http://".$htaccesspwd."@".$url."/images/".date("Ymd")."/doorbell/".$filelist;

		$message = "http://".$url."/doorbell.php";


		if($nma->verify()){
		    if($nma->notify('Doorbell', $event, $message, $prowlpriority)){
		        echo "Notifcation sent!";
		    }
		}
		exit;
	}
}



