<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */

//custom enquiry item class as enquiry table abstraction
class class_category extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'category';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        $data['category_added'] = date('Y-m-d H:i:s');
        $data['category_code'] 	= $this->createReference();
		$data['category_url']		= $this->toUrl($data['category_name']);
		
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
        $data['category_updated'] = date('Y-m-d H:i:s');
        if(isset($data['category_url'])) $data['category_url'] = $this->toUrl($data['category_name']);
		
        return parent::update($data, $where);
    }
	
	public function getByLink($link) {
	
		$select = $this->_db->select() 
						->from(array('category' => 'category'))		
					   ->where('category_url = ?', $link)
					   ->where('category_deleted = 0')
					   ->limit(1);
					   
		$result = $this->_db->fetchRow($select);
		return ($result == false) ? false : $result = $result;
	}
	
	public function getAll($where = 'category_deleted = 0', $order = 'category_name desc') {
	
			$select = $this->_db->select() 
					   ->from(array('category' => 'category'))
					   ->where($where)
					   ->order($order);
	
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;
	}
	
	public function getByRegistry($registry) {
			
		switch($registry) {
			case 'tenders' : 
				$select = $this->_db->select() 
						   ->from(array('category' => 'category'))
							->joinInner('tender', 'tender.category_code = category.category_code and tender_deleted = 0', array('category_count' =>new Zend_Db_Expr('COUNT(tender_code)')))
						   ->where('category_deleted = 0')
						   ->group('category.category_code')
						   ->having('category_count > 0')
						   ->order('category_name');			
			break;
			case 'jobs' : 
				$select = $this->_db->select() 
						   ->from(array('category' => 'category'))
							->joinInner('job', 'job.category_code = category.category_code and job_deleted = 0', array('category_count' =>new Zend_Db_Expr('COUNT(job_code)')))
						   ->where('category_deleted = 0')
						   ->group('category.category_code')
						   ->having('category_count > 0')
						   ->order('category_name');			
			break;
			case 'trade-leads' : 
				$select = $this->_db->select() 
						   ->from(array('category' => 'category'))
							->joinInner('tradelead', 'tradelead.category_code = category.category_code and tradelead_deleted = 0', array('category_count' =>new Zend_Db_Expr('COUNT(tradelead_code)')))
						   ->where('category_deleted = 0')
						   ->group('category.category_code')
						   ->having('category_count > 0')
						   ->order('category_name');			
			break;
			case 'articles' : 
				$select = $this->_db->select() 
						   ->from(array('category' => 'category'))
							->joinInner('article', 'article.category_code = category.category_code and article_deleted = 0', array('category_count' =>new Zend_Db_Expr('COUNT(article_code)')))
						   ->where('category_deleted = 0')
						   ->group('category.category_code')
						   ->having('category_count > 0')
						   ->order('category_name');			
			break;			
			case 'companies' : 
				$select = $this->_db->select() 
						   ->from(array('category' => 'category'))
							->joinInner('companyservice', "companyservice.category_code = category.category_code and companyservice_deleted = 0 and companyservice_type = 'CATEGORY'", array('category_count' =>new Zend_Db_Expr('COUNT(companyservice_code)')))
						   	->joinInner('company', "company.company_code = companyservice.company_code and company_deleted = 0 and company_active = 1", array('category_count' =>new Zend_Db_Expr('COUNT(companyservice_code)')))							
						   ->where('category_deleted = 0')
						   ->group('category.category_code')
						   ->having('category_count > 0')
						   ->order('category_name');			
			break;			
			default :
				$select = $this->_db->select() 
						   ->from(array('category' => 'category'))
						   ->where('category_deleted = 0')
						   ->order('category_name');
		}
		
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;
	}

	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getByCode($reference)
	{
		$select = $this->_db->select()	
						->from(array('category' => 'category'))	
					   ->where('category_code = ?', $reference)
					   ->where('category_deleted = 0')
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getCode($reference)
	{
		$select = $this->_db->select()	
						->from(array('category' => 'category'))	
					   ->where('category_code = ?', $reference)
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	 public function pairs() {

		$select = $this->select()
					   ->from(array('category' => 'category'), array('category.category_code', 'category.category_name'))
					   ->where('category_deleted = 0')
					   ->order('category_name ASC');

	   $result = $this->_db->fetchPairs($select);	
       return ($result == false) ? false : $result = $result;			

	}	 
	
	function createReference() {
		/* New reference. */
		$reference = "";
		// $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet = '123456789';
		
		$count = strlen($codeAlphabet) - 1;
		
		for($i=0;$i<5;$i++){
			$reference .= $codeAlphabet[rand(0,$count)];
		}
		
		/* First check if it exists or not. */
		$itemCheck = $this->getCode($reference);
		
		if($itemCheck) {
			/* It exists. check again. */
			$this->createReference();
		} else {
			return $reference;
		}
	}	
	
	public function toUrl($string) {

		/* Remove some weird charactors that windows dont like. */
		$string = strtolower($string);
		$string = str_replace(' ' , '_' , $string);
		$string = str_replace('__' , '_' , $string);
		$string = str_replace(' ' , '_' , $string);
		$string = str_replace("é", "e", $string);
		$string = str_replace("è", "e", $string);
		$string = str_replace("`", "", $string);
		$string = str_replace("/", "_", $string);
		$string = str_replace("\\", "_", $string);
		$string = str_replace("'", "", $string);
		$string = str_replace("(", "", $string);
		$string = str_replace(")", "", $string);
		$string = str_replace("-", "_", $string);
		$string = str_replace(".", "_", $string);
		$string = str_replace("ë", "e", $string);	
		$string = str_replace('___' , '_' , $string);
		$string = str_replace('__' , '_' , $string);	
		$string = str_replace(' ' , '_' , $string);
		$string = str_replace('__' , '_' , $string);
		$string = str_replace(' ' , '_' , $string);
		$string = str_replace("é", "e", $string);
		$string = str_replace("è", "e", $string);
		$string = str_replace("`", "", $string);
		$string = str_replace("/", "_", $string);
		$string = str_replace("\\", "_", $string);
		$string = str_replace("'", "", $string);
		$string = str_replace("(", "", $string);
		$string = str_replace(")", "", $string);
		$string = str_replace("-", "_", $string);
		$string = str_replace(".", "_", $string);
		$string = str_replace("ë", "e", $string);	
		$string = str_replace("â€“", "ae", $string);	
		$string = str_replace("â", "a", $string);	
		$string = str_replace("€", "e", $string);	
		$string = str_replace("“", "", $string);	
		$string = str_replace("#", "", $string);	
		$string = str_replace("$", "", $string);	
		$string = str_replace("@", "", $string);	
		$string = str_replace("!", "", $string);	
		$string = str_replace("&", "", $string);	
		$string = str_replace(';' , '_' , $string);		
		$string = str_replace(':' , '_' , $string);		
		$string = str_replace('[' , '_' , $string);		
		$string = str_replace(']' , '_' , $string);		
		$string = str_replace('|' , '_' , $string);		
		$string = str_replace('\\' , '_' , $string);		
		$string = str_replace('%' , '_' , $string);	
		$string = str_replace(';' , '' , $string);		
		$string = str_replace(' ' , '_' , $string);
		$string = str_replace('__' , '_' , $string);
		$string = str_replace(' ' , '' , $string);	
		
		return $string;
				
	}
	
}
?>