<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

//custom account item class as account table abstraction
class class_shortlist extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name 		= 'shortlist';
	protected $_primary	= 'shortlist_code';
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 
	
	public function insert(array $data) {
        // add a timestamp		
		$data['shortlist_code']		= $this->createReference();
		$data['shortlist_added']		= date('Y-m-d H:i:s');

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
		$data['shortlist_updated'] 	= date('Y-m-d H:i:s');			

        return parent::update($data, $where);
    }
	
	/**
	 * get job by job shortlist Id
 	 * @param string job id
     * @return object
	 */
	public function getByCode($code, $type)
	{
		switch($type) {	
			case 'JOB' :
				$select = $this->_db->select()	
							->from(array('shortlist' => 'shortlist'))
							->joinLeft(array('participant' => 'participant'), 'participant.participant_code = shortlist.participant_code and participant_deleted = 0')
							->joinLeft(array('job' => 'job'), 'job.job_code = shortlist.shortlist_reference and job_deleted = 0')
							->joinLeft(array('areapost' => 'areapost'), 'areapost.areapost_code = job.areapost_code')
							->where('shortlist.shortlist_code = ?', $code)
							->where('shortlist.shortlist_type = ?', $type)
							->where('job_deleted = 0');		
				break;			
			case 'INTERNSHIP' :
				$select = $this->_db->select()	
							->from(array('shortlist' => 'shortlist'))
							->joinLeft(array('participant' => 'participant'), 'participant.participant_code = shortlist.participant_code and participant_deleted = 0')
							->joinLeft(array('internship' => 'internship'), 'internship.internship_code = shortlist.shortlist_reference')
							->where('shortlist.shortlist_code = ?', $code)
							->where('shortlist.shortlist_type = ?', $type)
							->where('internship_deleted = 0');		
				break;
			case 'CAREER' :				
				$select = $this->_db->select()	
							->from(array('shortlist' => 'shortlist'))
							->joinLeft(array('participant' => 'participant'), 'participant.participant_code = shortlist.participant_code and participant_deleted = 0')
							->joinLeft(array('career' => 'career'), 'career.career_code = shortlist.shortlist_reference')
							->where('shortlist.shortlist_code = ?', $code)
							->where('shortlist.shortlist_type = ?', $type)
							->where('career_deleted = 0');		
				break;
			default : return false;			
		}
		
		$result = $this->_db->fetchRow($select);
		return ($result == false) ? false : $result = $result;	      
	}
	
	public function getAll($type) {
		
		switch($type) {
			case 'JOB' :
				$select = $this->_db->select()	
							->from(array('shortlist' => 'shortlist'))
							->joinLeft(array('participant' => 'participant'), 'participant.participant_code = shortlist.participant_code')
							->joinLeft(array('job' => 'job'), 'job.job_code = shortlist.shortlist_reference and job_deleted = 0')
							->joinLeft(array('areapost' => 'areapost'), 'areapost.areapost_code = job.areapost_code')
							->where('shortlist.shortlist_type = ?', $type)
							->where('job_deleted = 0 and shortlist_deleted = 0');		
				break;			
			case 'INTERNSHIP' :				
				$select = $this->_db->select()	
							->from(array('shortlist' => 'shortlist'))
							->joinLeft(array('participant' => 'participant'), 'participant.participant_code = shortlist.participant_code')
							->joinLeft(array('internship' => 'internship'), 'internship.internship_code = shortlist.shortlist_reference')
							->where('shortlist.shortlist_type = ?', $type)
							->where('internship_deleted = 0 and shortlist_deleted = 0');		
				break;
			case 'CAREER' :				
				$select = $this->_db->select()	
							->from(array('shortlist' => 'shortlist'))
							->joinLeft(array('participant' => 'participant'), 'participant.participant_code = shortlist.participant_code and participant_deleted = 0')
							->joinLeft(array('career' => 'career'), 'career.career_code = shortlist.shortlist_reference')
							->where('shortlist.shortlist_type = ?', $type)
							->where('career_deleted = 0 and shortlist_deleted = 0');		
				break;
			default : return false;			
		}
		
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;	  
	}
	
	public function getByParticipant($participant, $type) {
		
		switch($type) {
			case 'JOB' :
				$select = $this->_db->select()	
							->from(array('shortlist' => 'shortlist'))
							->joinLeft(array('participant' => 'participant'), 'participant.participant_code = shortlist.participant_code')
							->joinLeft(array('job' => 'job'), 'job.job_code = shortlist.shortlist_reference')
							->joinLeft(array('areapost' => 'areapost'), 'areapost.areapost_code = job.areapost_code')
							->where('shortlist.participant_code = ?', $participant)
							->where('shortlist.shortlist_type = ?', $type)
							->where('job_deleted = 0 and participant_deleted = 0 and shortlist_deleted = 0');		
				break;			
			case 'INTERNSHIP' :				
				$select = $this->_db->select()	
							->from(array('shortlist' => 'shortlist'))
							->joinLeft(array('participant' => 'participant'), 'participant.participant_code = shortlist.participant_code')
							->joinLeft(array('internship' => 'internship'), 'internship.internship_code = shortlist.shortlist_reference')
							->where('shortlist.participant_code = ?', $participant)
							->where('shortlist.shortlist_type = ?', $type)
							->where('internship_deleted = 0 and participant_deleted = 0 and shortlist_deleted = 0');		
				break;
			case 'CAREER' :				
				$select = $this->_db->select()	
							->from(array('shortlist' => 'shortlist'))
							->joinLeft(array('participant' => 'participant'), 'participant.participant_code = shortlist.participant_code')
							->joinLeft(array('career' => 'career'), 'career.career_code = shortlist.shortlist_reference')
							->where('shortlist.participant_code = ?', $participant)
							->where('shortlist.shortlist_type = ?', $type)
							->where('career_deleted = 0 and participant_deleted = 0 and shortlist_deleted = 0');		
				break;
			default : return false;			
		}
		
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;	  
	}
	
	public function getByParticipantList($participant, $type) {
		
		switch($type) {
			case 'JOB' :
				$select = $this->_db->select()	
							->from(array('shortlist' => 'shortlist'), array('shortlist_reference'))
							->joinLeft(array('participant' => 'participant'), 'participant.participant_code = shortlist.participant_code', array())
							->joinLeft(array('job' => 'job'), 'job.job_code = shortlist.shortlist_reference', array())
							->joinLeft(array('areapost' => 'areapost'), 'areapost.areapost_code = job.areapost_code', array())
							->where('shortlist.participant_code = ?', $participant)
							->where('shortlist.shortlist_type = ?', $type)
							->where('job_deleted = 0 and participant_deleted = 0 and shortlist_deleted = 0');		
				break;			
			case 'INTERNSHIP' :				
				$select = $this->_db->select()	
							->from(array('shortlist' => 'shortlist'), array('shortlist_reference'))
							->joinLeft(array('participant' => 'participant'), 'participant.participant_code = shortlist.participant_code', array())
							->joinLeft(array('internship' => 'internship'), 'internship.internship_code = shortlist.shortlist_reference', array())
							->where('shortlist.participant_code = ?', $participant)
							->where('shortlist.shortlist_type = ?', $type)
							->where('internship_deleted = 0 and participant_deleted = 0 and shortlist_deleted = 0');		
				break;
			case 'CAREER' :				
				$select = $this->_db->select()	
							->from(array('shortlist' => 'shortlist'), array('shortlist_reference'))
							->joinLeft(array('participant' => 'participant'), 'participant.participant_code = shortlist.participant_code', array())
							->joinLeft(array('career' => 'career'), 'career.career_code = shortlist.shortlist_reference', array())
							->where('shortlist.participant_code = ?', $participant)
							->where('shortlist.shortlist_type = ?', $type)
							->where('career_deleted = 0 and participant_deleted = 0 and shortlist_deleted = 0');		
				break;
			default : return false;			
		}
		
		$result = $this->_db->fetchCol($select);
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
						->from(array('shortlist' => 'shortlist'))	
					   ->where('shortlist_code = ?', $reference)
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		// $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
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
}
?>