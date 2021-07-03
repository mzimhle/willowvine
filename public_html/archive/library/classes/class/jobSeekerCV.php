<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard jobSeekerCVs functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */
 
// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_jobSeekerCV extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'jobSeekerCV';
	protected $_primary = 'pk_jobSeekerCV_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['jobSeekerCV_added'])) {
            $data['jobSeekerCV_added'] = date('Y-m-d H:i:s');
        }
        
        if (empty($data['jobSeekerCV_active'])) {
            $data['jobSeekerCV_active'] = 1;
        }

        if (empty($data['jobSeekerCV_deleted'])) {
            $data['jobSeekerCV_deleted'] = 0;
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
        if (empty($data['jobSeekerCV_updated'])) {
            $data['jobSeekerCV_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($id) {
		return $this->delete('pk_jobSeekerCV_id = '.$id);		
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
	 * get jobSeekerCV by jobSeekerCV Account Id
 	 * @param string jobSeekerCV id
     * @return object
	 */
	public function getByjobSeekerCVId( $id )
	{
		$select = $this->select() 
					   ->where('pk_jobSeekerCV_id = ?', $id)
					   ->where('jobSeekerCV_active = 1 AND jobSeekerCV_deleted = 0')
					   ->limit(1);
					   
		return $this->fetchAll($select)->toArray();

	}
	
	/**
	 * Get all the user's CV's
 	 * @param interger user reference
     * @return array
	 */
	public function getJobSeekerReference($reference)
	{
		$select = $this->select() 
					   ->where('fkJobSeekerReference = ?', $reference)
					   ->where('jobSeekerCV_deleted = 0');
					   
		return $this->fetchAll($select)->toArray();

	}	
	/**
	 * get by jobSeeker reference
 	 * @param int jobSeeker reference
     * @return array
	 */
	public function getByjobSeekerCVReference($reference)
	{
		$select = $this->select() 
					   ->where('fkjobSeekerReference = ?', $reference)
					   ->where('jobSeekerCV_active = 1 AND jobSeekerCV_deleted = 0');
		return $this->fetchAll($select)->toArray();

	}	
	/**
	 * get careers ordered by column name as pagination object
	 * example: $careersData = $careers->getPaginatedNews('career_jobSeekerCV_active = 1 AND career_deleted = 0','career.career_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getPaginatedjobSeekerCV($where = NULL, $order = NULL, $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
			if($where == '') $where = 'jobSeekerCV_cvContent != ""';
			
			$select = $this->_db->select()	
							->from(array('jobSeekerCV' => 'jobSeekerCV'))
							->joinRight('jobSeeker', 'jobSeeker.jobSeeker_reference = jobSeekerCV.fkJobSeekerReference')
							->order($order)
							->where($where);
					   
	    
		///$sql = $selectedjobSeekerCVs->__toString();
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