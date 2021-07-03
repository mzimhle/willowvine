<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard sections functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */
 
// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_shortList extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'shortList';
	protected $_primary = 'pk_shortList_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['shortList_added'])) {
            $data['shortList_added'] = date('Y-m-d H:i:s');
        }

        if (empty($data['shortList_deleted'])) {
            $data['shortList_deleted'] = 0;
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
        if (empty($data['shortList_updated'])) {
            $data['shortList_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($jobSeeker) {
		return $this->delete('jobSeeker_reference = '.$jobSeeker);		
	}
	
	public function removeJob($jobSeeker, $job) {
		return $this->delete('jobSeeker_reference = '.$jobSeeker.' AND job_reference = '.$job);		
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
	 * get all shortLists ordered by column name
	 * example: $collection->getAllshortLists('shortList_title');
	 * @param string $order
     * @return object
	 */	
	
	public function getshortListed($jobSeeker) 
	{
		$select = $this->select() 
					   ->where('job_reference = ?', $jobSeeker)
					   ->where('shortList_deleted = 0');
					   
		return $this->fetchAll($select)->toArray();

	}

	/**
	 * get careers ordered by column name as pagination object
	 * example: $careersData = $careers->getPaginatedNews('career_jobApplication_active = 1 AND career_deleted = 0','career.career_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getPaginatedShortList($where = 'jobSeeker_reference = -1', $order = 'shortList_added DESC', $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
			$select = $this->_db->select()	
							->from(array('shortList' => 'shortList'))
							->joinLeft('job', 'job.job_reference = shortList.job_reference')
							->joinLeft('section', 'section.pk_section_id = job.fk_section_id')
							->order($order)
							->where($where);
					   	    
		///$sql = $selectedjobApplications->__toString();
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