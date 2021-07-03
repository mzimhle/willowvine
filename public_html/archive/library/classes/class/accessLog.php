<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard enquirys functions, both singleton and collection
 * Created: 17 July 2012
 * Author: Mzimhle Mosiwe
 */
 
// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_accessLog extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'accessLog';
	protected $_primary = 'pk_accessLog_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['accessLog_added'])) {
            $data['accessLog_added'] = date('Y-m-d H:i:s');
        }
        
        if (empty($data['accessLog_active'])) {
            $data['accessLog_active'] = 1;
        }

        if (empty($data['accessLog_deleted'])) {
            $data['accessLog_deleted'] = 0;
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
        if (empty($data['accessLog_updated'])) {
            $data['accessLog_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($id) {
		return $this->delete('pk_accessLog_id = '.$id);		
	}
	
	/**
	 * get accessLog by accessLog Account Id
 	 * @param string accessLog id
     * @return array
	 */
	public function getByaccessLogId($id)
	{		   				
			$select = $this->_db->select()	
							->from(array('accessLog' => 'accessLog'))
							->where('pk_accessLog_id = ?', $id)
							->where('accessLog_deleted = 0')
							->limit(1);								
		return $this->_db->fetchAll($select);
	}
	
	/**
	 * get accessLog by accessLog Account Id
 	 * @param string accessLog id
     * @return array
	 */
	public function getBySessionId($accessLog_sessionId)
	{		   				
			$select = $this->select()	
							->from(array('accessLog' => 'accessLog'))
							->where('accessLog_sessionId = ?', $accessLog_sessionId)
							->limit(1);					
		return $this->fetchRow($select);

	}	
	/**
	 * get careers ordered by column name as pagination object
	 * example: $careersData = $careers->getPaginatedNews('career_accessLog_active = 1 AND career_deleted = 0','career.career_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getPaginated($where = NULL, $order = NULL, $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
			if($where == '') $where = 'accessLog_areaName != NULL';
			
			$select = $this->_db->select()	
							->from(array('accessLog' => 'accessLog'))
							->order($order)
							->where($where);
					   
	    
		///$sql = $selectedaccessLogs->__toString();
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