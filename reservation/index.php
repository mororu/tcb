<?php
	/**
	 * --------------------------------------------
	 * index.php
	 * --------------------------------------------
	 * Autor: Manuel Wyss
	 * Date:  11.02.2014
	 * --------------------------------------------
	 */
	namespace ch\tcbuttisholz\tcbtcr;
	
	/**
	 * Including
	 */
	include('utils/interfaces.php');
	include('utils/httpRequest.php');
	include('utils/httpResponse.php');
	include('utils/commandResolverClass.php');	
	include('utils/frontController.php');
	include('utils/debugger.php');
	include('utils/template.php');
	include('utils/commands/command.php');
	include('utils/DataBase.php');
	include('utils/AbstractDomainObject.php');
	include('utils/AbstractMapper.php');
	include('lib/Booking.php');
	include('lib/BookingMapper.php');
	include('lib/Player.php');
	include('lib/playerMapper.php');
	include('lib/calendar.php');
	include('lib/day.php');
	include('lib/hour.php');
	include('lib/Court.php');
				
	/**
	 * Usings
	 */
	use ch\tcbuttisholz\tcbtcr\utils\request\HttpRequest;
	use ch\tcbuttisholz\tcbtcr\utils\response\HttpResponse;
	use ch\tcbuttisholz\tcbtcr\utils\command\CommandResolverClass;
	use ch\tcbuttisholz\tcbtcr\utils\FrontController;
	use ch\tcbuttisholz\tcbtcr\utils\debugger\TcbTcrPrint;
	use ch\tcbuttisholz\tcbtcr\utils\debugger\TcbTcrLogger;
	use ch\tcbuttisholz\tcbtcr\utils\debugger\DebugFactory;
	use ch\tcbuttisholz\tcbtcr\utils\template\Template;
	
	/**
	 * App setting definition
	 */
	define('COMMAND_FOLDER', 'utils/commands');
	define('DEFAULT_COMMAND', 'calendar');
	define('DEBUG_MODE', 'log');
	define('LOG_FILE', 'TcbTcr.log');
	
	$debugger = DebugFactory::createDebugger(DEBUG_MODE, LOG_FILE);
	/*
	$tpl = new Template('views/headerTemplate.php', $debugger);
	$content = $tpl->parse('views/headerTemplate.php');
	$tpl->content = $content;
	echo $tpl;	
	*/
	
	$resolver = new CommandResolverClass(COMMAND_FOLDER, DEFAULT_COMMAND, $debugger);
	$controller = new FrontController($resolver, $debugger);

	$request = new HttpRequest();
	$request->debugger = $debugger;
	$response = new HttpResponse(); 
	
	$controller->handleRequest($request, $response);
	
?>