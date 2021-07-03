<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 02 December 2013
 * Author: Mzimhle Mosiwe
 */
require_once "Zend/Paginator.php";  

require_once 'enquiry.php';

//custom enquiry item class as enquiry table abstraction
class class_internship extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name 			= 'internship';
	protected $_primary 		= 'internship_code';
	protected $_enquiry			= null;
	
	function init()	{
		$this->_enquiry		= new class_enquiry();
	}
		
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data) {
        // add a timestamp
        $data['internship_added']	= isset($data['internship_added']) && $data['internship_added'] != '' ? $data['internship_added'] : date('Y-m-d H:i:s');
		$data['internship_code']		= $this->createReference();
		$data['internship_url']		= $this->toUrl($data['internship_name']);

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
        $data['internship_updated'] 											= date('Y-m-d H:i:s');		
		if(isset($data['internship_name'])) $data['internship_url']	= $this->toUrl($data['internship_name']).$data['internship_code'];
		
        return parent::update($data, $where);	
    }
	
	public function getAll($where = 'internship.internship_deleted = 0', $order = 'internship.internship_added desc') {
	
			$select = $this->_db->select() 
					   ->from(array('internship' => 'internship'))
					   ->joinLeft('category', 'category.category_code = internship.category_code')
					   ->where('internship.internship_deleted = 0 and category_deleted = 0')
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
							->from(array('internship' => 'internship'))							
						   ->joinLeft('category', 'category.category_code = internship.category_code')
						   ->where('internship.internship_deleted = 0 and category_deleted = 0')
							->where('internship_code = ?', $code);

		$result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getByReference($reference) {
		
		$select = $this->_db->select()	
						->from(array('internship' => 'internship'))							
						->joinLeft('category', 'category.category_code = internship.category_code')
						->where('internship.internship_deleted = 0 and category_deleted = 0')
						->where('internship_reference = ?', $reference)
						->limit(1);
		
		$result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
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
						->from(array('internship' => 'internship'))	
					   ->where('internship_code = ?', $code)
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
	 * example: $careersData = $careers->getPaginatedNews('career_internship_active = 1 AND career_deleted = 0','career.career_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getPaginated($where = 'internship_name != ""', $order = 'internship_added desc', $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
		$select = $this->_db->select() 
				   ->from(array('internship' => 'internship'))
				   ->joinLeft('category', 'category.category_code = internship.category_code')
				   ->where('internship.internship_deleted = 0 and category_deleted = 0')
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