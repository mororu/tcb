<?php
	
	include("db.php");
	
	$db = DataBase::getConnection();
	
	$playerMapper = new PlayerMapper($db);
	
	if (isset($_GET['id'])) {
		$player = $playerMapper->findById($_GET['id']);
	}
		
	$newPlayer = array('Max','Muster');
	$statement = "SELECT * FROM players WHERE pla_name = ? AND pla_surname = ?";
	$rows = $db->select($statement, $newPlayer);
	
	$player = new Player();
	$player->lastName = 'Permamüller';
	$player->id = 900;
	$player->firstName = 'Kevin';	
	$playerMapper->save($player);

	echo $player->getFullName();
		
	abstract class MapperAbstract
	{
		public function create($data = null) {
			$obj = $this->createObject();
			if ($data) {
				$obj = $this->populate($obj, $data);
			}
			return $obj;
		}

		public function save(DomainObjectAbstract $obj)
		{
			if (is_null($obj->getId())) {
				$this->_insert($obj);
			} else {
				$this->_update($obj);
			}
		}

		public function delete(DomainObjectAbstract $obj)
		{
			$this->_delete($obj);
		}

		abstract public function populate(DomainObjectAbstract $obj, $data);
		abstract protected function createObject();
		abstract protected function _insert(DomainObjectAbstract $obj);
		abstract protected function _update(DomainObjectAbstract $obj);
		abstract protected function _delete(DomainObjectAbstract $obj);
	}
	
	abstract class DomainObjectAbstract
	{
		protected $_id = null;

		public function getId()
		{
			return $this->_id;
		}

		public function setId($id)
		{
			if (!is_null($this->_id)) {
				throw new Exception('ID is immutable');
			}
			return $this->_id = $id;
		}
	}
	
	class Player extends DomainObjectAbstract {
		
		public $firstName;
		public $lastName;
		public $email;
		
		public function setId($id) {
			$this->_id = $id;
		}
		
		public function getFirstName() {
			return $this->firstName;
		}
		
		public function getLastName() {
			return $this->lastName;
		}
		
		public function getEmail() {
			return $this->email;
		}
		
		public function getFullName() {
			return $this->firstName.' '.$this->lastName;
		}
	}
	
	class PlayerMapper extends MapperAbstract
	{
		private $db;
		private $lastInsertId;
		
		public function __construct($db) {
			$this->db = $db;
		}
	
		public function findById($id)
		{
			$statement = "SELECT * FROM players WHERE pla_id = ?";
			$data = array($id);
			
			$row = $this->db->select($statement, $data);
			
			return $this->create($row[0]);
		}

		public function populate(DomainObjectAbstract $obj, $data)
		{
			$obj->setId($data->pla_id);
			$obj->firstName = $data->pla_surname;
			$obj->lastName  = $data->pla_name;
			$obj->email  = $data->pla_email;
			return $obj;
		}

		protected function createObject()
		{
			return new Player();
		}

		protected function _insert(DomainObjectAbstract $obj)
		{
			$data = array($obj->lastName, $obj->firstName, $obj->email);
			$statement = "INSERT INTO players (pla_name, pla_surname, pla_email) VALUES (?,?,?)";
			$this->db->modify($statement, $data);
		}

		protected function _update(DomainObjectAbstract $obj)
		{
			// ...
		}

		protected function _delete(DomainObjectAbstract $obj)
		{
			// ...
		}
	}
	
	
	
?>