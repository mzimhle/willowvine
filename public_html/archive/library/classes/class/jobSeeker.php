<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard jobSeekers functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */
 
// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_jobSeeker extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'jobSeeker';
	protected $_primary = 'pk_jobSeeker_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['jobSeeker_added'])) {
            $data['jobSeeker_added'] = date('Y-m-d H:i:s');
        }
        
        if (empty($data['jobSeeker_active'])) {
            $data['jobSeeker_active'] = 0;
        }

        if (empty($data['jobSeeker_deleted'])) {
            $data['jobSeeker_deleted'] = 0;
        }
		
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
        if (empty($data['jobSeeker_updated'])) {
            $data['jobSeeker_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($id) {
		return $this->delete('pk_jobSeeker_id = '.$id);		
	}
	
	 /**
	 * find by id function
	 * example: $rowset = $table->getById('5, 4, 10, 12');
	 * @param string $id 
	 * OR 
	 * @param array $idList
     * @return object
	 */
	public function getById($idList) {
		return $this->find($idList);
	}
	
	
	/**
	 * get all jobSeekers ordered by column name
	 * example: $collection->getAlljobSeekers('jobSeeker_title');
	 * @param string $order
     * @return object
	 */
	public function getAlljobSeekers($where = "jobSeeker_name !=''")
	{
		$select = $this->select()
					   ->where($where)
					   ->where('jobSeeker_active = 1 AND jobSeeker_deleted = 0');
					   					   
		return $this->fetchAll($select);
	}
	
	/**
	 * Get all jobSeekers as pairs.
	 * example: $jobSeekers = $collection->jobSeekerPairs();
     * @return array
	 */
	 public function jobSeekerPairs() {
		$select = $this->select()
					   ->from(array('a' => 'jobSeeker'), array('a.pk_jobSeeker_id', 'a.jobSeeker_name'))
					   ->where('jobSeeker_active = 1 AND jobSeeker_deleted = 0')
					   ->order('jobSeeker_name ASC');
		return $this->_db->fetchPairs($select);
	}	 		
	
	/**
	 * get all jobSeekers from year
	 * example: $jobSeekers2008 = $collection->getByYear('2008-04-01');
	 * @param string $date
     * @return object
	 */
	public function getByYear($date)
	{
		$datetime = strtotime($date);
		$year = date('Y', $datetime);
		
		$select = $this->select()
                  ->order('jobSeeker_added DESC')
				  ->where('year(jobSeeker_added) = ?', $year);
				 	   
		return $this->fetchAll($select);
		
	}
		
	/**
	 * get jobSeeker by email
 	 * @param string email
     * @return array
	 */
	public function getByEmail($email, $where = 'jobSeeker_deleted = 0')
	{
		$select = $this->_db->select()		
					   ->from(array('jobSeeker' => 'jobSeeker'))
					   ->joinLeft('areaMap', 'areaMap.fkAreaId = jobSeeker.fkAreaId')
					   ->where('jobSeeker_email = ?', $email)
					   ->where('jobSeeker_deleted = 0')
						->where('twitter_uid = \'\' OR twitter_uid IS NULL')
					   ->where($where)
					   ->limit(1);	
			   
		return $this->_db->fetchAll($select);
	}
	
	public function checkFB($email, $id)
	{
		$select = $this->select()
				  ->where('jobSeeker_email = ?', $email)				 	   
				  ->where('fb_user_id = ?', $id)				 	   
				  ->where('jobSeeker_deleted = 0');
		return $this->fetchRow($select);
	}	
	
	public function checkGoogle($email)
	{
		$select = $this->select()
				  ->where('jobSeeker_email = ?', $email)				 	   
				  ->where('google_identity != \'\' OR google_identity != NULL')				 	   
				  ->where('jobSeeker_deleted = 0 AND jobSeeker_active = 1');

		return $this->fetchAll($select)->toArray();
	}	
	
	public function checkTwitter($id)
	{
		$select = $this->select()			 	   
				  ->where('twitter_uid = ?', $id)				 	   
				  ->where('jobSeeker_deleted = 0');
		return $this->fetchRow($select);
	}
	
	public function getByTwitterId($id)
	{
		$select = $this->_db->select()		
					   ->from(array('jobSeeker' => 'jobSeeker'))
					   ->joinLeft('areaMap', 'areaMap.fkAreaId = jobSeeker.fkAreaId')
					   ->where('twitter_uid = ?', $id)
					   ->where('jobSeeker_deleted = 0')
					   ->limit(1);	
			   
		return $this->_db->fetchAll($select);
	}	
	/**
	 * get jobSeeker by email
 	 * @param string email
     * @return array
	 */
	public function getJobSeekerDetails($reference)
	{
		$select = $this->_db->select()		
					   ->from(array('jobSeeker' => 'jobSeeker'))
					   ->joinLeft('areaMap', 'areaMap.fkAreaId = jobSeeker.fkAreaId')
					   ->where('jobSeeker_reference = ?', $reference)
					   ->where('jobSeeker_deleted = 0')
					   ->limit(1);	
			   
		return $this->_db->fetchAll($select);
	}
	
	/**
	 * check jobSeeker login
 	 * @param string email
	 * @param string password
     * @return array
	 */	
	public function checkLogin($email, $password) {
		$select = $this->select() 
					   ->where('jobSeeker_email = ?', $email)
					   ->where('jobSeeker_password = ?', $password)
					   ->where('jobSeeker_deleted = 0 AND jobSeeker_active = 1')
					   ->where('fb_user_id = \'\' OR fb_user_id IS NULL')
					   ->where('twitter_uid = \'\' OR twitter_uid IS NULL')
					   ->limit(1);	

		return $this->fetchAll($select)->toArray();	
	}
	
	public function getByHashCode($code) {
		$select = $this->select() 
					   ->where('jobSeeker_registrationCode = ?', $code)
					   ->where('jobSeeker_deleted = 0 AND jobSeeker_active = 0')
					   ->limit(1);	
				   
		return $this->fetchAll($select)->toArray();		
	}
	/**
	 * get jobSeeker by reference
 	 * @param integer reference
     * @return array
	 */
	public function getByReference($reference)
	{
		$select = $this->select() 
					   ->where('jobSeeker_reference = ?', $reference)
					   ->where('jobSeeker_deleted = 0')
					   ->limit(1);					   
		return $this->fetchAll($select)->toArray();
	}	
	
	/**
	 * get jobSeeker by reference
 	 * @param integer reference
     * @return array
	 */
	public function createReference()
	{
		/* Get the last inserted id. */
		$select = $this->_db->fetchOne('SELECT pk_jobSeeker_id FROM jobSeeker ORDER BY pk_jobSeeker_id DESC LIMIT 1');			
		$reference = (1000 + (int)$select);
		/* We are going to start counting at 1000 */
		return $reference; 
	}	
	/**
	 * get jobSeeker by jobSeeker Account Id
 	 * @param string jobSeeker id
     * @return object
	 */
	public function getByjobSeekerId( $id )
	{
		$select = $this->select() 
					   ->where('pk_jobSeeker_id = ?', $id)
					   ->where('jobSeeker_active = 1 AND jobSeeker_deleted = 0')
					   ->limit(1);
					   
		return $this->fetchAll($select)->toArray();

	}
	
	/**
	 * get careers ordered by column name as pagination object
	 * example: $careersData = $careers->getPaginatedNews('career_jobSeeker_active = 1 AND career_deleted = 0','career.career_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getAllJobSeeker($where = 'jobSeeker_deleted = 0', $order = 'jobSeeker.jobSeeker_lastLogin DESC') {
		$select = $this->_db->select()		
					   ->from(array('jobSeeker' => 'jobSeeker'))
					   ->joinLeft('areaMap', 'areaMap.fkAreaId = jobSeeker.fkAreaId')
						->where($where)
						->order($order);
						
        $result = $this->_db->fetchAll($select);
        return ($result == false) ? false : $result = $result;
	}
}
?>