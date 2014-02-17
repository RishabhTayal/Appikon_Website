<?

//setup db connection
$link = mysqli_connect("photos.db.11208285.hostedresource.com","photos","AppikonSoft!23");
mysqli_select_db($link, "photos");

//executes a given sql query with the params and returns an array as result
function query() {
	global $link;
	$debug = false;
	
	//get the sql query
	$args = func_get_args();
	$sql = array_shift($args);

	//secure the input
	for ($i=0;$i<count($args);$i++) {
		$args[$i] = urldecode($args[$i]);
		$args[$i] = mysqli_real_escape_string($link, $args[$i]);
	}
	
	//build the final query
	$sql = vsprintf($sql, $args);
	
	if ($debug) print $sql;
	
	//execute and fetch the results
	$result = mysqli_query($link, $sql);
	if (mysqli_errno($link)==0 && $result) {
		
		$rows = array();

		if ($result!==true)
		while ($d = mysqli_fetch_assoc($result)) {
			array_push($rows,$d);
		}
		
		//return json
		return array('result'=>$rows);
		
	} else {
	
		//error
		return array('error'=>'Database error');
	}
}

//ORIGNAL FUNCTION NOW REPLACED BY THE NEW FUNCTION BELOW
// loads up the source image, resizes it and saves with -thumb in the file name
//function thumb($srcFile, $sideInPx) {
// 
//   $image = imagecreatefromjpeg($srcFile);
//   $width = imagesx($image);
//   $height = imagesy($image);
//   
//   $thumb = imagecreatetruecolor($sideInPx, $sideInPx);
//   
//   imagecopyresized($thumb,$image,0,0,0,0,$sideInPx,$sideInPx,$width,$height);
//   
//   imagejpeg($thumb, str_replace(".jpg","-thumb.jpg",$srcFile), 85);
//   
//   imagedestroy($thumb);
//   imagedestroy($image);
// }

function thumb($srcFile, $sideInPx) {
	$image = imagecreatefromjpeg($srcFile);
	$width = imagesx($image);
	$height = imagesy($image);
	$percentage = ($width >= $height) ? 100 / $width * $sideInPx : 100/ $height * $sideInPx;
	
	$newWidth = $width / 100 * $percentage;
	$newHeight = $height / 100 * $percentage;
	
	$thumb = imagecreatetruecolor($newWidth, $newHeight);
	imagecopyresized($thumb, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
		
	$exif = exif_read_data($srcFile);
	
	$ort = $exif['Orientation'];
	switch($ort)
	{
		case 6: //90 rotate right
			$thumb = imagerotate($thumb, -90, -1);
			break;
		case 8: //90 rotate left
			$thumb = imagerotate($thumb, 90, -1);
			break;
	}
		
	imagejpeg($thumb, str_replace(".jpg", "-thumb.jpg", $srcFile), 100);
	
	imagedestroy($thumb);
	imagedestroy($image);
}

//New Trial function.
function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth )
{
    // open the directory
    $dir = opendir( $pathToImages );
    
    // loop through it, looking for any/all JPG files:
    while (false !== ($fname = readdir( $dir ))) {
        // parse path for the extension
        $info = pathinfo($pathToImages . $fname);
        // continue only if this is a JPEG image
        if ( strtolower($info['extension']) == 'jpg' )
        {
            echo "Creating thumbnail for {$fname} <br />";
            
            // load image and get image size
            $img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
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
            imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
        }
    }
    // close the directory
    closedir( $dir );
}

?>