<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 02 December 2013
 * Author: Mzimhle Mosiwe
 */
 
require_once "Zend/Paginator.php";

//custom enquiry item class as enquiry table abstraction
class class_message extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name 		= '_message';
	protected $_primary 	= '_message_code';
		
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	public function insert(array $data) {
        // add a timestamp
        $data['_message_added']	= date('Y-m-d H:i:s');
		$data['_message_code']	= $this->createReference();

		return parent::insert($data);
    }
	
	/**
	 * Update the database record
	 * example: $table->update($data, $where);
	 * @param query string $where
	 * @param array $data
     * @return boolean
	 */
    public function update(array $data, $where) {
        // add a timestamp
        $data['_message_updated'] = date('Y-m-d H:i:s');		
		
        return parent::update($data, $where);	

    }
	
	public function getAll($where = '_message._message_deleted = 0', $order = '_message._message_added desc') {
	
			$select = $this->_db->select() 
					   ->from(array('_message' => '_message'))
					   ->where('_message._message_deleted = 0')
					   ->where($where)
					   ->order($order);
	
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;
	}
	
	public function getToSpam() {
	
			$select = $this->_db->select() 
					   ->from(array('_message' => '_message'))
						->joinLeft('_comm', "_comm.item_code = _message._message_code and _comm._comm_reference = 'SPAM'", array('spammed' =>new Zend_Db_Expr('COUNT(_comm.spam_code)')))				
					   ->where('_message._message_deleted = 0 and _message._message_active = 1')
					   ->group('_message._message_code');
	
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;
	}
	
	public function getSearch($search, $start, $length)
	{	
		if($search == '') {
			$select = $this->_db->select()
							->from(array('_message' => '_message'))
						   ->where("_message_deleted = 0")
						   ->order('_message_added desc');
		} else {
			$select = $this->_db->select()
							->from(array('_message' => '_message'))			   
						   ->where("_message_deleted = 0")
						   ->where("lower(concat(_message_name, ' ', category_subject)) like lower(?)", "%$search%")
						   ->order('_message_added desc');			
		}

		$result_count = $this->_db->fetchRow("select count(*) as query_count from ($select) as query");

		if ($start == '' || $length == '') { 
			$result = $this->_db->fetchAll($select);
		} else { 
			$result = $this->_db->fetchAll($select . " limit $start, $length");
		}
		
		return ($result === false) ? false : $result = array('count'=>$result_count['query_count'],'displayrecords'=>count($result),'records'=>$result);	
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getByCode($code) {
	
			$select = $this->_db->select()	
							->from(array('_message' => '_message'))																										
							->where('_message_code = ?', $code)
							->where('_message_deleted = 0');

		$result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getCode($code) {
		$select = $this->_db->select()	
						->from(array('_message' => '_message'))	
					   ->where('_message_code = ?', $code)
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
	 * example: $careersData = $careers->getPaginatedNews('career__message_active = 1 AND career_deleted = 0','career.career_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getPaginated($where = '_message_name != ""', $order = '_message_added desc', $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
		$select = $this->_db->select() 
				   ->from(array('_message' => '_message'))
				   ->where('_message._message_deleted = 0')
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