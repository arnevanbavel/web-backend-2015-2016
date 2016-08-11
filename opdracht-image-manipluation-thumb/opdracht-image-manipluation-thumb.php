<?php

$root 	= 	dirname(__FILE__) . '/';
$isUploaded	=	false;
$filename = false;

if ( isset( $_POST[ 'submit' ] ) )
	{
        
        if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& ($_FILES["file"]["size"] < 5000000)) 
		{
		  
			if ($_FILES["file"]["error"] > 0) 
			{
				// Als er een fout in het bestand wordt gevonden (bv. corrupte file door onderbroken upload), moet er een foutboodschap getoond worden
				throw new Exception( "Return Code: " . $_FILES["file"]["error"] );
			} 
			else 
			{
                
                switch( $_FILES["file"]["type"] )
                {
                    case 'image/jpeg':
                        $extension = 'jpeg';
                        break;
    
                    case 'image/png':
                        $extension = 'png';
                        break;
    
                    case 'image/gif':
                        $extension = 'gif';
                        break;
    
                    default:
                        $extension = $_FILES["file"]["type"];
                }
                
                $path = 'img/';
                # Create filename
                if ( $filename	==	false ){ $newFilename =	uniqid();}
                else { $newFilename	=	$filename; }
    
                # Check if file exists
                $newFilePath	= $root . $path . $newFilename . '-' . $filename . '.' . $extension;
    
                if ( !file_exists( $newFilePath ) )
                {
                    move_uploaded_file( $_FILES["file"]["tmp_name"], $newFilePath );
                    $uploadgelukt	=	true;
                }
                
                if ( $uploadgelukt )
                {
                    //$hasThumbnail	=	$image->createThumbnail( 100, 100 )
                    
                    $isThumbnail =	false;
                    $imageSize = getimagesize( $newFilePath );
        
                    $originalWidth 	= 	$imageSize[ '0' ];
                    $originalHeight = 	$imageSize[ '1' ];
        
                    # Create empty canvas
                    $canvas = imagecreatetruecolor( 100, 100 );
        
                    # Recreate original                    
                    switch ( $_FILES["file"]["type"] )
                    {
                        case ('image/jpeg'):
                            $original 	= 	imagecreatefromjpeg( $newFilePath );
                            break;
                            
                        case ('image/png'):
                            $original 	=	imagecreatefrompng( $newFilePath );
                            break;
        
                        case ('image/gif'):
                            $original 	=	imagecreatefromgif( $newFilePath );
                            break;
                    }
        
                    # Crop original to biggest possible square
                    $beginXCoordinaat	=	0;
                    $beginYCoordinaat	=	0;
        
                    # Standaard: hoogte groter dan breedte
                    $breedsteZijde	=	$originalHeight;
                    $kortsteZijde	=	$originalWidth;
        
                    if ( $originalWidth >= $originalHeight )
                    {
                        $breedsteZijde		=	$originalWidth;
                        $kortsteZijde		=	$originalHeight;
                        $beginXCoordinaat	=	( $originalWidth - $originalHeight ) / 2;
                    }
                    else # Wanneer hoogte groter is dan breedte
                    {
                        $beginYCoordinaat	=	( $originalHeight - $originalWidth ) / 2;
                    }			
        
                    # Resize original
                    # Passed by reference to $canvas
                    imagecopyresized( $canvas, $original, 0, 0, $beginXCoordinaat, $beginYCoordinaat, 100, 100, $kortsteZijde, $kortsteZijde );
        
                    # Save new image
                    $thumbnailFilename	=	'thumbnail-' . $newFilename . '-' . $filename . '.' . $extension;
                    $thumbnailPath		=	$root . $path . 'thumbnails/' . $thumbnailFilename;
                    
                    #save
                    
                    switch ( $_FILES["file"]["type"] )
                    {
                        case ('image/jpeg'):
                            $resized 	= 	imagejpeg( $canvas, $thumbnailPath, 100);
                            break;
                            
                        case ('image/png'):
                            $resized 	=	imagepng( $canvas, $thumbnailPath );
                            break;
        
                        case ('image/gif'):
                            $resized 	=	imagegif( $canvas, $thumbnailPath );
                            break;
                    }                 
    
                    if ( $resized  )
                    {
                        $data['src']	=	$thumbnailFilename;
                    }
                }
            }
        }
	}

?>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Opdracht manipulation thumb</title>
    <link rel="stylesheet" href="http://web-backend.local/css/global.css">
    <link rel="stylesheet" href="http://web-backend.local/css/facade.css">
    <link rel="stylesheet" href="http://web-backend.local/css/directory.css">
</head>

<body class="web-backend-voorbeeld">

	<section class="body">

		<h1>Opdracht manipulation thumb</h1>

        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
		<ul>
            <li>
            <label for="imafilege">image</label>
            <input type="file" name="file" id="file">
            </li>
            <li>
		      <input type="submit" name="submit" value="Verzenden">
            </li>
		</ul>
	</form>
	</section>

</body>
</html>