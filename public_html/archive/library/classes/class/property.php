<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard propertys functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */
 
// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_property extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'property';
	protected $_primary = 'pk_property_id';	
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['property_created'])) {
            $data['property_created'] = date('Y-m-d H:i:s');
        }
        
		if (empty($data['property_updated'])) {
            $data['property_updated'] = date('Y-m-d H:i:s');
        }

		if (empty($data['property_active'])) {
            $data['property_active'] = 1;
        }
        
		if (empty($data['property_deleted'])) {
            $data['property_deleted'] = 0;
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
        if (empty($data['property_updated'])) {
            $data['property_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($id) {
		return $this->delete('pk_property_id = '.$id);		
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
	 * Get recent 10 propertys.
	 * example: $collection->getRecentpropertys(10);
	 * @param number $limite
     * @return array
	 */
	public function getRandom($limit = 10)
	{	
		$select = $this->select()	
					   ->where('property_active = 1 AND property_deleted = 0')
					   ->order('RAND(), property_created DESC')
					   ->limit($limit);
					   
		return $this->fetchAll($select);
	}
	
	/**
	 * get all propertys ordered by column name
	 * example: $collection->getAllpropertys('property_title');
	 * @param string $order
     * @return object
	 */
	public function getAllpropertys($order = 'property_created', $where = 'property_active=1')
	{	
		
		global $zfsession;
		
		$select = $this->select()	
					   ->where($where)
					   ->where('property_active = 1 AND property_deleted = 0')
					   ->order($order);
					   
		return $this->fetchAll($select)->toArray();

	}

	/**
	 * get all propertys from that month in current year
	 * example: $aprilpropertys = $collection->getByMonth('2009-04-01');
	 * @param string $date
     * @return object
	 */
	public function getByMonth($date)
	{
		global $zfsession;
		
		$datetime = strtotime($date);
		$month = date('n', $datetime);
		$year = date('Y', $datetime);

		$select = $this->_db->select()
				  ->from(array('property' => 'property'))
                  ->order('property_created DESC')
				  ->where('month(property_created) = ?', $month)
				  ->where('year(property_created) = ?', $year)
				  ->where('property_area LIKE "%|'.$zfsession->userCity['fk_country_id'].'|'.$zfsession->userCity['fk_province_id'].'|%"');
		return $this->fetchAll($select);
		
	}
	
	
	/**
	 * get all propertys from year
	 * example: $propertys2008 = $collection->getByYear('2008-04-01');
	 * @param string $date
     * @return object
	 */
	public function getByYear($date)
	{
		global $zfsession;
		
		$datetime = strtotime($date);
		$year = date('Y', $datetime);
		
		$select = $this->_db->select()
				  ->from(array('property' => 'property'))
                  ->order('property_created DESC')
				  ->where('year(property_created) = ?', $year);
		return $this->fetchAll($select);
		
	}
	
	/**
	 * get property by property reference
 	 * @param int property reference
     * @return array
	 */
	public function getReferences( $reference )
	{
		$select = $this->_db->select()
					->from(array('property' => 'property'))		
					->joinLeft('areaMap', 'areaMap.fkAreaId = property.fkAreaId', array('areaMap_name', 'areaMap_path'))
					->where('property_reference IN (?)', $reference)
					->where('property_active = 1 AND property_deleted = 0')
					->limit(1);

		return $this->_db->fetchAll($select);

	}	
	
	/**
	 * Get property count by area
	 * example: $table->propertyCoutByArea();
	 * @param string city
	 * @return array
	 */
	 
	public function propertyCoutByArea() {
		
		global $zfsession;
		
		$select = $this->_db->select()
						->from(array('property' => 'property'), array('fkAreaId', 'COUNT(pk_property_id) AS property_count'))
						->joinLeft('areaMap', 'areaMap.fkAreaId = property.fkAreaId', array('areaMap_name', 'fkAreaId'))
						->where('property.property_active = 1 AND property.property_deleted = 0')
						->group('fkAreaId')
						->order('property_count DESC');
						
		return $this->_db->fetchAll($select);
	}		
	
	/**
	 * Get property count by area + city
	 * example: $table->propertyCoutByArea();
	 * @param string city
	 * @return array
	 */
	 
	public function countByArea() {
	
		global $zfsession;
			
		$select = $this->select()
						->from(array('property' => 'property'), array('property_area', 'COUNT(pk_property_id) AS property_count'))
						->joinLeft('areaMap', 'areaMap.pk_area_id = property.fk_area_id', array('area_Name', 'pk_area_id'))
						->where('property.property_active = 1 AND property.property_deleted = 0')
						->group('property_area')
						->order('property_count DESC');
						
		return $this->_db->fetchAll($select);
	}			
	/**
	 * get careers ordered by column name as pagination object
	 * example: $careersData = $careers->getPaginatedNews('career_property_active = 1 AND career_deleted = 0','career.career_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getPaginatedproperty($where = 'property_title != ""', $order = NULL, $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
			global $zfsession;
					
			if($where == '') $where = 'property_title != ""';
			
			$select = $this->_db->select()
							->from(array('property' => 'property'))
							->joinRight('areaMap', 'areaMap.fkAreaId = property.fkAreaId', array('areaMap_path', 'areaMap_name'))
						   ->where($where)						   				  
						   ->where("property_deleted = 0 AND property_active = 1")
						   ->order($order);
						   
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