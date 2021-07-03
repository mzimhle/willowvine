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
require_once 'enquiry.php';

//custom enquiry item class as enquiry table abstraction
class class_job extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name 			= 'job';
	protected $_primary 		= 'job_code';
	protected $_mailinglist 	= null;
	protected $_enquiry			= null;
	
	function init()	{
		$this->_mailinglist		= new class_mailinglist();
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
        $data['job_added']	= isset($data['job_added']) && $data['job_added'] != '' ? $data['job_added'] : date('Y-m-d H:i:s');
		$data['job_code']	= $this->createReference();
		$data['job_url']		= $this->toUrl($data['job_title']);

		$success = parent::insert($data);
		
		if($success) {
			$tempData = $this->getByCode($data['job_code'], 1);
			
			if($tempData) {
				/* Create a new mailerlist record. */
				$this->_mailinglist->insertMailinglist('job', $tempData);						
			}			
		} else {
			return false;
		}
		return $success;
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
        $data['job_updated'] = date('Y-m-d H:i:s');		
		if(isset($data['job_title'])) $data['job_url']	= $this->toUrl($data['job_title']).$data['job_code'];
		
        $success = parent::update($data, $where);	

		$tempData = $this->getByCode($data['job_code'], 1);
		
		if($tempData) {		
			$this->_mailinglist->updateMailinglist('job', $tempData);
		}
		
		return true;
    }
	
	public function getAll($where = 'job.job_deleted = 0', $order = 'job.job_added desc') {
	
			$select = $this->_db->select() 
					   ->from(array('job' => 'job'))
					   ->joinLeft('category', 'category.category_code = job.category_code')		
					   ->joinLeft('participant', 'participant.participant_code = job.participant_code')
					   ->joinLeft('areapost', 'areapost.areapost_code = job.areapost_code')
					   ->joinLeft('mailinglist', 'mailinglist.mailinglist_reference = job.job_code and mailinglist_category = \'job\'')
					   ->where('job.job_deleted = 0')
					   ->where($where)
					   ->order($order);
	
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;
	}
	
	public function getForTwitter() {
			
			$select = $this->_db->select() 
					   ->from(array('job' => 'job'))
					   ->joinLeft('category', 'category.category_code = job.category_code')
					   ->joinLeft('_twitter', '_twitter.job_code = job.job_code', array())
					   ->where("_twitter.job_code = '' or _twitter.job_code is null")
					   ->where("job_added >= DATE_SUB(CURDATE(), INTERVAL 2 MONTH)")
					   ->where('job.job_deleted = 0');
					   
		$result = $this->_db->fetchRow($select);
		return ($result == false) ? false : $result = $result;
	}
	
	public function getSearch($search, $start = '', $length = '')
	{	
		if($search == '') {
			$select = $this->_db->select()
							->from(array('job' => 'job'))
						   ->joinLeft('category', 'category.category_code = job.category_code', array('category_name'))		
						   ->joinLeft('participant', 'participant.participant_code = job.participant_code', array('participant_name', 'participant_surname'))
						   ->joinLeft('areapost', 'areapost.areapost_code = job.areapost_code', array('areapost_name'))
						   ->joinLeft('recruiter', 'recruiter.recruiter_code = job.recruiter_code', array('recruiter_name')) 
						   ->where("job_deleted = 0")
						   ->order('job_added desc');
		} else {
			$select = $this->_db->select()
							->from(array('job' => 'job'))
						   ->joinLeft('category', 'category.category_code = job.category_code', array('category_name'))		
						   ->joinLeft('participant', 'participant.participant_code = job.participant_code', array('participant_name', 'participant_surname'))
						   ->joinLeft('areapost', 'areapost.areapost_code = job.areapost_code', array('areapost_name'))
						   ->joinLeft('recruiter', 'recruiter.recruiter_code = job.recruiter_code', array('recruiter_name')) 				   
						   ->where("job_deleted = 0")
						   ->where("lower(concat_ws(job_title, ' ', job_type, ' ', areapost_name)) like lower(?)", "%$search%")
						   ->order('job_added desc');
		}

		$result_count = $this->_db->fetchRow("select count(*) as query_count from ($select) as query");

		if ($start == '' || $length == '') { 
			$result = $this->_db->fetchAll($select);
		} else { 
			$result = $this->_db->fetchAll($select . " limit $start, $length");
		}
		
		return ($result === false) ? false : $result = array('count'=>$result_count['query_count'],'displayrecords'=>count($result),'records'=>$result);	
	}
	
	public function search($search, $page = 1, $perpage = 10) {
	
		if($search == '') {
			$select = $this->_db->select()
					->from(array('job' => 'job'))
					->joinLeft('category', 'category.category_code = job.category_code', array('category_name'))		
					->joinLeft('participant', 'participant.participant_code = job.participant_code', array('participant_name', 'participant_surname'))
					->joinLeft('areapost', 'areapost.areapost_code = job.areapost_code', array('areapost_name'))
					->joinLeft('recruiter', 'recruiter.recruiter_code = job.recruiter_code', array('recruiter_name')) 
					->where("job_deleted = 0")
					->order('job_added desc');
		} else {
			$select = $this->_db->select()
					->from(array('job' => 'job'))
					->joinLeft('category', 'category.category_code = job.category_code', array('category_name'))		
					->joinLeft('participant', 'participant.participant_code = job.participant_code', array('participant_name', 'participant_surname'))
					->joinLeft('areapost', 'areapost.areapost_code = job.areapost_code', array('areapost_name'))
					->joinLeft('recruiter', 'recruiter.recruiter_code = job.recruiter_code', array('recruiter_name')) 				   
					->where("job_deleted = 0")
					->where("lower(concat_ws(job_title, ' ', job_type, ' ', areapost_name)) like lower(?)", "%$search%")
					->order('job_added desc');
		}
		
		$result_count 	= $this->_db->fetchRow("select count(*) as query_count from ($select) as query"); //count num rows
		$start				= $perpage*($page-1); //start for select on next page (page2, 3, 4,5)
		$length				= min($result_count['query_count'],$page*$perpage); //end
		
		$result = $this->_db->fetchAll($select . " limit $start, $length");
				
		return ($result === false) ? false : $result = array('count'=>$result_count['query_count'],'displayrecords'=>count($result),'pages'=>ceil($result_count['query_count']/$perpage),'records'=>$result);	
	}
	
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getByCode($code) {
	
			$select = $this->_db->select()	
							->from(array('job' => 'job'))																										
							->joinLeft('category', 'category.category_code = job.category_code')		
							->joinLeft('mailinglist', 'mailinglist.mailinglist_reference = job.job_code and mailinglist_category = \'job\'')
							->joinLeft('participant', 'participant.participant_code = job.participant_code')
							->joinLeft('areapost', 'areapost.areapost_code = job.areapost_code')	
							->where('job_code = ?', $code)
							->where('job_deleted = 0');

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
						->from(array('job' => 'job'))							
						->joinLeft('participant', 'participant.participant_code = job.participant_code')
						->joinLeft('areapost', 'areapost.areapost_code = job.areapost_code')						
						->joinLeft('category', 'category.category_code = job.category_code')		
						->joinLeft('mailinglist', 'mailinglist.mailinglist_reference = job.job_code and mailinglist_category = \'job\'')
						->where('job_reference = ?', $reference)
						->where('job_deleted = 0')
						->limit(1);
		
		$result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getByLink($link) {
		
		$select = $this->_db->select()	
						->from(array('job' => 'job'))							
						->joinLeft('participant', 'participant.participant_code = job.participant_code')
						->joinLeft('areapost', 'areapost.areapost_code = job.areapost_code')						
						->joinLeft('category', 'category.category_code = job.category_code')		
						->joinLeft('mailinglist', 'mailinglist.mailinglist_reference = job.job_code and mailinglist_category = \'job\'')
						->where('job_link = ?', $link)
						->where('job_deleted = 0')
						->limit(1);
		
		$result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	public function validateEmail($string) {
		if(preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($string))) {
			return trim($string);
		} else {
			return '';
		}
	}
	
	public function validateCell($string) {
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
						->from(array('job' => 'job'))	
					   ->where('job_code = ?', $code)
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
	 * example: $careersData = $careers->getPaginatedNews('career_job_active = 1 AND career_deleted = 0','career.career_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getPaginated($where = 'job_title != ""', $order = 'job_added desc', $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
		$select = $this->_db->select() 
				   ->from(array('job' => 'job'))
				   ->joinLeft('areapost', 'areapost.areapost_code = job.areapost_code')
				   ->joinLeft('category', 'category.category_code = job.category_code')
				   ->where('job.job_deleted = 0')
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