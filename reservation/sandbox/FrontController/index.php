<?php
	include('requestInterface.php');
	include('responseInterface.php');
	include('commandInterface.php');
	include('httpRequest.php');
	include('httpResponse.php');
	include('HelloWorldCommand.php');
	
	use ch\tcbuttisholz\frontcontroller\mvc\request\HttpRequest;
	use ch\tcbuttisholz\frontcontroller\mvc\response\HttpResponse;
	use ch\tcbuttisholz\frontcontroller\mvc\command\HelloWorldCommand;
	use ch\tcbuttisholz\frontcontroller\mvc\command\BrowserInfoCommand;

	$request = new HttpRequest();
	$response = new HttpResponse(); 
	$command = new HelloWorldCommand();
	$commandBrowser = new BrowserInfoCommand();
	
	$command->execute($request, $response);
	
	$commandBrowser->execute($request, $response);
	$response->flush();
	
	/*
	if($request->issetParameter('Name')) {
		$response->write("Hallo ");
		$response->write($request->getParameter('Name'));
	} else {
		$response->write("Else");				
	}
	
	$response->flush();
	 */
	 
?>