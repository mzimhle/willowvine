<?php

//custom account item class as account table abstraction
class class_comm extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name 		= '_comm';
	protected $_primary	= '_comm_code';
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	public function insert(array $data) {
        // add a timestamp
        $data['_comm_added'] 	= date('Y-m-d H:i:s');
        $data['_comm_code'] 	= isset($data['_comm_code']) ? $data['_comm_code'] : $this->createReference();        		
		
		return parent::insert($data);		
    }
	
	/**
	 * get job by job _comm Id
 	 * @param string job id
     * @return object
	 */
	public function viewComm($code) {
		$select = $this->_db->select()	
					->from(array('_comm' => '_comm'))				
					->joinLeft('participant', 'participant.participant_code = _comm.participant_code and participant_deleted = 0')		
					->where('_comm_code = ?', $code)					
					->limit(1);
       
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	}	
	
	/**
	 * get job by job _comm Id
 	 * @param string job id
     * @return object
	 */
	public function getByCode($code)
	{		
		$select = $this->_db->select()	
					->from(array('_comm' => '_comm'))				
					->joinLeft('participant', 'participant.participant_code = _comm.participant_code and participant_deleted = 0')				
					->where('_comm_code = ?', $code)					
					->limit(1);
       
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;

	}

	/**
	 * get job by job _comm Id
 	 * @param string job id
     * @return object
	 */
	public function getByReference($reference)
	{		
		$select = $this->_db->select()
					->from(array('_comm' => '_comm'))				
					->joinLeft('participant', 'participant.participant_code = _comm.participant_code and participant_deleted = 0')
					->where('mailinglist', 'mailinglist.mailinglist_code = _comm.mailinglist and mailinglist_deleted = 0')
					->where('_comm._comm_reference = ?', $reference);
       
		$result = $this->_db->fetchAll($select);
        return ($result == false) ? false : $result = $result;

	}
	
	public function sendMail($template, $reference, $mailinglist, $subject, $attachment = array()) {
		
		require_once 'config/smarty.php';
		
		global $smarty;
		
		require_once('Zend/Mail.php');
		
		$mail = new Zend_Mail();
		$data								= array();
		$data['_comm_code']	= $this->createReference();
		
		$smarty->assign('mailinglist', $mailinglist);	
		$smarty->assign('tracking', $data['_comm_code']);
		$smarty->assign('domain', $_SERVER['HTTP_HOST']);
		
		$message = $smarty->fetch($template);

		/* Check for attachements. */
		for($i=0; $i < count($attachment); $i++) {
		
			$at = new Zend_Mime_Part(file_get_contents($attachment[$i]['path']));
			$at->disposition = Zend_Mime::DISPOSITION_INLINE;
			$at->encoding 	= Zend_Mime::ENCODING_BASE64;
			$at->filename 	= $attachment[$i]['name'];

			$mail->addAttachment($at);
		}
		
		$mail->setFrom('info@willowvine.co.za', 'Willowvine'); //EDIT!!		
		$mail->addTo($mailinglist['mailinglist_email']);
		$mail->setSubject($subject);
		$mail->setBodyHtml($message);			

		/* Save data to the comms table. */
		$data['participant_code']	= isset($mailinglist['participant_code']) && trim($mailinglist['participant_code']) != '' ? $mailinglist['participant_code'] : null;
		$data['mailinglist_code']		= isset($mailinglist['mailinglist_code']) && trim($mailinglist['mailinglist_code']) != '' ? $mailinglist['mailinglist_code'] : null;
		$data['_comm_type']			= 'EMAIL';
		$data['_comm_name']		= $subject;
		$data['_comm_sent']			= null;
		$data['_comm_email']		= $mailinglist['participant_email'];
		$data['_comm_html']			= $message;
		$data['_comm_reference']	= $reference;
		
		if(isset($mailinglist['job_code'])) {
			$data['item_code']	= $mailinglist['job_code'];
		} else if(isset($mailinglist['job_code'])) {
			$data['item_code']	= $mailinglist['job_code'];
		}
		
		$this->insert($data);

		try {
			$mail->send();
			$data['_comm_sent']	= 1;	
			$data['_comm_output']	= 'Email Sent!';
			
		} catch (Exception $e) {
			$data['_comm_sent']		= 0;	
			$data['_comm_output']	= $e->getMessage();
		}
		
		$where = $this->getAdapter()->quoteInto('_comm_code = ?', $data['_comm_code']);
		$success = $this->update($data, $where);
		
		$mail = null; unset($mail);
		$return = $data['_comm_sent'] == 1 ? $data['_comm_code'] : false;
		
		return $return;
	}
	
	public function sendEnquiry($template, $enquiry, $subject, array $to) {
		
		require_once 'config/smarty.php';
		
		global $smarty;
		
		require_once('Zend/Mail.php');
		
		$mail = new Zend_Mail();
		$data								= array();
		$data['_comm_code']	= $this->createReference();
		
		$smarty->assign('enquiry', $enquiry);	
		$smarty->assign('tracking', $data['_comm_code']);
		$smarty->assign('domain', $_SERVER['HTTP_HOST']);
		
		$message = $smarty->fetch($template);

		/* Check for attachements. */
		if($enquiry['enquiry_file_path'] != '') {
			$at = new Zend_Mime_Part(file_get_contents($_SERVER['DOCUMENT_ROOT'].$enquiry['enquiry_file_path'] ));
			$at->disposition = Zend_Mime::DISPOSITION_INLINE;
			$at->encoding 	= Zend_Mime::ENCODING_BASE64;
			$at->filename 	= $enquiry['enquiry_file_name'] ;

			$mail->addAttachment($at);
		}
		
		$mail->setFrom('info@willowvine.co.za', 'Willowvine'); //EDIT!!		

		for($z = 0; $z < count($to); $z++) {
			$mail->addTo($to[$z]['email'], $to[$z]['name']);
		}

		$mail->setSubject($subject);
		$mail->setBodyHtml($message);			

		/* Save data to the comms table. */
		$data['participant_code']	= isset($enquiry['participant_code']) && trim($enquiry['participant_code']) != '' ? $enquiry['participant_code'] : null;
		$data['mailinglist_code']		= isset($enquiry['mailinglist_code']) && trim($enquiry['mailinglist_code']) != '' ? $enquiry['mailinglist_code'] : null;
		$data['_comm_type']			= 'EMAIL';
		$data['_comm_name']		= $subject;
		$data['_comm_sent']			= null;
		$data['_comm_email']		= $enquiry['enquiry_email'];
		$data['_comm_html']			= $message;
		$data['_comm_reference']	= $enquiry['enquiry_reference'];
		$data['item_code']				= $enquiry['enquiry_code'];

		$this->insert($data);

		try {
			$mail->send();
			$data['_comm_sent']	= 1;	
			$data['_comm_output']	= 'Email Sent!';
			
		} catch (Exception $e) {
			$data['_comm_sent']		= 0;	
			$data['_comm_output']	= $e->getMessage();
		}
		
		$where = $this->getAdapter()->quoteInto('_comm_code = ?', $data['_comm_code']);
		$success = $this->update($data, $where);
		
		$mail = null; unset($mail);
		$return = $data['_comm_sent'] == 1 ? $data['_comm_code'] : false;

		return $return;
	}
	
	public function sendShare($template, $shareData) {
		
		require_once('config/smarty.php');
				
		global $smarty;		
		
		require_once('Zend/Mail.php');
		
		$mail = new Zend_Mail();
		$data						= array();
		$data['_comm_code']	= $this->createReference();
		
		$smarty->assign('shareData', $shareData);	
		$smarty->assign('tracking', $data['_comm_code']);
		$smarty->assign('domain', $_SERVER['HTTP_HOST']);
		
		$message = $smarty->fetch($template);
		
		$mail->setFrom('info@willowvine.co.za', 'Willowvine'); //EDIT!!		
		$mail->addTo($shareData['share_email']);
		$mail->addTo($shareData['share_friendemail']);
		$mail->setSubject('Willowvine -  '.ucfirst(strtolower($shareData['share_type'])).' shared');
		$mail->setBodyHtml($message);			

		/* Save data to the comms table. */
		$data['participant_code']		= $shareData['participant_code'];
		$data['_comm_type']				= 'EMAIL';
		$data['_comm_name']			= 'Willowvine -  '.ucfirst(strtolower($shareData['share_type'])).' shared by '.$shareData['share_name'];
		$data['_comm_sent']				= null;
		$data['_comm_email']			= $shareData['share_email'];
		$data['_comm_html']				= $message;
		$data['_comm_reference']		= 'SHARE';
		$data['item_code']					= $shareData['share_code'];
		
		$this->insert($data);

		try {		
			$mail->send();
			$data['_comm_sent']	= 1;	
			$data['_comm_output']	= 'Email Sent!';
			
		} catch (Exception $e) {
			$data['_comm_sent']		= 0;	
			$data['_comm_output']	= $e->getMessage();
		}
		
		$where = $this->getAdapter()->quoteInto('_comm_code = ?', $data['_comm_code']);
		$success = $this->update($data, $where);
		
		$mail = null; unset($mail);
		$return = $data['_comm_sent'] == 1 ? $data['_comm_code'] : false;
		
		return $return;
	}
	
	public function sendSpam($spamData, $messageData, $message) {
		
		require_once('Zend/Mail.php');
		
		$mail = null; unset($mail);
		$mail = new Zend_Mail();

		$data				= array();
		$data['_comm_code']	= $this->createReference();
		
		$message = str_replace('[fullname]', $spamData['spam_name'], $message);
		$message = str_replace('[cellphone]', $spamData['spam_cellphone'], $message);
		$message = str_replace('[email]', $spamData['spam_email'], $message);
		$message = str_replace('[tracking]', $data['_comm_code'], $message);
		$message = str_replace('[datetime]', date("F j, Y, g:i a"), $message);
		$message = str_replace('[date]', date("F j, Y, g:i a"), $message);

		$mail->setFrom('info@willowvine.co.za', 'Willowvine'); //EDIT!!
		//$mail->addTo($spamData['spam_email']);
		$mail->addTo('mzimhle.mosiwe@gmail.com');
		$mail->setSubject($messageData['_message_subject']);
		$mail->setBodyHtml($message);			

		/* Save data to the comms table. */
		$data['mailinglist_code']		= isset($spamData['mailinglist_code']) && trim($spamData['mailinglist_code']) != '' ? $spamData['mailinglist_code'] : null;
		$data['_comm_type']			= 'EMAIL';
		$data['_comm_name']		= $messageData['_message_subject'];
		$data['_comm_sent']			= null;
		$data['_comm_email']		= $spamData['spam_email'];
		$data['_comm_cell']			= $spamData['spam_cellphone'];
		$data['_comm_html']			= $message;
		$data['_comm_reference']	= 'SPAM';
		$data['item_code']				= $messageData['_message_code'];
		$data['spam_code']			= $spamData['spam_code'];

		$this->insert($data);
		$return = false;
		
		try {
			$mail->send();
			$data['_comm_sent']	= 1;
			$return = $data['_comm_code'];
			$data['_comm_output']	= 'Email Sent!';
			
		} catch (Exception $e) {
			$data['_comm_sent']	= 0;	
			$return = 0;
			$data['_comm_output']	= $e->getMessage();
		}
		
		$where = $this->getAdapter()->quoteInto('_comm_code = ?', $data['_comm_code']);
		$success = $this->update($data, $where);
		
		return $return;
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getCode($reference)
	{
		$select = $this->_db->select()	
						->from(array('_comm' => '_comm'))		
					   ->where('_comm_code = ?', $reference)
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;				   		
	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		$codeAlphabet = "123456789";

		$count = strlen($codeAlphabet) - 1;
		
		for($i=0;$i<15;$i++) {
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

	function reference() {
		return date('Y-m-d-H:i:s');
	}	
}
?>