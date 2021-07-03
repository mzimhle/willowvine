<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard enquirys functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */
 
// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_enquiry extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'enquiry';
	protected $_primary = 'pk_enquiry_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['enquiry_added'])) {
            $data['enquiry_added'] = date('Y-m-d H:i:s');
        }
        
        if (empty($data['enquiry_active'])) {
            $data['enquiry_active'] = 1;
        }

        if (empty($data['enquiry_deleted'])) {
            $data['enquiry_deleted'] = 0;
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
        if (empty($data['enquiry_updated'])) {
            $data['enquiry_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($id) {
		return $this->delete('pk_enquiry_id = '.$id);		
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
	 * get enquiry by enquiry Account Id
 	 * @param string enquiry id
     * @return object
	 */
	public function getByEnquiryId($id)
	{		   				
			$select = $this->_db->select()	
							->from(array('enquiry' => 'enquiry'))
							->joinRight('areaMap', 'areaMap.fkAreaId = enquiry.fkAreaId')
							->where('pk_enquiry_id = ?', $id)
							->where('enquiry_deleted = 0')
							->limit(1);								
		return $this->_db->fetchAll($select);

	}
	
	/**
	 * get by jobSeeker reference
 	 * @param int jobSeeker reference
     * @return array
	 */
	public function getByReference($reference)
	{
		$select = $this->select() 
					   ->where('enquiry_reference = ?', $reference)
					   ->where('enquiry_deleted = 0');
		return $this->fetchAll($select)->toArray();

	}	
	/**
	 * get careers ordered by column name as pagination object
	 * example: $careersData = $careers->getPaginatedNews('career_enquiry_active = 1 AND career_deleted = 0','career.career_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getPaginatedenquiry($where = NULL, $order = NULL, $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
			if($where == '') $where = 'enquiry_reference != ""';
			
			$select = $this->_db->select()	
							->from(array('enquiry' => 'enquiry'))
							->joinRight('areaMap', 'areaMap.fkAreaId = enquiry.fkAreaId')
							->order($order)
							->where($where);
					   
	    
		///$sql = $selectedenquirys->__toString();
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