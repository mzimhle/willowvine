<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */
 
// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_administrator extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'administrator';
	protected $_primary = 'pk_administrator_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['administrator_added'])) {
            $data['administrator_added'] = date('Y-m-d H:i:s');
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
        if (empty($data['administrator_updated'])) {
            $data['administrator_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
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
	 * get all administrators ordered by column name
	 * example: $collection->getAlladministrators('administrator_title');
	 * @param string $order
     * @return object
	 */
	public function getAlladministrators($order = 'administrator_added', $where= 'administrator_active=1')
	{
		$select = $this->select()
					   ->order($order)
					   ->where($where);
					   
		return $this->fetchAll($select);

	}
	

	/**
	 * get administrator by administrator Account Id
 	 * @param string administrator id
     * @return object
	 */
	public function getByadministratorId( $id )
	{
		$select = $this->select() 
					   ->where('pk_administrator_id = '.$id)
					   ->limit(1);
					   
		return $this->fetchRow($select)->toArray();

	}
	
	

	/**
	 * get all administrators ordered by column name
	 * example: $collection->getAlladministrators('administrator_title');
	 * @param string $order
     * @return object
	 */
	public function checkLogin($administratorname = '', $password= '')
	{
		$select = $this->select()
					   ->where('administrator_email = ?', $administratorname)
					   ->where('administrator_active = 1')
					   ->where('administrator_deleted = 0')
					   ->where('administrator_password = ?', $password);
					   
		return $this->fetchAll($select);

	}
	
	/**
	 * get all administrators ordered by column name
	 * example: $collection->getAlladministrators('administrator_email');
	 * @param string $order
     * @return object
	 */
	public function checkEmail($administrator_email = '')
	{
		$select = $this->select()
					   ->where('administrator_email = ?', $administrator_email)
					   ->where('administrator_active = 1')
					   ->where('administrator_deleted = 0')
					   ->limit(1);
					   
		return $this->fetchAll($select);

	}
	
}
?>