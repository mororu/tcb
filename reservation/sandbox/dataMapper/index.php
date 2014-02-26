<?php
		
	use ch\tcbuttisholz\tcbtcr\utils\PlayerMapper;
	use ch\tcbuttisholz\tcbtcr\utils\Player;
	
	include('AbstractMapper.php');
	include('AbstractDomainObject.php');
	include('Player.php');
	include('PlayerMapper.php');
	include('DataBase.php');

	$db = DataBase::getConnection();
	
	$playerMapper = new PlayerMapper($db);
	
	$player = new Player();
	$player->setFirstName('Peter');
	$player->setLastName('Meier');
	$playerMapper->save($player);

?>