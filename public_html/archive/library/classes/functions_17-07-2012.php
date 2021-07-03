<?php

function StringToUrl($name) {

	/* Remove some weird charactors that windows dont like. */
	$name = strtolower(trim($name));
	$name = str_replace(' ' , '_' , $name);
	$name = str_replace('__' , '_' , $name);
	$name = str_replace(' ' , '_' , $name);
	$name = str_replace("é", "e", $name);
	$name = str_replace("è", "e", $name);
	$name = str_replace("`", "", $name);
	$name = str_replace("/", "_", $name);
	$name = str_replace("\\", "_", $name);
	$name = str_replace("'", "", $name);
	$name = str_replace("(", "", $name);
	$name = str_replace(")", "", $name);
	$name = str_replace("-", "_", $name);
	$name = str_replace(".", "_", $name);
	$name = str_replace("ë", "e", $name);	
	$name = str_replace("â€“", "ae", $name);	
	$name = str_replace("â", "a", $name);	
	$name = str_replace("€", "e", $name);	
	$name = str_replace("“", "", $name);	
	$name = str_replace("#", "", $name);	
	$name = str_replace("$", "", $name);	
	$name = str_replace("@", "", $name);	
	$name = str_replace("!", "", $name);	
	$name = str_replace("&", "", $name);	
	$name = str_replace(';' , '_' , $name);		
	$name = str_replace(':' , '_' , $name);		
	$name = str_replace('[' , '_' , $name);		
	$name = str_replace(']' , '_' , $name);		
	$name = str_replace('|' , '_' , $name);		
	$name = str_replace('\\' , '_' , $name);		
	$name = str_replace('%' , '_' , $name);	
	$name = str_replace(';' , '' , $name);		
	$name = str_replace(' ' , '_' , $name);
	$name = str_replace('__' , '_' , $name);
	$name = str_replace(' ' , '' , $name);	
	
	return $name;			
}

function StringToUrl_Areas($name) {

	/* Remove some weird charactors that windows dont like. */
	$name = strtolower(trim($name));
	$name = str_replace(' ' , '' , $name);
	$name = str_replace('__' , '' , $name);
	$name = str_replace(' ' , '' , $name);
	$name = str_replace("é", "e", $name);
	$name = str_replace("è", "e", $name);
	$name = str_replace("`", "", $name);
	$name = str_replace("/", "", $name);
	$name = str_replace("\\", "", $name);
	$name = str_replace("'", "", $name);
	$name = str_replace("(", "", $name);
	$name = str_replace(")", "", $name);
	$name = str_replace("-", "", $name);
	$name = str_replace(".", "", $name);
	$name = str_replace("ë", "e", $name);	

	return $name;			
}

/* Function to generate code for account activation for jobSeekers. */
function GenerateMD5Code($email) {
	return md5($email);			
}

/* Convert word or text to simple text. */
function parseWord($userDoc) {
	$fileHandle = fopen($userDoc, "r");
	$line = @fread($fileHandle, filesize($userDoc));   
	$lines = explode(chr(0x0D),$line);
	$outtext = "";
	foreach($lines as $thisline)
	  {
		$pos = strpos($thisline, chr(0x00));
		if (($pos !== FALSE)||(strlen($thisline)==0))
		  {
		  } else {
			$outtext .= $thisline." ";
		  }
	  }
	 $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
	return $outtext;
} 



/*****************************************************************
This approach uses detection of NUL (chr(00)) and end line (chr(13))
to decide where the text is:
- divide the file contents up by chr(13)
- reject any slices containing a NUL
- stitch the rest together again
- clean up with a regular expression
*****************************************************************/

function parseWord2($userDoc) 
{
    $fileHandle = fopen($userDoc, "r");
    $word_text = @fread($fileHandle, filesize($userDoc));
    $line = "";
    $tam = filesize($userDoc);
    $nulos = 0;
    $caracteres = 0;
    for($i=1536; $i<$tam; $i++)
    {
        $line .= $word_text[$i];

        if( $word_text[$i] == 0)
        {
            $nulos++;
        }
        else
        {
            $nulos=0;
            $caracteres++;
        }

        if( $nulos>1996)
        {   
            break;  
        }
    }

    //echo $caracteres;

    $lines = explode(chr(0x0D),$line);
    //$outtext = "<pre>";

    $outtext = "";
    foreach($lines as $thisline)
    {
        $tam = strlen($thisline);
        if( !$tam )
        {
            continue;
        }

        $new_line = ""; 
        for($i=0; $i<$tam; $i++)
        {
            $onechar = $thisline[$i];
            if( $onechar > chr(240) )
            {
                continue;
            }

            if( $onechar >= chr(0x20) )
            {
                $caracteres++;
                $new_line .= $onechar;
            }

            if( $onechar == chr(0x14) )
            {
                $new_line .= "</a>";
            }

            if( $onechar == chr(0x07) )
            {
                $new_line .= "\t";
                if( isset($thisline[$i+1]) )
                {
                    if( $thisline[$i+1] == chr(0x07) )
                    {
                        $new_line .= "\n";
                    }
                }
            }
        }
        //troca por hiperlink
        $new_line = str_replace("HYPERLINK" ,"<a href=",$new_line); 
        $new_line = str_replace("\o" ,">",$new_line); 
        $new_line .= "\n";

        //link de imagens
        $new_line = str_replace("INCLUDEPICTURE" ,"<br><img src=",$new_line); 
        $new_line = str_replace("\*" ,"><br>",$new_line); 
        $new_line = str_replace("MERGEFORMATINET" ,"",$new_line); 


        $outtext .= nl2br($new_line);
    }

 return $outtext;
} 

?>