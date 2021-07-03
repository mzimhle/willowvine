<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

require_once '_comm.php';

//custom account item class as account table abstraction
class class_share extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name 		= 'share';
	protected $_primary	= 'share_code';
	
   //declare table variables
	protected $_comm		= null;
	
	function init()	{
		$this->_comm	= new class_comm();
	}
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 
	
	public function insert(array $data) {
        // add a timestamp		
		$data['share_code']		= $this->createReference();
		$data['share_added']		= date('Y-m-d H:i:s');

		$success =  parent::insert($data);	
		
		$shareData = $this->getByCode($success, $data['share_type']);
		
		if($shareData) {
			if($shareData['share_type'] == 'JOB') {
				$this->_comm->sendShare('templates/mail/share_job.html', $shareData);
			} else if($shareData['share_type'] == 'INTERNSHIP') {
				$this->_comm->sendShare('templates/mail/share_internship.html', $shareData);
			} else if($shareData['share_type'] == 'CAREER') {
				$this->_comm->sendShare('templates/mail/share_career.html', $shareData);
			} else if($shareData['share_type'] == 'EXAM') {
				$this->_comm->sendShare('templates/mail/share_exam.html', $shareData);
			}
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
    public function update(array $data, $where) {
        // add a timestamp
		$data['share_updated'] 	= date('Y-m-d H:i:s');			

        return parent::update($data, $where);
    }
	
	/**
	 * get job by job share Id
 	 * @param string job id
     * @return object
	 */
	public function getByCode($code, $type = null)
	{
		switch($type) {			
			case 'JOB' :
				$select = $this->_db->select()	
							->from(array('share' => 'share'))
							->joinLeft(array('participant' => 'participant'), 'participant.participant_code = share.participant_code and participant_deleted = 0')
							->joinLeft(array('job' => 'job'), 'job.job_code = share.share_reference and job_deleted = 0')
							->joinLeft(array('areapost' => 'areapost'), 'areapost.areapost_code = job.areapost_code')
							->joinLeft('_comm', "_comm.item_code = share.share_code and _comm._comm_reference = 'SHARE'")
							->where('share.share_code = ?', $code)
							->where('job_deleted = 0');		
				break;			
			case 'INTERNSHIP' :				
				$select = $this->_db->select()	
							->from(array('share' => 'share'))
							->joinLeft(array('participant' => 'participant'), 'participant.participant_code = share.participant_code and participant_deleted = 0')
							->joinLeft(array('internship' => 'internship'), 'internship.internship_code = share.share_reference')
							->joinLeft('_comm', "_comm.item_code = share.share_code and _comm._comm_reference = 'SHARE'")
							->where('share.share_code = ?', $code)
							->where('internship_deleted = 0');		
				break;
			case 'CAREER' :				
				$select = $this->_db->select()	
							->from(array('share' => 'share'))
							->joinLeft(array('participant' => 'participant'), 'participant.participant_code = share.participant_code and participant_deleted = 0')
							->joinLeft(array('career' => 'career'), 'career.career_code = share.share_reference')
							->joinLeft('_comm', "_comm.item_code = share.share_code and _comm._comm_reference = 'SHARE'")
							->where('share.share_code = ?', $code)
							->where('career_deleted = 0');		
				break;
			case 'EXAM' :				
				$select = $this->_db->select()	
							->from(array('share' => 'share'))
							->joinLeft(array('participant' => 'participant'), 'participant.participant_code = share.participant_code and participant_deleted = 0')
							->joinLeft(array('exam' => 'exam'), 'exam.exam_code = share.share_reference')
							->joinLeft(array('subject' => 'subject'), 'subject.subject_code = exam.subject_code')
							->joinLeft('_comm', "_comm.item_code = share.share_code and _comm._comm_reference = 'SHARE'")
							->where('share.share_code = ?', $code)
							->where('exam_deleted = 0');		
				break;				
			default :
				$select = $this->_db->select()	
							->from(array('share' => 'share'))
							->joinLeft(array('participant' => 'participant'), 'participant.participant_code = share.participant_code and participant_deleted = 0')
							->joinLeft('_comm', "_comm.item_code = share.share_code and _comm._comm_reference = 'SHARE'")
							->where('share.share_code = ?', $code);		
				break;				
		}
		
		$result = $this->_db->fetchRow($select);
		return ($result == false) ? false : $result = $result;	      
	}
	
	public function getAll($type = null, $where = 'share.share_name != \'\'', $order = 'share.share_name desc') {
		
		switch($type) {			
			case 'JOB' :
				$select = $this->_db->select()	
							->from(array('share' => 'share'))
							->joinLeft(array('participant' => 'participant'), 'participant.participant_code = share.participant_code')
							->joinLeft(array('job' => 'job'), 'job.job_code = share.share_reference and job_deleted = 0')
							->joinLeft(array('areapost' => 'areapost'), 'areapost.areapost_code = job.areapost_code')
							->joinLeft('_comm', "_comm.item_code = share.share_code and _comm._comm_reference = 'SHARE'")
							->where('share.share_type = ?', $type)
							->where('job_deleted = 0');		
				break;			
			case 'INTERNSHIP' :				
				$select = $this->_db->select()	
							->from(array('share' => 'share'))
							->joinLeft(array('participant' => 'participant'), 'participant.participant_code = share.participant_code')
							->joinLeft(array('internship' => 'internship'), 'internship.internship_code = share.share_reference')
							->joinLeft('_comm', "_comm.item_code = share.share_code and _comm._comm_reference = 'SHARE'")
							->where('share.share_type = ?', $type)
							->where('internship_deleted = 0');		
				break;
			case 'CAREER' :				
				$select = $this->_db->select()	
							->from(array('share' => 'share'))
							->joinLeft(array('participant' => 'participant'), 'participant.participant_code = share.participant_code and participant_deleted = 0')
							->joinLeft(array('career' => 'career'), 'career.career_code = share.share_reference')
							->joinLeft('_comm', "_comm.item_code = share.share_code and _comm._comm_reference = 'SHARE'")
							->where('share.share_type = ?', $type)
							->where('career_deleted = 0');		
				break;
			case 'EXAM' :				
				$select = $this->_db->select()	
							->from(array('share' => 'share'))
							->joinLeft(array('participant' => 'participant'), 'participant.participant_code = share.participant_code and participant_deleted = 0')
							->joinLeft(array('exam' => 'exam'), 'exam.exam_code = share.share_reference')
							->joinLeft(array('subject' => 'subject'), 'subject.subject_code = exam.subject_code')
							->joinLeft('_comm', "_comm.item_code = share.share_code and _comm._comm_reference = 'SHARE'")
							->where('share.share_type = ?', $type)
							->where('exam_deleted = 0');		
				break;				
			default : return false;			
		}
		
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;	  
	}
	
	public function validateEmail($string) {
		if(preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($string))) {
			return trim($string);
		} else {
			return '';
		}
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getCode($reference)
	{
		$select = $this->_db->select()	
						->from(array('share' => 'share'))	
					   ->where('share_code = ?', $reference)
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