<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard jobShares functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */
 
// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_jobShare extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'jobShare';
	protected $_primary = 'pk_jobShare_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['jobShare_added'])) {
            $data['jobShare_added'] = date('Y-m-d H:i:s');
        }
        
        if (empty($data['jobShare_active'])) {
            $data['jobShare_active'] = 1;
        }

        if (empty($data['jobShare_deleted'])) {
            $data['jobShare_deleted'] = 0;
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
        if (empty($data['jobShare_updated'])) {
            $data['jobShare_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($id) {
		return $this->delete('pk_jobShare_id = '.$id);		
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
	 * get all jobShares ordered by column name
	 * example: $collection->getAlljobShares('jobShare_title');
	 * @param string $order
     * @return object
	 */
	public function getAlljobShares($where = "jobShare_name !=''")
	{
		$select = $this->select()
					   ->where($where)
					   ->where('jobShare_active = 1 AND jobShare_deleted = 0');
					   
					   
		return $this->fetchAll($select);

	} 		
	
	/**
	 * get all jobShares from year
	 * example: $jobShares2008 = $collection->getByYear('2008-04-01');
	 * @param string $date
     * @return object
	 */
	public function getByYear($date)
	{
		$datetime = strtotime($date);
		$year = date('Y', $datetime);
		
		$select = $this->select()
                  ->order('jobShare_added DESC')
				  ->where('year(jobShare_added) = ?', $year);
				 	   
		return $this->fetchAll($select);
		
	}
		

	/**
	 * get jobShare by jobShare Account Id
 	 * @param string jobShare id
     * @return object
	 */
	public function getByjobShareId( $id )
	{
		$select = $this->select() 
					   ->where('pk_jobShare_id = ?', $id)
					   ->where('jobShare_active = 1 AND jobShare_deleted = 0')
					   ->limit(1);
					   
		return $this->fetchAll($select)->toArray();

	}
	
		
	/**
	 * get careers ordered by column name as pagination object
	 * example: $careersData = $careers->getPaginatedNews('career_jobShare_active = 1 AND career_deleted = 0','career.career_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getPaginatedjobShare($where = NULL, $order = NULL, $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{

			$select = $this->_db->select()	
							->from(array('jobShare' => 'jobShare'))
							->joinRight('job', 'job.job_reference = jobShare.fkJobReference')					   
							->joinRight('section', 'section.pk_section_id = job.fk_section_id')	
	    					->order($order)
							->where($where);
							
		///$sql = $selectedjobShares->__toString();
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