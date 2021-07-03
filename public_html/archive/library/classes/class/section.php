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
class class_section extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'section';
	protected $_primary = 'pk_section_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['section_added'])) {
            $data['section_added'] = date('Y-m-d H:i:s');
        }
        
        if (empty($data['section_active'])) {
            $data['section_active'] = 1;
        }

        if (empty($data['section_deleted'])) {
            $data['section_deleted'] = 0;
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
        if (empty($data['section_updated'])) {
            $data['section_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($id) {
		return $this->delete('pk_section_id = '.$id);		
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
	 * get all sections ordered by column name
	 * example: $collection->getAllsections('section_title');
	 * @param string $order
     * @return object
	 */
	public function getAllsections($where = "section_name !=''")
	{
		$select = $this->select()
					   ->where($where)
					   ->where('section_active = 1 AND section_deleted = 0');
					   
		return $this->fetchAll($select)->toArray();

	}
	/**
	 * Get all sections as pairs.
	 * example: $sections = $collection->sectionPairs();
     * @return array
	 */
	 public function sectionPairs() {
		$select = $this->select()
					   ->from(array('a' => 'section'), array('a.pk_section_id', 'a.section_name'))
					   ->where('section_active = 1 AND section_deleted = 0')
					   ->order('section_name ASC');
		return $this->_db->fetchPairs($select);
	}	 		

	/**
	 * get section by section Account Id
 	 * @param string section id
     * @return object
	 */
	public function getBysectionId( $id )
	{
		$select = $this->select() 
					   ->where('pk_section_id = ?', $id)
					   ->where('section_active = 1 AND section_deleted = 0')
					   ->limit(1);
					   
		return $this->fetchAll($select)->toArray();

	}
	
	/**
	 * get section by section url
 	 * @param string section url
     * @return array
	 */
	public function getBysectionUrl( $url )
	{
		$select = $this->select() 
					   ->where('section_urlName = ?', $url)
					   ->where('section_active = 1 AND section_deleted = 0')
					   ->limit(1);
					   
		return $this->fetchAll($select)->toArray();

	}
	
	/**
	 * get section by category
 	 * @param string category
     * @return array
	 */
	public function getByCategory( $categoryName )
	{
		$select = $this->select() 
					   ->where('fk_category_id = ?', $categoryName)
					   ->where('section_active = 1 AND section_deleted = 0');					   
					   
		return $this->fetchAll($select)->toArray();

	}	
	
	/**
	 * Get all sections as pairs with jobs.
	 * example: $sections = $collection->sectionWithJobsPairs();
     * @return array
	 */
	 public function sectionWithJobsPairs() {
		$select = $this->_db->select()
					   ->from(array('a' => 'section'), array('a.pk_section_id', 'a.section_name'))
					   ->joinRight(array('job' => 'job'), 'job.fk_section_id  = a.pk_section_id', array())					   
					   ->where('section_active = 1 AND section_deleted = 0 AND job_deleted = 0 AND job_active = 1')
					   ->order('section_name ASC');
		return $this->_db->fetchPairs($select);
	}
	
	/**
	 * Get job count by sectin
	 * example: $table->jobCoutBySection();
	 * @return array
	 */	 
	public function jobCoutBySection() {
	
		global $zfsession;
		
		$select = $this->_db->select()
						->from(array('job' => 'job'), array('COUNT(pk_job_id) AS job_count'))
						->joinRight(array('section' => 'section'), 'section.pk_section_id  = job.fk_section_id', array('section_name', 'section_urlName'))
						->where('job.job_active = 1 AND job.job_deleted = 0 AND section.fk_category_id = "job"')
						->where('job_area LIKE "%|'.$zfsession->userCity['fk_country_id'].'|'.$zfsession->userCity['fk_province_id'].'|%"')
						->group('section_name', 'section_urlName')
						->order('job_count DESC');
						
		return $this->_db->fetchAll($select);
	}	
		
	/**
	 * get careers ordered by column name as pagination object
	 * example: $careersData = $careers->getPaginatedNews('career_section_active = 1 AND career_deleted = 0','career.career_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getPaginatedsection($where = NULL, $order = NULL, $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
			$select = $this->select()
					       ->order($order)
					       ->where($where);
					   
	    
		///$sql = $selectedsections->__toString();
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