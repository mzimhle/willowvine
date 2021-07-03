<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 02 December 2013
 * Author: Mzimhle Mosiwe
 */

//custom enquiry item class as enquiry table abstraction
class class_twitter extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name 		= '_twitter';
	protected $_primary 	= '_twitter_code';
		
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	public function insert(array $data) {
        // add a timestamp
        $data['_twitter_added']	= date('Y-m-d H:i:s');
		$data['_twitter_code']		= $this->createCode();

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
        $data['_twitter_updated'] = date('Y-m-d H:i:s');		
		
        return parent::update($data, $where);	
    }

	public function getSearch($search, $start, $length)
	{	
		if($search == '') {
			$select = $this->_db->select()
							->from(array('_twitter' => '_twitter'))
						   ->where("_twitter_deleted = 0")
						   ->order('_twitter_added desc');
		} else {
			$select = $this->_db->select()
							->from(array('_twitter' => '_twitter'))			   
						   ->where("_twitter_deleted = 0")
						   ->where("lower(concat(_twitter_name, ' ', category_subject)) like lower(?)", "%$search%")
						   ->order('_twitter_added desc');			
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
					->from(array('_twitter' => '_twitter'))
					->joinLeft('job', "job.job_code = _twitter.job_code")
					->where("job.job_deleted = 0 and job.job_active = 1")
					->where("_twitter._twitter_deleted = 0 and _twitter._twitter_active = 1")
					->where('_twitter_code = ?', $code)
					->where('_twitter_deleted = 0');

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
						->from(array('_twitter' => '_twitter'))	
					   ->where('_twitter_code = ?', $code)
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	function createCode() {
		/* New code. */
		$code = "";
		//$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet = '123456789';
		
		$count = strlen($codeAlphabet) - 1;
		
		for($i=0;$i<5;$i++){
			$code .= $codeAlphabet[rand(0,$count)];
		}
		
		$code .= time().$code;
		
		/* First check if it exists or not. */
		$itemCheck = $this->getCode($code);
		
		if($itemCheck) {
			/* It exists. check again. */
			$this->createCode();
		} else {
			return $code;
		}
	}
}

?>