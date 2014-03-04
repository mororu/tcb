<?php
	
	class Person implements \IteratorAggregate {

		private $men = array();
		public $name;
		public $age;
				
		public function __construct($name, $age) {
			$this->name = $name;
			$this->age = $age;
		}
		
		public function addMen($man) {
			array_push($this->men, $man);
		}
		
		public function getIterator() {
			return new ArrayIterator($this->men);
		}
	}
	
	class Group implements \IteratorAggregate {
		
		private $peoples = array();
		
		public function addPerson($person) {
			array_push($this->peoples, $person);
		}
		
		public function getIterator() {
			return new ArrayIterator($this->peoples);
		}
	}
	
	class Man {
		public $gender = 'm';
		public $age;
		
		public function __construct($age) {
			$this->age = $age;
		}
	}
	
	$group = new Group();
	
	$manuel = new Person('Manuel', 29);
	$manuel->addMen(new Man(29));
	$hans = new Person('Hans', 47);
	$hans->addMen(new Man(47));
	
	$group->addPerson($manuel);
	$group->addPerson($hans);
	
	$iterator = $group->getIterator();
	
	function recursive($object) {
		
		if ($object instanceof IteratorAggregate) {
			
			foreach($object->getIterator() as $key=>$obj) {
				recursive($obj);
			}
				
		} else {
			echo "{$object->age} <br />";
		}
		
	}
	
	foreach($iterator as $key=>$object) {
		recursive($object);
	}

?>