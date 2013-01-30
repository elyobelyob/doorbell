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

// At this point we will create any missing thumbs
function createThumbs( $pathToImages, $pathToThumbs, $imageName, $thumbWidth )
{
        // parse path for the extension
        $info = pathinfo($pathToImages . $imageName);
        // continue only if this is a JPEG image
        if ( strtolower($info['extension']) == 'jpg' )
        {
                // load image and get image size
                $img = imagecreatefromjpeg( "{$pathToImages}{$imageName}" );
                $width = imagesx( $img );
                $height = imagesy( $img );

                // calculate thumbnail size
                $new_width = $thumbWidth;
                $new_height = floor( $height * ( $thumbWidth / $width ) );

                // create a new temporary image
                $tmp_img = imagecreatetruecolor( $new_width, $new_height );

                // copy and resize old image into new image
                imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

                // save thumbnail into a file
                imagejpeg( $tmp_img, $pathToThumbs.$imageName );
                //unlink($img);
        }
}

date_default_timezone_set('Europe/London');

require_once('settings.php');

$basedir = '/media/external_hdd';

if (!empty($_GET['mydate'])) {
	$reqdate = date('Ymd', strtotime($_GET['mydate']));
} else {
	$reqdate = date('Ymd');
}

$localdir = $basedir."/images/".$reqdate."/doorbell/";
$destinationThumbs = 'images/'.$reqdate.'/thumbs/';
$urldir = "http://".$url."/images/".$reqdate."/doorbell/";
$urlthumbdir = "http://".$url."/images/".$reqdate."/thumbs/";
$i = 0;

// Identify directories
$source = $basedir.$localdir;

// Get array of all source files
if (is_dir($localdir)) {
	$files = scandir($localdir,1);
}

// Create Thumbs folder
if (!file_exists($destinationThumbs)) {
    mkdir($destinationThumbs, 0777);
}

// parse each file
foreach ($files as $file) {

    // make sure it's not a base 'file'
	if (in_array($file, array(".","..","thumbs"))) { continue; }

	// if already exists in thumbs, ignore
	if (file_exists($destinationThumbs.$file)) { continue; }

    // Create Thumb	
	createThumbs($localdir,$destinationThumbs,$file,300);

}

// From here we generate Ajax output file

// Setup slider from front page
if (isset($_GET['slider'])) {
	$lim = ($_GET['slider']/100);
}

if (isset($_GET['time_slider_min'])) {
	$timerlow = $_GET['time_slider_min'];	
	$timerhigh = $_GET['time_slider_max'];	
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
			$output .= '<img src="'.$urlthumbdir.$file.'" alt="'.$file.'"  /></a></li>';

			//$lastfile = $file;
			echo $output;
			flush();
		}

	}
}

if ($i == 0) {
	// Default when no pictures
	$output = '<li><a href="http://'.$url.'/defaultthumb.jpg" rel="external"><img src="http://'.$url.'/defaultthumb.jpg" alt="Default Image"  /></a></li>';
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

