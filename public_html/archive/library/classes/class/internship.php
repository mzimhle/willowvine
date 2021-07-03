<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard intership functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */
 
// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_internship extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'internships';
	protected $_primary = 'pk_internship_id';	
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['internship_added'])) {
            $data['internship_added'] = date('Y-m-d H:i:s');
        }
        
		if (empty($data['internship_updated'])) {
            $data['internship_updated'] = date('Y-m-d H:i:s');
        }
        
		if (empty($data['internship_deleted'])) {
            $data['internship_deleted'] = 0;
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
        if (empty($data['internship_updated'])) {
            $data['internship_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($id) {
		return $this->delete('pk_internship_id = '.$id);		
	}
	
	 /**
	 * find by id function
	 * example: $rowset = $table->getById('5, 4, 10, 12');
	 * @param string $id 
	 * OR 
	 * @param array $idList
     * @return object
	 */
	 /*
	public function getById($idList) {
		return $this->find($idList);
	}
	*/
	
	/**
	 * Get recent 10 internship.
	 * example: $collection->getRecentinternship(10);
	 * @param number $limite
     * @return array
	 */
	public function getRecentinternship($limit = 10)
	{	
		$select = $this->_db->select()	
						->from(array('internships' => 'internships'))
					->joinLeft('section', 'section.pk_section_id = internships.fk_section_id', array('pk_section_id', 'section_name', 'section_urlName'))
					->joinLeft('areaMap', 'areaMap.fkAreaId = internships.fk_area_id')
					   ->where('internship_active = 1 AND internship_deleted = 0')
					   ->order('RAND(), internship_added DESC')
					   ->limit($limit);
					   
		return $this->_db->fetchAll($select);
	}
	
	public function getLatest($limit = 10) {
		$select = $this->_db->select()	
						->from(array('internships' => 'internships'))
						->joinLeft('section', 'section.pk_section_id = internships.fk_section_id', array('pk_section_id', 'section_name', 'section_urlName'))
						->joinLeft('areaMap', 'areaMap.fkAreaId = internships.fk_area_id')
					    ->where('internship_active = 1 AND internship_deleted = 0')
					    ->order('internship_added DESC')
					    ->limit($limit);
					   
		return $this->_db->fetchAll($select);	
	}
	/**
	 * get all internship ordered by column name
	 * example: $collection->getAllinternship('internship_title');
	 * @param string $order
     * @return object
	 */
	public function getAllinternship($order = 'internship_added', $where = 'internship_active=1')
	{	
		
		$select = $this->_db->select()	
						->from(array('internships' => 'internships'))
					->joinLeft('section', 'section.pk_section_id = internships.fk_section_id', array('pk_section_id', 'section_name', 'section_urlName'))
					->joinLeft('areaMap', 'areaMap.fkAreaId = internships.fk_area_id')
					   ->where('internship_active = 1 AND internship_deleted = 0');
					   
		return $this->_db->fetchAll($select);
					   

	}

	/**
	 * get internship by internship Account Id
 	 * @param string internship id
     * @return object
	 */
	public function getByInternshipId( $id )
	{
		$select = $this->_db->select()
					->from(array('internships' => 'internships'))
					->joinLeft('section', 'section.pk_section_id = internships.fk_section_id', array('pk_section_id', 'section_name', 'section_urlName'))
					->joinLeft('areaMap', 'areaMap.fkAreaId = internships.fk_area_id')
					->where('internship_active = 1 AND internship_deleted = 0')				
					->where('pk_internship_id = ?', $id)
					->limit(1);
		return $this->_db->fetchRow($select);

	}	
					/**
	 * get internship by internship Account Id
 	 * @param string internship id
     * @return object
	 */
	public function getByInternshipIdAdmin( $id )
	{
		$select = $this->_db->select()
					->from(array('internships' => 'internships'))
					->joinLeft('section', 'section.pk_section_id = internships.fk_section_id', array('pk_section_id', 'section_name', 'section_urlName'))
					->joinLeft('areaMap', 'areaMap.fkAreaId = internships.fk_area_id')		
					->where('pk_internship_id = ?', $id)
					->limit(1);
		return $this->_db->fetchRow($select);

	}	
	
	public function checkInternshipExists($title) {
		return $this->_db->fetchOne("SELECT internship_title FROM internships WHERE replace(lower(internship_title), ' ', '') = replace(lower('".$title."'), ' ', '');");		
	}		
	
	/**
	 * get internship ordered by column name as pagination object
	 * example: $internshipData = $internship->getPaginatedNews('internship_internship_active = 1 AND internship_deleted = 0','internships.internship_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getPaginatedinternship($where = 'internship_title != ""', $order = NULL, $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
					
			if($where == '') $where = 'internship_title != ""';
			
			$select = $this->_db->select()
							->from(array('internships' => 'internships'))
							->joinRight('section', 'section.pk_section_id = internships.fk_section_id', array('section_name', 'section_urlName'))
						   ->where($where)						   				  
						   ->where("internship_deleted = 0 AND internship_active = 1")
						   ->order($order);
						   
		$paginator = Zend_Paginator::factory($select);
		$paginator->setCurrentPageNumber($page);
		$paginator->setItemCountPerPage($perPage);
		$paginator->setPageRange($listedPages);
		$paginator->setDefaultScrollingStyle($scrollingStyle); 
		$pages = $paginator;

		return $pages;
	}
	
	
	public function getPaginatedAdmininternship($where = 'internship_title != ""', $order = NULL, $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
			global $zfsession;
					
			if($where == '') $where = 'internship_title != ""';
			
			$select = $this->_db->select()
							->from(array('internships' => 'internships'))
							->joinRight('section', 'section.pk_section_id = internships.fk_section_id', array('section_name', 'section_urlName'))
						   ->where($where)						   				  
						   ->where("internship_deleted = 0")
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