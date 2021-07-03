<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard recruiters functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */
 
// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_recruiter extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'recruiter';
	protected $_primary = 'pk_recruiter_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['recruiter_added'])) {
            $data['recruiter_added'] = date('Y-m-d H:i:s');
        }
        
        if (empty($data['recruiter_active'])) {
            $data['recruiter_active'] = 0;
        }

        if (empty($data['recruiter_deleted'])) {
            $data['recruiter_deleted'] = 0;
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
        if (empty($data['recruiter_updated'])) {
            $data['recruiter_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($id) {
		return $this->delete('pk_recruiter_id = '.$id);		
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
	 * get all recruiters ordered by column name
	 * example: $collection->getAllrecruiters('recruiter_title');
	 * @param string $order
     * @return object
	 */
	public function getAllRecruiter($where = "recruiter_name !=''")
	{
		$select = $this->select()
					   ->where($where)
					   ->where('recruiter_active = 1 AND recruiter_deleted = 0');
					   					   
		return $this->fetchAll($select);

	}
	/**
	 * Get all recruiters as pairs.
	 * example: $recruiters = $collection->recruiterPairs();
     * @return array
	 */
	 public function recruiterPairs() {
		$select = $this->select()
					   ->from(array('a' => 'recruiter'), array('a.pk_recruiter_id', 'a.recruiter_name'))
					   ->where('recruiter_active = 1 AND recruiter_deleted = 0')
					   ->order('recruiter_name ASC');
		return $this->_db->fetchPairs($select);
	}	 		
	
	/**
	 * get all recruiters from year
	 * example: $recruiters2008 = $collection->getByYear('2008-04-01');
	 * @param string $date
     * @return object
	 */
	public function getByYear($date)
	{
		$datetime = strtotime($date);
		$year = date('Y', $datetime);
		
		$select = $this->select()
                  ->order('recruiter_added DESC')
				  ->where('year(recruiter_added) = ?', $year);
				 	   
		return $this->fetchAll($select);
		
	}
		
	/**
	 * get recruiter by email
 	 * @param string email
     * @return array
	 */
	public function getByEmail($email)
	{
		$select = $this->_db->select() 
					   ->from(array('recruiter' => 'recruiter'))
					   ->joinLeft('areamap', 'areaMap.fkAreaId = recruiter.fkAreaId')						
					   ->where('recruiter_email = ?', $email)
					   ->where('recruiter_deleted = 0')
					   ->limit(1);	
			   
		return $this->_db->fetchAll($select);
	}
	
	/**
	 * check recruiter login
 	 * @param string email
	 * @param string password
     * @return array
	 */	
	public function checkLogin($email, $password) {
		$select = $this->select() 
					   ->where('recruiter_email = ?', $email)
					   ->where('recruiter_password = ?', $password)
					   ->where('recruiter_deleted = 0 AND recruiter_active = 1')
					   ->limit(1);	
				   
		return $this->fetchAll($select)->toArray();	
	}
	
	/**
	 * get recruiter by reference
 	 * @param integer reference
     * @return array
	 */
	public function getByReference($reference)
	{
		$select = $this->select() 
					   ->where('recruiter_reference = ?', $reference)
					   ->where('recruiter_deleted = 0')
					   ->limit(1);					   
		return $this->fetchAll($select)->toArray();
	}	
	
	public function getByReferenceRegistration($reference) {
		$select = $this->select() 
					   ->where('recruiter_reference = ?', $reference)
					   ->where('recruiter_deleted = 0 AND recruiter_active = 0')
					   ->limit(1);					   
		return $this->fetchAll($select)->toArray();
	}	
	
	/**
	 * get recruiter by reference
 	 * @param integer reference
     * @return array
	 */
	public function createReference()
	{
		/* Get the last inserted id. */
		$select = $this->_db->fetchOne('SELECT pk_recruiter_id FROM recruiter ORDER BY pk_recruiter_id DESC LIMIT 1');			
		$reference = (4000 + (int)$select);
		/* We are going to start counting at 4000 */
		return $reference; 
	}	
	/**
	 * get recruiter by recruiter Account Id
 	 * @param string recruiter id
     * @return object
	 */
	public function getByrecruiterId( $id )
	{
		$select = $this->select() 
					   ->where('pk_recruiter_id = ?', $id)
					   ->where('recruiter_active = 1 AND recruiter_deleted = 0')
					   ->limit(1);
					   
		return $this->fetchAll($select)->toArray();

	}
	
	/**
	 * get careers ordered by column name as pagination object
	 * example: $careersData = $careers->getPaginatedNews('career_recruiter_active = 1 AND career_deleted = 0','career.career_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getPaginatedRecruiter($where = NULL, $order = NULL, $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
			$select = $this->select()
					       ->order($order)
					       ->where($where);
					   
	    
		///$sql = $selectedrecruiters->__toString();
		//echo $sql; 
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