<div data-role="page" data-add-back-btn="true" id="Gallery1" class="gallery-page">

	<?php 
		if ((date('Ymd', strtotime($_GET['mydate']))) == "19700101") { 
			$pushdate = "Today"; 
		} else { 
			$pushdate = date('Ymd', strtotime($_GET['mydate']));
		}
	?>

	<div data-role="header">
		<h1>Home Security Doorbell <?php echo $pushdate; ?></h1>
	</div>

	<div data-role="content">
		<ul class="gallery">

<?php
//error_reporting(0);
set_time_limit(0);
date_default_timezone_set('Europe/London');

require_once('settings.php');

$basedir = $photopath;

if (!empty($_GET['mydate'])) {
	$reqdate = date('Ymd', strtotime($_GET['mydate']));
} else {
	$reqdate = date('Ymd');
}

if (isset($_GET['slider'])) {
	$lim = ($_GET['slider']/100);
}

if (isset($_GET['time_slider_min'])) {
	$timerlow = $_GET['time_slider_min'];	
	$timerhigh = $_GET['time_slider_max'];	
}

$localdir = "/images/".$reqdate."/doorbell/";
$urldir = "http://".$url."/images/".$reqdate."/doorbell/";
$urlthumbdir = "http://".$url."/images/".$reqdate."/doorbell/";

// Identify directories
$source = $basedir.$localdir;
$i = 0;

// Get array of all source files
if (is_dir($source)) {
	$files = scandir($source,1);
}

if (isset($files)) {
	// Cycle through all source files
	foreach ($files as $file) {


		if (in_array($file, array(".","..","thumbs"))) { continue; }

		if ((substr($file, 0, 2) < $timerlow)) { continue; }

 		if ((substr($file, 0, 2) > $timerhigh)) { continue; }

		$d = 999;

		if($d >= $lim) {
			$i++;
			$output = '<li><a href="'.$urldir.$file.'" rel="external">';
			$output .= '<img src="'.$urldir.$file.'" alt="'.$file.'"  /></a></li>';

			//$lastfile = $file;
			echo $output;
			flush();
		}

	}
}

if ($i == 0) {
	// Default when no pictures
	$output = '<li><a href="'.$urldir.'../../../default.jpg" rel="external"><img src="'.$urlthumbdir.'../../../../defaultthumb.jpg" alt="Default Image"  /></a></li>';
	echo $output;
	flush();
}

?>
		</ul>
	</div>

	<div data-role="footer">
		<h4>elyob</h4>
	</div>

</div>

