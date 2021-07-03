<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 02 December 2013
 * Author: Mzimhle Mosiwe
 */
require_once "Zend/Paginator.php";  

require_once 'mailinglist.php';

//custom enquiry item class as enquiry table abstraction
class class_spam extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name 			= 'spam';
	protected $_primary 		= 'spam_code';
	protected $_mailinglist 	= null;
	protected $_website			= array('gmail.com', 'pearson.com', 'inbox.com', 'hotmail.com', 'ovi.com', 'yahoo.com', 'icloud.com', 'home.com', 'saymail.co.za', 'webmail.co.za', 'mtnloaded.co.za', 'live.com', 'hotmail.com', 'cellc.blackberry.com', 'mobileemail.vodafonesa.co.zavo', 'telkomsa.net', 'ymail.com');
	
	function init()	{
		$this->_mailinglist		= new class_mailinglist();
	}
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data) {
        // add a timestamp
        $data['spam_added']	= isset($data['spam_added']) && $data['spam_added'] != '' ? $data['spam_added'] : date('Y-m-d H:i:s');
		$data['spam_code']	= $this->createReference();

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
        $data['spam_updated'] = date('Y-m-d H:i:s');
		
        return parent::update($data, $where);	
    }
	
	public function getAll($where = 'spam.spam_deleted = 0', $order = 'spam.spam_added desc') {
	
			$select = $this->_db->select() 
					   ->from(array('spam' => 'spam'))
					   ->joinLeft('mailinglist', 'mailinglist.mailinglist_reference = spam.spam_code and mailinglist_category = \'spam\'')
					   ->where('spam.spam_deleted = 0')
					   ->where($where)
					   ->order($order);
	
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;
	}
	
	public function getSearch($search, $start, $length)
	{	
		if($search == '') {
			$select = $this->_db->select()
							->from(array('spam' => 'spam'))
						   ->where("spam_deleted = 0")
						   ->order('spam_added desc');
		} else {
			$select = $this->_db->select()
							->from(array('spam' => 'spam'))	   
						   ->where("spam_deleted = 0")
						   ->where("lower(concat(spam_name, ' ', spam_email, ' ', spam_email)) like lower(?)", "%$search%")
						   ->order('spam_added desc');			
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
							->from(array('spam' => 'spam'))																										
							->joinLeft('mailinglist', 'mailinglist.mailinglist_reference = spam.spam_code and mailinglist_category = \'spam\'')
							->where('spam_code = ?', $code)
							->where('spam_deleted = 0');

		$result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	/**
	 * get job by job participant Id
 	 * @param string job id
     * @return object
	 */
	public function getByCell($cell, $code = null) {
	
		if($code == null) {
			$select = $this->_db->select()	
						->from(array('spam' => 'spam'))	
						->where('spam_cellphone = ?', $cell)
						->where('spam_deleted = 0')
						->limit(1);
       } else {
			$select = $this->_db->select()	
						->from(array('spam' => 'spam'))
						->where('spam_cellphone = ?', $cell)
						->where('spam_code != ?', $code)
						->where('spam_deleted = 0')
						->limit(1);		
	   }
	   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	}
	
	/**
	 * get job by job participant Id
 	 * @param string job id
     * @return object
	 */ 
	public function getByMessage($messagecode, $type, $limit = 100) {
	 
		if($type == 'EMAIL') {
			$select = $this->_db->select()	
						->from(array('spam' => 'spam'))
						->joinLeft('_comm', "_comm.spam_code = spam.spam_code and _comm._comm_sent = 1 and _comm_reference = 'SPAM' and _comm.item_code = '$messagecode'", array())
						->where("spam_email != '' or spam_email is not null")
						->where("_comm.spam_code is null")
						->where('spam_deleted = 0 and spam_active = 1')
						->limit($limit);
       } else {
			$select = $this->_db->select()	
						->from(array('spam' => 'spam'))
						->joinLeft('_comm', "_comm.spam_code = spam.spam_code and _comm._comm_sent = 1 and _comm_reference = 'SPAM' and _comm.item_code = '$messagecode'", array())
						->where("spam_cellphone != ''")
						->where("_comm.spam_code is null")
						->where('spam_deleted = 0 and spam_active = 1')
						->limit($limit);	
	   }
	   
	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;
	}
	
	/**
	 * get job by job spam Id
 	 * @param string job id
     * @return object
	 */
	public function getByEmail($email, $code = null) {
	
		if($code == null) {
			$select = $this->_db->select()	
						->from(array('spam' => 'spam'))	
						->where('spam_email = ?', $email)
						->where('spam_deleted = 0')
						->limit(1);
       } else {
			$select = $this->_db->select()	
						->from(array('spam' => 'spam'))	
						->where('spam_email = ?', $email)
						->where('spam_code != ?', $code)
						->where('spam_deleted = 0')
						->limit(1);		
	   }
	   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	}
	
	public function checkBoth($email, $cellphone) {
		
		$select = $this->_db->select()	
					->from(array('spam' => 'spam'))	
					->where('spam_email = ?', $email)
					->where('spam_cellphone = ?', $cellphone)
					->where('spam_deleted = 0')
					->limit(1);
	}
	
	function getMailDomain($email) {
		// Get the data after the @ sign
		$domain = substr($email, strpos($email, "@") + 1); 
		
		return 'http://'.$domain;
	}
	
	public function validateEmail($string) {
		if(preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($string))) {
			return trim($string);
		} else {
			return '';
		}
	}
	
	public function validateCell($string) {
		
		$string = substr($string, 0, 1) != '0' && strlen($string) == 9 ? '0'.$string : $string;
		
		if(preg_match('/^0[0-9]{9}$/', $this->onlyCellNumber(trim($string)))) {
			return $this->onlyCellNumber(trim($string));
		} else {
			return '';
		}
	}
	
	public function validateDate($string) {
		if(preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $string)) {
			if(date('Y-m-d', strtotime($string)) != $string) {
				return '';
			} else {
				return $string;
			}
		} else {
			return '';
		}
	}
	
	public function onlyCellNumber($string) {

		/* Remove some weird charactors that windows dont like. */
		$string = strtolower($string);
		$string = str_replace(' ' , '' , $string);
		$string = str_replace('__' , '' , $string);
		$string = str_replace(' ' , '' , $string);
		$string = str_replace("é", "", $string);
		$string = str_replace("è", "", $string);
		$string = str_replace("`", "", $string);
		$string = str_replace("/", "", $string);
		$string = str_replace("\\", "", $string);
		$string = str_replace("'", "", $string);
		$string = str_replace("(", "", $string);
		$string = str_replace(")", "", $string);
		$string = str_replace("-", "", $string);
		$string = str_replace(".", "", $string);
		$string = str_replace("ë", "", $string);	
		$string = str_replace('___' , '' , $string);
		$string = str_replace('__' , '' , $string);	
		$string = str_replace(' ' , '' , $string);
		$string = str_replace('__' , '' , $string);
		$string = str_replace(' ' , '' , $string);
		$string = str_replace("é", "", $string);
		$string = str_replace("è", "", $string);
		$string = str_replace("`", "", $string);
		$string = str_replace("/", "", $string);
		$string = str_replace("\\", "", $string);
		$string = str_replace("'", "", $string);
		$string = str_replace("(", "", $string);
		$string = str_replace(")", "", $string);
		$string = str_replace("-", "", $string);
		$string = str_replace(".", "", $string);
		$string = str_replace("ë", "", $string);	
		$string = str_replace("â€“", "", $string);	
		$string = str_replace("â", "", $string);	
		$string = str_replace("€", "", $string);	
		$string = str_replace("“", "", $string);	
		$string = str_replace("#", "", $string);	
		$string = str_replace("$", "", $string);	
		$string = str_replace("@", "", $string);	
		$string = str_replace("!", "", $string);	
		$string = str_replace("&", "", $string);	
		$string = str_replace(';' , '' , $string);		
		$string = str_replace(':' , '' , $string);		
		$string = str_replace('[' , '' , $string);		
		$string = str_replace(']' , '' , $string);		
		$string = str_replace('|' , '' , $string);		
		$string = str_replace('\\' , '' , $string);		
		$string = str_replace('%' , '' , $string);	
		$string = str_replace(';' , '' , $string);		
		$string = str_replace(' ' , '' , $string);
		$string = str_replace('__' , '' , $string);
		$string = str_replace(' ' , '' , $string);	
		$string = str_replace('-' , '' , $string);	
		$string = str_replace('+27' , '0' , $string);	
		$string = str_replace('(0)' , '' , $string);	
		
		$string = preg_replace('/^00/', '0', $string);
		$string = preg_replace('/^27/', '0', $string);
		
		$string = preg_replace('!\s+!',"", strip_tags($string));
		
		return $string;				
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
						->from(array('spam' => 'spam'))	
					   ->where('spam_code = ?', $code)
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
		
		for($i=0;$i<15;$i++){
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
	 * example: $careersData = $careers->getPaginatedNews('career_spam_active = 1 AND career_deleted = 0','career.career_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getPaginated($where = 'spam_name != ""', $order = 'spam_added desc', $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
		$select = $this->_db->select() 
				   ->from(array('spam' => 'spam'))
				   ->joinLeft('areapost', 'areapost.areapost_code = spam.areapost_code')
				   ->where('spam.spam_deleted = 0 and category_deleted = 0')
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