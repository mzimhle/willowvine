<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */
 

//custom enquiry item class as enquiry table abstraction
class class_tracker extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = '_tracker';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        $data['_tracker_added'] = date('Y-m-d H:i:s');
        $data['_tracker_code']	= $this->createReference();
		        
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
        return parent::update($data, $where);
    }
	
	
	public function getAll($where, $order) {
	
			$select = $this->_db->select() 
					   ->from(array('_tracker' => '_tracker'))
					   ->joinLeft(array('_comm' => '_comm'), '_comm._comm_code = _tracker._comm_code')	
					   ->joinLeft(array('participant' => 'participant'), 'participant.participant_code = _comm.participant_code')	
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
	public function getByCode($reference)
	{
		$select = $this->_db->select()	
						->from(array('_tracker' => '_tracker'))	
					   ->where('_tracker_code = ?', $reference)
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
						->from(array('_tracker' => '_tracker'))	
					   ->where('_tracker_code = ?', $reference)
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		// $codeAlphabet = "abcdefghijklmnopqrstuvwxyz";
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
}
?>