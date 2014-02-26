<?php
	
	namespace ch\tcbuttisholz\tcbtcr\utils;
	
	use ch\tcbuttisholz\tcbtcr\utils\AbstractDomainObject;
	
	abstract class AbstractMapper {
		
		/**
		 * @public
		 * Creates an object and populates the content
		 * 
		 * @param $data
		 * @return $object instance
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 26.02.2014
		 */
		 public function create($data = null) {
		 		
		 	$obj = $this->createObject();
			
			if($data) {
				$obj = $this->populate($obj, $data);
			}
			
			return $obj;
		 }
		 
		/**
		 * @public
		 * Saves the object as entity
		 * 
		 * @param $obj Object instance of type AbstractDomainObject
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 26.02.2014
		 */
		 public function save(AbstractDomainObject $obj) {
		 	
			if(is_null($obj->getId())) {
				$this->insertObject($obj);
			} else {
				$this->updateObject($obj);
			}
		 }
		 
		/**
		 * @public
		 * Deletes an entity
		 * 
		 * @param $obj Object instance of type AbstractDomainObject
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 26.02.2014
		 */
		 public function delete(AbstractDomainObject $obj) {
		 	$this->deleteObject($obj);
		 }
		 
		 abstract protected function populate(AbstractDomainObject $obj, $data);
		 abstract protected function createObject();
		 abstract protected function insertObject(AbstractDomainObject $obj);
		 abstract protected function updateObject(AbstractDomainObject $obj);
		 abstract protected function deleteObject(AbstractDomainObject $obj);
	}

?>