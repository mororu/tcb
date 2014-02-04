<?php
	include('requestInterface.php');
	include('responseInterface.php');
	include('commandInterface.php');
	include('commandResolverInterface.php');
	include('httpRequest.php');
	include('httpResponse.php');
	include('FileSystemCommandResolver.php');
	include('frontController.php');
		
	use ch\tcbuttisholz\frontcontroller\mvc\request\HttpRequest;
	use ch\tcbuttisholz\frontcontroller\mvc\response\HttpResponse;
	use ch\tcbuttisholz\frontcontroller\mvc\command\FileSystemCommandResolver;
	use ch\tcbuttisholz\frontcontroller\mvc\FrontController;
	
	$resolver = new FileSystemCommandResolver('commands', 'HelloWorld');
	$controller = new FrontController($resolver);

	$request = new HttpRequest();
	$response = new HttpResponse(); 
	
	$controller->handleRequest($request, $response);
	
	/*
	$resolver = new FileSystemCommandResolver('commands', 'HelloWorld');
	$command = $resolver->getCommand($request);
	$command->execute($request, $response);
	
	//$command = new HelloWorldCommand();
	//$commandBrowser = new BrowserInfoCommand();
	
	//$command->execute($request, $response);
	
	//$commandBrowser->execute($request, $response);
	$response->flush();
	 * 
	 */
?>