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
class class_email extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'email';
	protected $_primary = 'pk_email_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['email_added'])) {
            $data['email_added'] = date('Y-m-d H:i:s');
        }
        
        if (empty($data['email_active'])) {
            $data['email_active'] = 1;
        }

        if (empty($data['email_deleted'])) {
            $data['email_deleted'] = 0;
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
        if (empty($data['email_updated'])) {
            $data['email_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($id) {
		return $this->delete('pk_email_id = '.$id);		
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
	 * get all emails ordered by column name
	 * example: $collection->getAllemails('email_title');
	 * @param string $order
     * @return object
	 */
	public function getAllemails($where = "email_name !=''")
	{
		$select = $this->select()
					   ->where($where)
					   ->where('email_active = 1 AND email_deleted = 0');
					   
					   
		return $this->fetchAll($select);

	}
	
	
	/**
	 * get email by category
 	 * @param string category
     * @return array
	 */
	public function getByType( $type )
	{
		$select = $this->select() 
					   ->where('email_type = ?', $type)
					   ->where('email_deleted = 0');					   
					   
		return $this->fetchAll($select)->toArray();

	}	
	
	public function checkEmail( $email )
	{
		$select = $this->select('email_email') 
					   ->where('email_email = ?', $email)				   
					   ->limit(1);
		return $this->_db->fetchOne($select);

	}	
	
	public function getRandomEmails($limit = 10)
	{	
		$select = $this->select('email_email') 	
						->where('email_sent = 0')
					   ->order('RAND()')
					   ->limit($limit);
					   
		return $this->_db->fetchAll($select);
	}	
	/**
	 * get careers ordered by column name as pagination object
	 * example: $careersData = $careers->getPaginatedNews('career_email_active = 1 AND career_deleted = 0','career.career_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getPaginatedEmail($where = NULL, $order = NULL, $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
			$select = $this->select()
					       ->order($order)
					       ->where($where);
					   
	    
		///$sql = $selectedemails->__toString();
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