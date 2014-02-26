<?php

	namespace ch\tcbuttisholz\tcbtcr\utils;
	
	abstract class AbstractDomainObject {
		
		/**
		 * @protected 
		 * Object Id
		 */
		 protected $objectId = null;
		 
		/**
		 * @public 
		 * Gets the id of the object
		 * 
		 * @return $objectId
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 26.02.2014
		 */
		 public function getId() {
		 	return $this->objectId;
		 }
		 
		/**
		 * @public 
		 * Sets the id of the object
		 * 
		 * @param $id
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 26.02.2014
		 */
		 public function setId($id) {
		 	$this->objectId = $id;
		 }
		
	}
