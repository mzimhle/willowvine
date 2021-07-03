<?php

require_once '_comm.php';
require_once 'mailinglist.php';
require_once 'participantlogin.php';
require_once 'File.php';

//custom account item class as account table abstraction
class class_participant extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name				= 'participant';
	protected $_primary			= 'participant_code';
	public $_comm						= null;
	public $_mailinglist				= null;
	public $_participantlogin		= null;
	public $_File							= null;
	
	function init()	{
		$this->_comm					= new class_comm();
		$this->_mailinglist 				= new class_mailinglist();
		$this->_participantlogin		= new class_participantlogin();
		$this->_File						= new File(array('png', 'jpg', 'jpeg'));
	}
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	public function insert(array $data) {
        // add a timestamp
        $data['participant_added']		= date('Y-m-d H:i:s');
        $data['participant_code']		= isset($data['participant_code']) && trim($data['participant_code']) != '' ? $data['participant_code'] : $this->createReference();
		
		$success = parent::insert($data);	
		
		if($success) {
		
			$participantData = $this->getCode($success);			

			if($participantData) {
				/* Create a new mailerlist record. */
				$this->_mailinglist->insertMailinglist('participant', $participantData);

				$this->mailbok($participantData, 'add');
			}
		}
		
		return $success;
    }
	
	public function mailbok(array $data, $type = 'add') {
		
		$url = "http://www.mailbok.co.za/webservice/paticipant";

		$data = array(
			'username' => 'mzimhle@willowvine.co.za',
			'password' => 'di79ee',
			'client' => '93642848',
			'subscriber_name' => $data['participant_name'],
			'subscriber_surname' => $data['participant_surname'],
			'subscriber_email' => $data['participant_email'],
			'subscriber_cellphone' => '',
			'subscriber_reference' => $data['participant_code'],
			'type' => $type
		);

		foreach($data as $key=>$value) { $content .= $key.'='.$value.'&'; }

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

		$json_response = curl_exec($curl);

		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		curl_close($curl);

		return json_decode($json_response, true);			
			
	}
	
	public function insertParticipant(array $data, $type) {
		
		$insert									= array();
		$insert['participant_name']		= isset($data['participant_name']) && trim($data['participant_name']) != '' ? $data['participant_name'] : null;
		$insert['participant_surname']	= isset($data['participant_surname']) && trim($data['participant_surname']) != '' ? $data['participant_surname'] : null;
		$insert['participant_email']		= isset($data['participant_email']) && trim($data['participant_email']) != '' ? $data['participant_email'] : null;
		$insert['areapost_code']			= isset($data['areapost_code']) && trim($data['areapost_code']) != '' ? $data['areapost_code'] : null;
		$insert['participant_active']		= isset($data['participant_active']) && trim($data['participant_active']) != '' ? $data['participant_active'] : 1;
		
		$success = $this->insert($insert);

		if($success) {
			/* Insert login data. */
			$participantData = $this->getCode($success);			
			
			if($participantData) {
				switch($type) {
					case 'EMAIL' : 
						/* Create a new login record. */
						$success = $this->_participantlogin->insertLogin($participantData, $type, $success);
						
						$return = $this->_participantlogin->getByCode($success);

						if($return)	$this->_comm->sendMail(realpath(__DIR__.'/../../../../public_html/').'/templates/mail/registration_email_verify.html', 'PARTICIPANT_REGISTER_EMAIL', $return, 'Willowvine Email Confirmation', array());
					break;
					case 'FACEBOOK' : 
						/* Create a new login record. */
						$success = $this->_participantlogin->insertLogin(array_merge($participantData, $data), $type, $success);						
						$this->_comm->sendMail($success, 'PARTICIPANT_REGISTER_FACEBOOK', 'Willowvine Successful Registration', realpath(__DIR__.'/../../../../public_html/').'/mailers/web/registration_success.html');	
					break;
					case 'LINKEDIN' : 
						/* Create a new login record. */
						$success = $this->_participantlogin->insertLogin(array_merge($participantData, $data), $type, $success);						
						$this->_comm->sendMail($success, 'PARTICIPANT_REGISTER_LINKEDIN', 'Willowvine Successful Registration', realpath(__DIR__.'/../../../../public_html/').'/mailers/web/registration_success.html');		
					break;
					case 'GOOGLE' : 
						/* Create a new login record. */
						$success = $this->_participantlogin->insertLogin(array_merge($participantData, $data), $type, $success);						
						$this->_comm->sendMail($success, 'PARTICIPANT_REGISTER_GOOGLE', 'Willowvine Successful Registration', realpath(__DIR__.'/../../../../public_html/').'/mailers/web/registration_success.html');		
					break;							
				}
				return $success;
			}		
		}
		
		return $success;
	}
	
	public function updateParticipant(array $data, $type) {

		if(isset($data['participant_code'])) {
			
			/* Update participant. */
			$partwhere = $this->getAdapter()->quoteInto('participant_code = ?', $data['participant_code']);
			parent::update($data, $partwhere);
			
			/* Update mailinglist. */
			$tempData = $this->getByCode($data['participant_code']);

			if($tempData) {
				$this->_mailinglist->updateMailinglist('participant', $tempData);
				
				/* Update participantlogin. */
				$loginwhere = array();
				$loginwhere[] = $this->_participantlogin->getAdapter()->quoteInto('participant_code = ?', $tempData['participant_code']);
				$loginwhere[] = $this->_participantlogin->getAdapter()->quoteInto('participantlogin_type = ?', $type);
				
				$this->_participantlogin->updateLogin($tempData, $loginwhere, $type);	
				
				return $tempData['participant_code'];
			}
			
			return false;
		} else {
			return false;
		}
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
         $data['participant_updated'] = date('Y-m-d H:i:s');
        
        $success = parent::update($data, $where);

		$tempData = $this->getByCode($data['participant_code']);
		
		$this->_mailinglist->updateMailinglist('participant', $tempData);
		
		$this->mailbok($tempData, 'update');
		
		return $success;
    }
	
	/**
	 * get job by job participant Id
 	 * @param string job id
     * @return object
	 */
	public function checkEmail($email) {	
		$select = $this->_db->select()	
							->from(array('participant' => 'participant'))	
							->where('participant_email = ?', $email)
							->where('participant_deleted = 0');

	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;
	}
	
	public function getAll($where = 'participant_deleted = 0', $order = 'participant_deleted desc')	{
	
		$select = $this->_db->select()	
						->from(array('participant' => 'participant'))
						->joinLeft('areapost', 'areapost.areapost_code = participant.areapost_code')
						->joinLeft('participantlogin', 'participantlogin.participant_code = participant.participant_code and participantlogin_deleted = 0', array('participantlogin_type' =>new Zend_Db_Expr('GROUP_CONCAT(DISTINCT participantlogin.participantlogin_type)')))
						->where($where)
						->where('participant_deleted = 0')
						->group('participant.participant_code')
						->order($order);

	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	public function communication() {
	
		$select = $this->_db->select()	
						->from(array('participant' => 'participant'))
						->joinLeft('_comm', '_comm.participant_code = participant.participant_code')
						->where('participant_deleted = 0')
						->order('_comm._comm_added desc');

	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	/**
	 * get all administrators ordered by column name
	 * example: $collection->getAlladministrators('administrator_title');
	 * @param string $order
     * @return object
	 */
	public function checkLogin($username = '', $password= '')
	{
		
		$select = $this->_db->select()	
							->from(array('participant' => 'participant'))	
							->where('participant_email = ?', $username)
							->where('participant_active = 1')
							->where('participant_deleted = 0')
							->where('participant_password = ?', $password);

	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getByCode($code)
	{
		$select = $this->_db->select()	
						->from(array('participant' => 'participant'))	
						->joinLeft('areapost', 'areapost.areapost_code = participant.areapost_code')
						->joinLeft('participantlogin', 'participantlogin.participant_code = participant.participant_code and participantlogin_deleted = 0', array('participantlogin_type' =>new Zend_Db_Expr('GROUP_CONCAT(DISTINCT participantlogin.participantlogin_type)')))					
					   ->where('participant.participant_code = ?', $code)					   
					   ->where('participant_deleted = 0')
					   ->group('participant.participant_code')
					   ->limit(1);
		
	   $result = $this->_db->fetchRow($select);	
       return ($result == false) ? false : $result = $result;					   
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getCode($code)
	{
		$select = $this->_db->select()	
						->from(array('participant' => 'participant'))	
					   ->where('participant_code = ?', $code)
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	function createPassword() {
		/* New reference. */
		$password = "";
		$codeAlphabet = "abcdefghigklmnopqrstuvwxyz";
		$codeAlphabet .= "0123456789";
		
		$count = strlen($codeAlphabet) - 1;
		
		for($i=0;$i<5;$i++){
			$password .= $codeAlphabet[rand(0,$count)];
		}
		
		return $password;

	}
	
	
	function createReference() {
		/* New reference. */
		$reference = "";
		// $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet = '123456789';
		
		$count = strlen($codeAlphabet) - 1;
		
		for($i=0;$i<10;$i++){
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

	/**
	 * get job by job participant Id
 	 * @param string job id
     * @return object
	 */
	public function getByCell($cell, $code = null) {
	
		if($code == null) {
			$select = $this->_db->select()	
						->from(array('participant' => 'participant'))	
						->joinLeft('areapost', 'areapost.areapost_code = participant.areapost_code')
						->where('participant_cellphone = ?', $cell)
						->where('participant_deleted = 0')
						->limit(1);
       } else {
			$select = $this->_db->select()	
						->from(array('participant' => 'participant'))	
						->joinLeft('areapost', 'areapost.areapost_code = participant.areapost_code')
						->where('participant_cellphone = ?', $cell)
						->where('participant_code != ?', $code)
						->where('participant_deleted = 0')
						->limit(1);		
	   }
	   
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;
	}
	
	/**
	 * get job by job participant Id
 	 * @param string job id
     * @return object
	 */
	public function getByEmail($email, $code = null) {
	
		if($code == null) {
			$select = $this->_db->select()	
						->from(array('participant' => 'participant'))	
						->joinLeft('areapost', 'areapost.areapost_code = participant.areapost_code')
						->where('participant_email = ?', $email)
						->where('participant_deleted = 0')
						->limit(1);
       } else {
			$select = $this->_db->select()	
						->from(array('participant' => 'participant'))	
						->joinLeft('areapost', 'areapost.areapost_code = participant.areapost_code')
						->where('participant_email = ?', $email)
						->where('participant_code != ?', $code)
						->where('participant_deleted = 0')
						->limit(1);		
	   }
	   
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;
	}
	
	/**
	 * get job by job participant Id
 	 * @param string job id
     * @return object
	 */
	public function getByIDnumber($idnumber, $code = null)
	{
		if($code == null) {
		$select = $this->_db->select()	
					->from(array('participant' => 'participant'))	
					->joinLeft('areapost', 'areapost.areapost_code = participant.areapost_code')
					->where('participant_idnumber = ?', $idnumber)
					->where('participant_deleted = 0')
					->limit(1);
       } else {
		$select = $this->_db->select()	
					->from(array('participant' => 'participant'))	
					->joinLeft('areapost', 'areapost.areapost_code = participant.areapost_code')
					->where('participant_idnumber = ?', $idnumber)
					->where('participant_code != ?', $code)
					->where('participant_deleted = 0')
					->limit(1);		
	   }
	   
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;
	}	
	
	public function validateIDnumber($idnr) {	
		if(strlen(trim($idnr)) == 13) {
			if(preg_match('/([0-9][0-9])(([0][1-9])|([1][0-2]))(([0-2][0-9])|([3][0-1]))([0-9])([0-9]{3})([0-9])([0-9])([0-9])/', trim($idnr))) {
				return trim($idnr);
			} else {
				return '';
			}
		} else {
			return '';
		}
	}
		
	public function validateEmail($string) {
		if(preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($string))) {
			return trim($string);
		} else {
			return '';
		}
	}
	
	public function validateCell($string) {
		if(preg_match('/^0[0-9]{9}$/', $this->onlyCellNumber(trim($string)))) {
			return $this->onlyCellNumber(trim($string));
		} else {
			return '';
		}
	}
	
	public function onlyCellNumber($string) {

		/* Remove some weird charactors that windows dont like. */
		$string = strtolower($string);
		$string = str_replace(' ' , '' , $string);
		$string = str_replace('__' , '' , $string);
		$string = str_replace(' ' , '' , $string);
		$string = str_replace("é", "", $string);
		$string = str_replace("è", "", $string);
		$string = str_replace("`", "", $string);
		$string = str_replace("/", "", $string);
		$string = str_replace("\\", "", $string);
		$string = str_replace("'", "", $string);
		$string = str_replace("(", "", $string);
		$string = str_replace(")", "", $string);
		$string = str_replace("-", "", $string);
		$string = str_replace(".", "", $string);
		$string = str_replace("ë", "", $string);	
		$string = str_replace('___' , '' , $string);
		$string = str_replace('__' , '' , $string);	
		$string = str_replace(' ' , '' , $string);
		$string = str_replace('__' , '' , $string);
		$string = str_replace(' ' , '' , $string);
		$string = str_replace("é", "", $string);
		$string = str_replace("è", "", $string);
		$string = str_replace("`", "", $string);
		$string = str_replace("/", "", $string);
		$string = str_replace("\\", "", $string);
		$string = str_replace("'", "", $string);
		$string = str_replace("(", "", $string);
		$string = str_replace(")", "", $string);
		$string = str_replace("-", "", $string);
		$string = str_replace(".", "", $string);
		$string = str_replace("ë", "", $string);	
		$string = str_replace("â€“", "", $string);	
		$string = str_replace("â", "", $string);	
		$string = str_replace("€", "", $string);	
		$string = str_replace("“", "", $string);	
		$string = str_replace("#", "", $string);	
		$string = str_replace("$", "", $string);	
		$string = str_replace("@", "", $string);	
		$string = str_replace("!", "", $string);	
		$string = str_replace("&", "", $string);	
		$string = str_replace(';' , '' , $string);		
		$string = str_replace(':' , '' , $string);		
		$string = str_replace('[' , '' , $string);		
		$string = str_replace(']' , '' , $string);		
		$string = str_replace('|' , '' , $string);		
		$string = str_replace('\\' , '' , $string);		
		$string = str_replace('%' , '' , $string);	
		$string = str_replace(';' , '' , $string);		
		$string = str_replace(' ' , '' , $string);
		$string = str_replace('__' , '' , $string);
		$string = str_replace(' ' , '' , $string);	
		$string = str_replace('-' , '' , $string);	
		$string = str_replace('+27' , '0' , $string);	
		$string = str_replace('(0)' , '' , $string);	
		
		$string = preg_replace('/^00/', '0', $string);
		$string = preg_replace('/^27/', '0', $string);
		
		$string = preg_replace('!\s+!',"", strip_tags($string));
		
		return $string;
				
	}
	
	public function download($code, $imagesize = 'thumb') {
		
		$profileData = $this->getByCode($code);

		if($profileData && isset($profileData) && trim($profileData['participant_image_path']) != '') {			
			
			if(array_key_exists($imagesize, $this->_File->logo)) {
			
				$PATH 	= $_SERVER['DOCUMENT_ROOT'].$profileData['participant_image_path'].$this->_File->logo[$imagesize]['code'].$profileData['participant_image_name'].$profileData['participant_image_ext'];
				$MIME	= $this->_File->file_content_type($profileData['participant_image_path'].$this->_File->logo[$imagesize]['code'].$profileData['participant_image_name'].$profileData['participant_image_ext']);

				header("Expires: on, 01 Jan 1970 00:00:00 GMT");
				header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
				header("Cache-Control: no-store, no-cache, must-revalidate");
				header("Cache-Control: post-check=0, pre-check=0", false);
				header("Pragma: no-cache");
				header("Content-Description: File Transfer");
				header("Content-Type: " . $MIME);
				header("Content-Length: " .(string)(filesize($PATH)) );
				header('Content-Disposition: attachment; filename="ProfilePicture"');
				header("Content-Transfer-Encoding: binary\n");
	 
				readfile($PATH); // outputs the content of the file;
			
				exit;
			}
		} else {
			
			$PATH 	= $_SERVER['DOCUMENT_ROOT'].'/media/avatar.jpg';
			
			$MIME	= $this->_File->file_content_type('/media/avatar.jpg');
			
			header("Expires: on, 01 Jan 1970 00:00:00 GMT");
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			header("Cache-Control: no-store, no-cache, must-revalidate");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
			header("Content-Description: File Transfer");
			header("Content-Type: " . $MIME);
			header("Content-Length: " .(string)(filesize($PATH)) );
			header('Content-Disposition: attachment; filename="Avatar"');
			header("Content-Transfer-Encoding: binary\n");

			readfile($PATH); // outputs the content of the file;			
		}
	}	
}
?>