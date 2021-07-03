<?php


require_once "Zend/Paginator.php";  
require_once 'File.php';

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 02 December 2013
 * Author: Mzimhle Mosiwe
 */


//custom enquiry item class as enquiry table abstraction
class class_exam extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name 			= 'exam';
	protected $_primary 		= 'exam_code';
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
        $data['exam_added']	= date('Y-m-d H:i:s');
		$data['exam_code']	= isset($data['exam_code']) && trim($data['exam_code']) != '' ? trim($data['exam_code']) : $this->createReference();
		$data['exam_url']		= $this->toUrl($data['exam_name']);

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
        $data['exam_updated'] 											= date('Y-m-d H:i:s');		
		if(isset($data['exam_name'])) $data['exam_url']	= $this->toUrl($data['exam_name']).$data['exam_code'];
		
        return parent::update($data, $where);	
    }
	
	public function getAll($where = 'exam.exam_deleted = 0', $order = 'exam.exam_added desc') {
	
			$select = $this->_db->select() 
					   ->from(array('exam' => 'exam'))
					   ->joinLeft('subject', 'subject.subject_code = exam.subject_code')
					   ->where('exam.exam_deleted = 0 and subject_deleted = 0')
					   ->where($where)
					   ->order($order);
	
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getByCode($code) {
	
			$select = $this->_db->select()	
							->from(array('exam' => 'exam'))							
						   ->joinLeft('subject', 'subject.subject_code = exam.subject_code')
						   ->where('exam.exam_deleted = 0 and subject_deleted = 0')
							->where('exam_code = ?', $code);

		$result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
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
		
		$examData = $this->getByCode($code);

		if($examData) {
		
			$PATH 	= $_SERVER['DOCUMENT_ROOT'].$examData['exam_path'];
			$MIME	= $this->_File->file_content_type($examData['exam_path']);

			header("Expires: on, 01 Jan 1970 00:00:00 GMT");
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			header("Cache-Control: no-store, no-cache, must-revalidate");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
			header("Content-Description: File Transfer");
			header("Content-Type: " . $MIME);
			header("Content-Length: " .(string)(filesize($PATH)) );
			header('Content-Disposition: attachment; filename="'.$examData['exam_name'].'"');
			header("Content-Transfer-Encoding: binary\n");

			readfile($PATH); // outputs the content of the file;
		
			exit;
			
		}
		
		header('Location: /404/');
		exit;
		
	}
	
	public function toUrl($title) {
		$name = strtolower(trim($title));
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
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getCode($code) {
		$select = $this->_db->select()	
						->from(array('exam' => 'exam'))	
					   ->where('exam_code = ?', $code)
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		//$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
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
	
	/**
	 * get careers ordered by column name as pagination object
	 * example: $careersData = $careers->getPaginatedNews('career_exam_active = 1 AND career_deleted = 0','career.career_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getPaginated($where = 'exam_name != ""', $order = 'exam_added desc', $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
		$select = $this->_db->select() 
				   ->from(array('exam' => 'exam'))
				   ->joinLeft('subject', 'subject.subject_code = exam.subject_code')
				   ->where('exam.exam_deleted = 0 and subject_deleted = 0')
				   ->where($where)
				   ->order($order);
						   
		$paginator = Zend_Paginator::factory($select);
		$paginator->setCurrentPageNumber($page);
		$paginator->setItemCountPerPage($perPage);
		$paginator->setPageRange($listedPages);
		$paginator->setDefaultScrollingStyle($scrollingStyle); 
		$pages = $paginator;

		return $pages;
	}	
}
?>