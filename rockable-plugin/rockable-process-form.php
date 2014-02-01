<?php
/**
* @package procForm
* @author Joe Casabona 
* @description Class that processes HTML forms and emails them to a specified address.
**/


class RockableProcessForm{

	var $email;
	var $mess;
	

	/**
	* constructor
	* @param string $email the email address to send the form 
	* results to.
	**/
	function __construct($email){
		$this->email= $email;
	}
	
	/**
	*function clean removes HTML entitiles, slashs, and extraineous spaces from
	* the string passed to it
	* @param $item a string to be cleaned
	* @return a cleaned version of item
	**/
	function clean($item){
		return trim(htmlentities(strip_tags($item)));
	}


	/**
	* function handleChecks creates a comma separated string
	* from an array of checkboxes.
	* @param $info an array containing checked off boxes from a form
	* @return a comma separated string of the checkbox results
	**/
	function handleChecks($info){
		return implode(", ", $info);
	}
	
	/**
	* function email uses PHP mail() to send an email to the address specified 
	* from the constructor and prints message to user.
	* @param $subject is the subject of the email
	* @param $message is the body of the email
	* @param $from is the from address for the email. Defaults to null
	* @param $msg is the message to display to the user. Defaults to 
	* "Thanks! Your message has been sent."
	**/
	function email($subject, $message, $from=NULL, $msg=''){
		if(mail($this->email, $subject, $message, "From: $from")){
		
			if($msg != ''){ 
				$this->mess= $msg;
			}else{
				$this->mess= "Thanks! Your message has been sent.";
			}
		
		}else{
			$this->mess= "Uh Oh! There was a problem processing your message.";
		}
	
	
		return $this->mess;
	}



	/**
	* function buildMsg builds a string that will serve as the email body.
	* @param $info is array from HTML form.
	* @return $message a string produced from processing the array
	**/
	function buildMsg($info){
		$message= "";
		
		foreach($info as $key => $value){
			if(is_array($value)){ $value= $this->handleChecks($value); }
				$message.= "{$key}: ". $this->clean($value) ." \n"; 
			}
	
		return $message;
	}


}

?>