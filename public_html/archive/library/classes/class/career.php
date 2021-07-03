<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard careers functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */
 
// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_career extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'careers';
	protected $_primary = 'pk_career_id';	
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['career_added'])) {
            $data['career_added'] = date('Y-m-d H:i:s');
        }
        
		if (empty($data['career_updated'])) {
            $data['career_updated'] = date('Y-m-d H:i:s');
        }

		if (empty($data['career_active'])) {
            $data['career_active'] = 0;
        }
        
		if (empty($data['career_deleted'])) {
            $data['career_deleted'] = 0;
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
        if (empty($data['career_updated'])) {
            $data['career_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($id) {
		return $this->delete('pk_career_id = '.$id);		
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
	 * Get recent 10 careers.
	 * example: $collection->getRecentcareers(10);
	 * @param number $limite
     * @return array
	 */
	public function getRecentCareers($limit = 10)
	{	
		$select = $this->_db->select()	
						->from(array('careers' => 'careers'))
						->joinRight('section', 'section.pk_section_id = careers.fk_section_id', array('section_urlName'))
					   ->where('career_active = 1 AND career_deleted = 0')
					   ->order('RAND(), career_added DESC')
					   ->limit($limit);
					   
		return $this->_db->fetchAll($select);
	}
	
	/**
	 * get all careers ordered by column name
	 * example: $collection->getAllcareers('career_title');
	 * @param string $order
     * @return object
	 */
	public function getAllCareers($order = 'career_added', $where = 'career_active=1')
	{	
		
		global $zfsession;
		
		$select = $this->_db->select()	
					   ->from(array('careers' => 'careers'))					   
					   ->where($where)
					   ->where('career_active = 1 AND career_deleted = 0')					   
					   ->order($order);
					   
		return $this->fetchAll($select)->toArray();

	}

	/**
	 * get career by career Account Id
 	 * @param string career id
     * @return object
	 */
	public function getByCareerId( $id )
	{
		$select = $this->_db->select()
					->from(array('careers' => 'careers'))
					->joinRight('section', 'section.pk_section_id = careers.fk_section_id', array('pk_section_id', 'section_name', 'section_urlName'))
					->where('pk_career_id = ?', $id)
					->where('career_deleted = 0')
					->limit(1);
					   
		return $this->_db->fetchRow($select);

	}	
		
	/**
	 * get career by career Account Id
 	 * @param string career id
     * @return object
	 */
	public function getById( $id )
	{
		$select = $this->_db->select()
					->from(array('careers' => 'careers'))
					->joinRight('section', 'section.pk_section_id = careers.fk_section_id', array('pk_section_id', 'section_name', 'section_urlName'))
					->where('pk_career_id = ?', $id)
					->where('career_deleted = 0 AND career_active = 1')
					->limit(1);
					   
		return $this->_db->fetchRow($select);

	}			
	
	public function checkCareerExists($title) {
		return $this->_db->fetchOne("SELECT career_title FROM careers WHERE replace(lower(career_title), ' ', '') = replace(lower('".$title."'), ' ', '');");		
	}		
	
	/**
	 * get careers ordered by column name as pagination object
	 * example: $careersData = $careers->getPaginatedNews('career_career_active = 1 AND career_deleted = 0','careers.career_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getPaginatedCareer($where = 'career_title != ""', $order = NULL, $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
					
			if($where == '') $where = 'career_title != ""';
			
			$select = $this->_db->select()
							->from(array('careers' => 'careers'))
							->joinRight('section', 'section.pk_section_id = careers.fk_section_id', array('section_name', 'section_urlName'))
						   ->where($where)						   				  
						   ->where("career_deleted = 0 AND career_active = 1")
						   ->order($order);
						   
		$paginator = Zend_Paginator::factory($select);
		$paginator->setCurrentPageNumber($page);
		$paginator->setItemCountPerPage($perPage);
		$paginator->setPageRange($listedPages);
		$paginator->setDefaultScrollingStyle($scrollingStyle); 
		$pages = $paginator;

		return $pages;
	}
	
	
	public function getPaginatedAdminCareer($where = 'career_title != ""', $order = NULL, $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
			global $zfsession;
					
			if($where == '') $where = 'career_title != ""';
			
			$select = $this->_db->select()
							->from(array('careers' => 'careers'))
							->joinRight('section', 'section.pk_section_id = careers.fk_section_id', array('section_name', 'section_urlName'))
						   ->where($where)						   				  
						   ->where("career_deleted = 0")
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