<?php

require_once 'phpThumb/ThumbLib.inc.php';

class File {

	public $allowedExtensions = array();
	
	public $logo	= array(
										'min'			=> array('width' => '50', 'height' => '50', 'code' => 'min_'),
										'tiny'			=> array('width' => '120', 'height' => '120', 'code' => 'tny_'),
										'thumb'		=> array('width' => '300', 'height' => '200', 'code' => 'tmb_'),
										'medium'	=> array('width' => '570', 'height' => '320', 'code' => 'mdm_'),
										'big'			=> array('width' => '536', 'height' => '480', 'code' => 'big_')
									);
																
	public $banner	= array(
										'min'			=> array('width' => '90', 'height' => '50', 'code' => 'min_'),
										'tiny'			=> array('width' => '120', 'height' => '90', 'code' => 'tny_'),
										'thumb'		=> array('width' => '300', 'height' => '100', 'code' => 'tmb_'),
										'medium'	=> array('width' => '670', 'height' => '150', 'code' => 'mdm_'),
										'big'			=> array('width' => '745', 'height' => '200', 'code' => 'big_')
									);
															
	public $mime_types2 = array(
        'pdf' => 'application/pdf',		
	);
	
    public $mime_types = array(
            'txt' 		=> 'text/plain',
            'htm'		=> 'text/html',
            'html' 	=> 'text/html',
            'php' 	=> 'text/html',
            'css' 		=> 'text/css',
            'js' 		=> 'application/javascript',
            'json' 	=> 'application/json',
            'xml' 	=> 'application/xml',
            'swf' 		=> 'application/x-shockwave-flash',
            'flv' 		=> 'video/x-flv',

            // images
            'png' 	=> 'image/png',
            'jpeg' 	=> 'image/jpeg',
            'jpg' 		=> 'image/jpeg',
            'gif' 		=> 'image/gif',
            'bmp' 	=> 'image/bmp',
            'ico' 		=> 'image/vnd.microsoft.icon',
            'tiff' 		=> 'image/tiff',
            'tif' 		=> 'image/tiff',
            'svg' 	=> 'image/svg+xml',
            'svgz' 	=> 'image/svg+xml',

            // archives
            'zip' 		=> 'application/zip',
            'rar' 		=> 'application/x-rar-compressed',
            'exe' 	=> 'application/x-msdownload',
            'msi' 	=> 'application/x-msdownload',
            'cab' 	=> 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' 	=> 'audio/mpeg',
            'qt' 		=> 'video/quicktime',
            'mov' 	=> 'video/quicktime',

            // adobe
			'pdf' 		=> 'application/octet-streamn',
            'psd' 	=> 'image/vnd.adobe.photoshop',
            'ai' 		=> 'application/postscript',
            'eps' 	=> 'application/postscript',
            'ps' 		=> 'application/postscript',

            // ms office
            'doc' 	=> 'application/msword',
            'rtf' 		=> 'application/rtf',
            'xls' 		=> 'application/vnd.ms-excel',
            'ppt' 		=> 'application/vnd.ms-powerpoint',
			'docx' 	=> 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			
            // open office
            'odt' 		=> 'application/vnd.oasis.opendocument.text',
            'ods' 	=> 'application/vnd.oasis.opendocument.spreadsheet',
        );	
		    		
	function __construct($allowedExtPar = array()) {

		$this->allowedExtensions = $allowedExtPar;
	}
	
	public function valideExt($ext) {
		
		if(in_array($ext, $this->allowedExtensions)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function file_content_type($filename) {
		if(function_exists('mime_content_type')) {
			return mime_content_type($filename);
		} else {
		 $ext = $this->file_extention($filename);
        if (array_key_exists($ext, $this->mime_types)) {
            return $this->mime_types[$ext];
        }
        elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        }
        else {
            return '';
        }
		}
	}
	
	public function file_extention($filename) {
		$file = explode('.', $filename);
		return array_pop($file);
	}
	
	/*
	public function file_valid_type($filename) {
		$content_type = $this->file_content_type($filename);
		
		if($content_type != '') {
			return $content_type; 
		} else {
			return false;
		}
	}
	*/
	
	public function getValidateExtention($name, $ext, $i = '') {

		if($i === '') {
			$mime = array_search($_FILES[$name]['type'], $this->mime_types); 
			if(!$mime) {
				$mime = array_search($_FILES[$name]['type'], $this->mime_types2); 
			}

			if($this->valideExt($ext)) {			
				return $mime;
			} else {
				return false;
			}
		} else {		
			$mime = array_search($_FILES[$name]['type'][$i], $this->mime_types); 
			
			if(!$mime) {
				$mime = array_search($_FILES[$name]['type'][$i], $this->mime_types2); 
			}

			if($this->valideExt($ext)) {			
				return $mime;
			} else {
				return false;
			}		
		}
	}
	
	public function getValidMimeType($name, $ext) {
		$mime = array_search($_FILES[$name]['type'], $this->mime_types); 
		if(!$mime) {
			$mime = array_search($_FILES[$name]['type'], $this->mime_types2); 
		}
		if($this->valideExt($ext)) {			
			return $mime;
		} else {
			return '';
		}
	}
	
	public function getMimeType($ext) {
		if($this->valideExt($ext)) {						
			return $this->mime_types[$ext];
		} else {
			return '';
		}		
	}
	
	public function getRandomFileName($appendname = null) {		
		if($appendname == null) {
			return time();
		} else {
			return $appendname.'_'.time();
		}
	} 
	
	public function getValidateSize($size) {
		if($this->allowedCVSize() < $size) {
			return false;
		} else {
			return true;
		}
	}
	
	public function allowedCVSize() {
		return 2000000;
		
	}
	
	public function getFileContents($fullpath) {
	
		return file_get_contents($fullpath);
	}
}
?>