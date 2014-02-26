<?php
	/**
	 * Player Class 
	 *
	 * Business class for the players table
	 * 
	 * @author Manuel Wyss <wyssmanuel@me.com>
	 * @copyright 2014 Manuel Wyss
	 * @version 1.0
	 * @link
	 */	
	
	namespace ch\tcbuttisholz\tcbtcr\application;
	
	use ch\tcbuttisholz\tcbtcr\utils\AbstractDomainObject;
	
	class Player {
		
		/**
		 * @private
		 * Last name
		 */
		 private $lastName;
		 
		/**
		 * @private
		 * first name
		 */
		 private $firstName;
		 
		/**
		 * @private
		 * email
		 */
		 private $email;
		 
		/**
		 * @public
		 * Constructor
		 * 
		 * @param
		 * 
		 * @author Manuel Wyss 
		 * @version 0.1, 22.02.2014
		 */
		 public function __construct() {
		 
		 }
		 
		/** 
		 * @public 
		 * Set the id of the player
		 * 
		 * @param $id
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 26.02.2014
		 */
		 public function setId($id) {
		 	$this->objectId = $id;
		 }
		 
		/** 
		 * @public 
		 * Gets the id of the player
		 * 
		 * @return $id
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 26.02.2014
		 */
		 public function getId() {
		 	return $this->objectId;
		 } 
		 
		/**
		 * @public 
		 * Get the first name of the player
		 * 
		 * @return $firstName
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 22.02.2014
		 */
		 public function getFirstName() {
		 	return $this->firstName;
		 }
		 
		/**
		 * @public
		 * Sets the firstname of the player
		 * 
		 * @param $firstName
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 22.02.2014
		 */
		 public function setFirstName($firstName) {
		 	$this->firstName = $firstName;
		 }
		
		/**
		 * @public 
		 * Get the last name of the player
		 * 
		 * @return $lastName
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 22.02.2014
		 */
		 public function getLastName() {
		 	return $this->lastName;
		 }
		
		/**
		 * @public
		 * Sets the lastname of the player
		 * 
		 * @param $lastName
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 22.02.2014
		 */
		 public function setLastName($lastName) {
		 	$this->lastName = $lastName;
		 }
		 
		/**
		 * @public 
		 * Get the email of the player
		 * 
		 * @return $email
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 22.02.2014
		 */
		 public function getEmail() {
		 	return $this->email;
		 }
		 
		/**
		 * @public
		 * Sets the email of the player
		 * 
		 * @param $email
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 22.02.2014
		 */
		 public function setEmail($email) {
		 	$this->email = $email;
		 }
		
	}
?>