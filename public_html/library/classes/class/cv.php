<?php

require_once 'File.php';

//custom account item class as account table abstraction
class class_cv extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name			= 'cv';
	protected $_primary		= 'cv_code';
	public $_File						= null;
	
	function init()	{
		$this->_File					= new File(array('doc', 'docx', 'pdf', 'txt'));
	}
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	public function insert(array $data) {
        // add a timestamp
        $data['cv_added']		= date('Y-m-d H:i:s');
        $data['cv_code']		= $this->createReference();
		
		return parent::insert($data);	
    }
	
	/**
	 * Update the database record
	 * example: $table->update($data, $where);
	 * @param query string $where
	 * @param array $data
     * @return boolean
	 */
    public function update(array $data, $where)
    {
        // add a timestamp
        $data['cv_updated'] = date('Y-m-d H:i:s');
        
		return parent::update($data, $where);

    }
	
	public function getAll()	{
	
		$select = $this->_db->select()	
						->from(array('cv' => 'cv'))
						->joinLeft('participant', 'participant.participant_code = cv.participant_code')
						->joinLeft('areapost', 'areapost.areapost_code = participant.areapost_code')
						->where('cv_deleted = 0 and participant_deleted = 0')
						->order(array('cv_name'));

	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	public function getByParticipant($code)	{
	
		$select = $this->_db->select()	
						->from(array('cv' => 'cv'))
						->joinLeft('participant', 'participant.participant_code = cv.participant_code')
						->joinLeft('areapost', 'areapost.areapost_code = participant.areapost_code')
						->where('cv_deleted = 0 and participant_deleted = 0')
						->where('participant.participant_code = ?', $code)
						->order(array('cv_name'));

	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getByCode($code)
	{
		$select = $this->_db->select()	
						->from(array('cv' => 'cv'))	
						->joinLeft('participant', 'participant.participant_code = cv.participant_code')
						->joinLeft('areapost', 'areapost.areapost_code = participant.areapost_code')
						->where('cv_deleted = 0 and participant_deleted = 0')
					   ->where('cv_code = ?', $code)
					   ->where('cv_deleted = 0')
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getCode($reference)
	{
		$select = $this->_db->select()	
						->from(array('cv' => 'cv'))	
					   ->where('cv_code = ?', $reference)
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		$codeAlphabet = '123456789';
		
		$count = strlen($codeAlphabet) - 1;
		
		for($i=0;$i<10;$i++){
			$reference .= $codeAlphabet[rand(0,$count)];
		}
		
		/* First check if it exists or not. */
		$itemCheck = $this->getCode($reference);
		
		if($itemCheck) {
			/* It exists. check again. */
			$this->createReference();
		} else {
			return $reference;
		}
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
	
	public function download($code) {
		
		$cvData = $this->getByCode($code);
		
		if($cvData) {
		
			$PATH 	= $_SERVER['DOCUMENT_ROOT'].$cvData['cv_path'];
			$MIME	= $this->_File->file_content_type($cvData['cv_path']);

			header("Expires: on, 01 Jan 1970 00:00:00 GMT");
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			header("Cache-Control: no-store, no-cache, must-revalidate");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
			header("Content-Description: File Transfer");
			header("Content-Type: " . $MIME);
			header("Content-Length: " .(string)(filesize($PATH)) );
			header('Content-Disposition: attachment; filename="'.$cvData['cv_name'].'"');
			header("Content-Transfer-Encoding: binary\n");

			readfile($PATH); // outputs the content of the file;
		
			exit;
			
		}
		
		header('Location: /404/');
		exit;
		
	}
	
}
?>