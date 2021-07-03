<?php
    session_start();
    $RandomStr = md5(microtime());
    $ResultStr = substr($RandomStr,0,5);
    $NewImage =imagecreatefromjpeg("bgimage.jpg");

    $LineColor = imagecolorallocate($NewImage,233,239,239);
    $TextColor = imagecolorallocate($NewImage, 255, 255, 255);
    imageline($NewImage,1,1,40,40,$LineColor);
    imageline($NewImage,1,100,60,0,$LineColor);

    $font = imageloadfont("font.gdf");
    imagestring ($NewImage, $font, 5, 5, $ResultStr, $TextColor ); 
    $_SESSION['originalkey'] = $ResultStr;  //store the original coderesult in session variable

    header("Content-type: image/jpeg");
    imagejpeg($NewImage);
?>