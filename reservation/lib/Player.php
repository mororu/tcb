<?php
	/**
	 * Player Class 
	 *
	 * Business class for Player
	 * 
	 * @author Manuel Wyss <wyssmanuel@me.com>
	 * @copyright 2014 Manuel Wyss
	 * @version 1.0
	 * @link
	 */	
	
	namespace ch\tcbuttisholz\tcbtcr\lib;
	
	use ch\tcbuttisholz\tcbtcr\utils\AbstractDomainObject;
	
	class Player extends AbstractDomainObject {
	 
		/**
		 * @private
		 * Player name
		 */
		 private $name;

		/** 
		 * @private
		 * Player email adresse
		 */
		 private $email;
		 
		/** 
		 * @private
		 * Flag for new player
		 */
		 private $newPlayer = true; 
		 
		/**
		 * @public 
		 * Constructor
		 */
		 public function __construct() {
		 	
		 }
		 
		/**
		 * @public
		 * Set the player name 
		 * 
		 * @param $name
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 02.03.2014
		 */
		 public function setName($name) {
			 $this->name = $name;
		 }
		 
		 /**
		 * @public
		 * Returns the name of the player
		 * 
		 * @return $name
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 02.03.2014
		 */
		 public function getName() {
		 	return $this->name;
		 }
					 
		 /**
		 * @public
		 * Set the player email 
		 * 
		 * @param email
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 02.03.2014
		 */
		 public function setEmail($email) {
		 	$this->email = $email;
		 }
		 
		 /**
		 * @public
		 * Returns the email of the player
		 * 
		 * @return email
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 02.03.2014
		 */
		 public function getEmail() {
		 	return $this->email;
		 }
		 
		 /**
		 * @public
		 * Returns the new creation flag of the player
		 * 
		 * @return newPlayer
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 05.03.2014
		 */
		 public function getNewPlayer() {
		 	return $this->newPlayer;
		 }
		 
		/**
		 * @public
		 * Set the newPlayer flag, if the player is not in the database
		 * 
		 * @param newPlayer
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 05.03.2014
		 */
		 public function setNewPlayer($newPlayer) {
		 	$this->newPlayer = $newPlayer;
		 }
		 
	}
	
?>