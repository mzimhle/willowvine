<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard internshipShares functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */
 
// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_internshipShare extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'internshipShare';
	protected $_primary = 'pk_internshipShare_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['internshipShare_added'])) {
            $data['internshipShare_added'] = date('Y-m-d H:i:s');
        }
        
        if (empty($data['internshipShare_active'])) {
            $data['internshipShare_active'] = 1;
        }

        if (empty($data['internshipShare_deleted'])) {
            $data['internshipShare_deleted'] = 0;
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
        if (empty($data['internshipShare_updated'])) {
            $data['internshipShare_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($id) {
		return $this->delete('pk_internshipShare_id = '.$id);		
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
	public function getAlljobShares($where = "internshipShare_name !=''")
	{
		$select = $this->select()
					   ->where($where)
					   ->where('internshipShare_active = 1 AND internshipShare_deleted = 0');					   
					   
		return $this->fetchAll($select);

	} 		
		

	/**
	 * get jobShare by jobShare Account Id
 	 * @param string jobShare id
     * @return object
	 */
	public function getByInternshipShareId( $id )
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
	public function getPaginatedInternshipShare($where = NULL, $order = NULL, $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
			$select = $this->_db->select()	
							->from(array('internshipShare' => 'internshipShare'))
							->joinRight('internships', 'internships.pk_internship_id = internshipShare.fk_internship_id')					   
							->joinRight('section', 'section.pk_section_id = internships.fk_section_id')	
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