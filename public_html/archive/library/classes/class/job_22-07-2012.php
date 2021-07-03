<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard jobs functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */
 
// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_job extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'job';
	protected $_primary = 'pk_job_id';	
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['job_added'])) {
            $data['job_added'] = date('Y-m-d H:i:s');
        }
        
		if (empty($data['job_updated'])) {
            $data['job_updated'] = date('Y-m-d H:i:s');
        }

		if (empty($data['job_active'])) {
            $data['job_active'] = 0;
        }
        
		if (empty($data['job_deleted'])) {
            $data['job_deleted'] = 0;
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
        if (empty($data['job_updated'])) {
            $data['job_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($id) {
		return $this->delete('pk_job_id = '.$id);		
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
	 * Get recent 10 jobs.
	 * example: $collection->getRecentJobs(10);
	 * @param number $limite
     * @return array
	 */
	public function getRecentJobs($limit = 10)
	{	
		$select = $this->_db->select()	
						->from(array('job' => 'job'))
						->joinRight('section', 'section.pk_section_id = job.fk_section_id', array('pk_section_id', 'section_name', 'section_urlName'))
					   ->where('job_active = 1 AND job_deleted = 0')
					   ->order('RAND(), job_added DESC')
					   ->limit($limit);
					   
		return $this->_db->fetchAll($select);
	}
	
	/**
	 * get all jobs ordered by column name
	 * example: $collection->getAlljobs('job_title');
	 * @param string $order
     * @return object
	 */
	public function getAlljobs($order = 'job_added', $where = 'job_active=1')
	{	
		
		global $zfsession;
		
		$select = $this->_db->select()	
					   ->from(array('job' => 'job'))					   
					   ->where($where)
					   ->where('job_active = 1 AND job_deleted = 0')					   
					   ->order($order);
					   
		return $this->fetchAll($select)->toArray();

	}

	/**
	 * get all jobs from that month in current year
	 * example: $apriljobs = $collection->getByMonth('2009-04-01');
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
				  ->from(array('job' => 'job'))
                  ->order('job_added DESC')
				  ->where('month(job_added) = ?', $month)
				  ->where('year(job_added) = ?', $year)
				  ->where('job_area LIKE "%|'.$zfsession->userCity['fk_country_id'].'|'.$zfsession->userCity['fk_province_id'].'|%"');
		return $this->fetchAll($select);
		
	}
	
	
	/**
	 * get all jobs from year
	 * example: $jobs2008 = $collection->getByYear('2008-04-01');
	 * @param string $date
     * @return object
	 */
	public function getByYear($date)
	{
		global $zfsession;
		
		$datetime = strtotime($date);
		$year = date('Y', $datetime);
		
		$select = $this->_db->select()
				  ->from(array('job' => 'job'))
                  ->order('job_added DESC')
				  ->where('year(job_added) = ?', $year)
				  ->where('job_area LIKE "%|'.$zfsession->userCity['fk_country_id'].'|'.$zfsession->userCity['fk_province_id'].'|%"');
		return $this->fetchAll($select);
		
	}
		

	/**
	 * get job by job Account Id
 	 * @param string job id
     * @return object
	 */
	public function getByjobId( $id )
	{
		$select = $this->_db->select()
					->from(array('job' => 'job'))
					->joinRight('section', 'section.pk_section_id = job.fk_section_id', array('pk_section_id', 'section_name', 'section_urlName'))
					->joinLeft('areaMap', 'areaMap.fkAreaId = job.fk_area_id', array('areaMap_Name', 'areaMap_path'))
					->where('pk_job_id = ?', $id)
					->where('job_deleted = 0')
					->limit(1);
					   
		return $this->_db->fetchRow($select);

	}
	
	public function getByReferenceHashCode($reference, $hashCode )
	{
		$select = $this->_db->select()
					->from(array('job' => 'job'))
					->joinRight('section', 'section.pk_section_id = job.fk_section_id', array('pk_section_id', 'section_name', 'section_urlName'))
					->joinLeft('areaMap', 'areaMap.fkAreaId = job.fk_area_id', array('areaMap_Name', 'areaMap_path'))
					->where('job_reference = ?', $reference)
					->where('job_hashcode = ?', $hashCode)
					->where('job_deleted = 0')
					->limit(1);					   
		return $this->_db->fetchRow($select);
	}	
	
	/**
	 * get job by job reference
 	 * @param int job reference
     * @return array
	 */
	public function getByReference( $reference )
	{
		$select = $this->_db->select()
					->from(array('job' => 'job'))
					->joinRight('section', 'section.pk_section_id = job.fk_section_id', array('pk_section_id', 'section_name', 'section_urlName'))
					->joinLeft('areaMap', 'areaMap.fkAreaId = job.fk_area_id', array('areaMap_Name', 'areaMap_path'))
					->where('job_reference = ?', $reference)
					->where('job_active = 1 AND job_deleted = 0')
					->limit(1);

		return $this->_db->fetchAll($select);

	}

	/**
	 * get job by job reference
 	 * @param int job reference
     * @return array
	 */
	public function getSearchReference( $reference )
	{
		$select = $this->_db->select()
					->from(array('job' => 'job'))
					->joinRight('section', 'section.pk_section_id = job.fk_section_id', array('pk_section_id', 'section_name', 'section_urlName'))
					->where('job_reference = ?', $reference)
					->where('job_active = 1 AND job_deleted = 0')
					->limit(1);

		return $this->_db->fetchAll($select);

	}	
	/**
	 * get job by job reference
 	 * @param int job reference
     * @return array
	 */
	public function checkJobExists($reference) 
	{
		$select = $this->select() 
					   ->where('job_reference = ?', $reference)
					   ->limit(1);
					   
		return $this->fetchAll($select)->toArray();

	}
		
	/**
	 * get job by job reference
 	 * @param int job reference
     * @return array
	 */
	public function getByAffiliateReference($reference) 
	{
		$select = $this->select() 
					   ->where('job_affiliateReference = ?', $reference)
					   ->limit(1);
					   
		return $this->fetchAll($select)->toArray();

	}	
	
	public function getByAffiliateLink($link) {
		$select = $this->select() 
					   ->where('job_affiliateLink = ?', $link)
					   ->limit(1);
					   
		return $this->fetchAll($select)->toArray();	
	}
	
	/**
	 * Create job reference 	 
     * @return integer
	 */
	public function createReference()
	{
		/* Get the last inserted id. */
		$select = $this->_db->fetchOne('SELECT pk_job_id FROM job ORDER BY pk_job_id DESC LIMIT 1');			
		$reference = (4000 + (int)$select);
		/* We are going to start counting at 1000 */
		return $reference; 
	}	
	
	public function jobCoutBySection() {
		
		global $zfsession;
		
		$select = $this->_db->select()
						->from(array('job' => 'job'), array('COUNT(pk_job_id) AS job_count'))
						->joinLeft('section', 'section.pk_section_id = job.fk_section_id', array('section_name', 'pk_section_id'))
						->where('job.job_active = 1 AND job.job_deleted = 0 AND section_active = 1 AND section_deleted = 0')
						->group('section_name')
						->order('job_count DESC');
						
		return $this->_db->fetchAll($select);
	}		
	public function jobCoutByArea() {
		$select = "SELECT counted, area 
						FROM (SELECT COUNT(*) AS counted, TRIM(REPLACE(LOWER(b.job_area), ' ,', ',')) AS area
								FROM `job` AS b
									WHERE TRIM(REPLACE(LOWER(b.job_area), ' ,', ','))  NOT RLIKE '[0-9]' 
								GROUP BY TRIM(REPLACE(LOWER(b.job_area), ' ,', ','))) AS a 
						ORDER BY counted DESC LIMIT 20";
			return $this->_db->fetchAll($select);	
	}	
	
	/**
	 * Get job count by area + city
	 * example: $table->jobCoutByArea();
	 * @param string city
	 * @return array
	 */
	 
	public function jobCoutByAreaCity() {
	
		global $zfsession;
			
		$select = $this->_db->select()
						->from(array('job' => 'job'), array('job_area', 'COUNT(pk_job_id) AS job_count'))
						->joinLeft('areaMap', 'areaMap.pk_area_id = job.fk_area_id', array('area_Name', 'pk_area_id'))
						->where('job_area LIKE "%|'.$zfsession->userCity['fk_country_id'].'|'.$zfsession->userCity['fk_province_id'].'|'.$zfsession->userCity['fk_area_id'].'%"')
						->where('job.job_active = 1 AND job.job_deleted = 0')
						->group('job_area')
						->order('job_count DESC');
						
		return $this->_db->fetchAll($select);
	}			
	/**
	 * get careers ordered by column name as pagination object
	 * example: $careersData = $careers->getPaginatedNews('career_job_active = 1 AND career_deleted = 0','career.career_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getPaginatedjob($where = 'job_title != ""', $order = NULL, $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
			global $zfsession;
					
			if($where == '') $where = 'job_title != ""';
			
			$select = $this->_db->select()
							->from(array('job' => 'job'))
							->joinRight('section', 'section.pk_section_id = job.fk_section_id', array('section_name', 'section_urlName'))
						   ->where($where)						   				  
						   ->where("job_deleted = 0 AND job_active = 1")
						   ->order($order);
						   
		$paginator = Zend_Paginator::factory($select);
		$paginator->setCurrentPageNumber($page);
		$paginator->setItemCountPerPage($perPage);
		$paginator->setPageRange($listedPages);
		$paginator->setDefaultScrollingStyle($scrollingStyle); 
		$pages = $paginator;

		return $pages;
	}
	
	public function getPaginatedAdminjob($where = 'job_title != ""', $order = NULL, $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
			global $zfsession;
					
			if($where == '') $where = 'job_title != ""';
			
			$select = $this->_db->select()
							->from(array('job' => 'job'))
						   ->where($where)						   				  
						   ->where("job_deleted = 0")
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