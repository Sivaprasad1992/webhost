<?php

//require_once("UserService.php");
require_once("ServiceController.php");

//to get post or get or .. request method type
$method = $_SERVER['REQUEST_METHOD'];
//echo $method."\n";

//to get data type like xml or json or text type
$requestContentType = $_SERVER["CONTENT_TYPE"];
//echo $requestContentType."\n";

//to get values from url that attached 
$userRequest = "";
if(isset($_GET["userRequest"]))
{
    $userRequest = $_GET["userRequest"];
}
else
{
    $userRequest="faultRequest";
}

$rh = new RequestHandler();


$rawData = array('error' => 'No mobiles found!',
'method' => $method);

$rawData = json_decode(file_get_contents('php://input'),true);

if(strpos($requestContentType,'application/json') !== false)
{
    //here we are converting data from json object to an array
    $json = json_decode(file_get_contents('php://input'),true);
    $raw = $rh -> Request_Handler($userRequest, $json);
    $response = encodeJson($raw);
    echo $response."\n";
}
else if(strpos($requestContentType,'text/html') !== false)
{
    print_r($_REQUEST."\n");
    //echo $response;
}
else if(strpos($requestContentType,'application/xml') !== false)
{
    $response = new SimpleXMLElement($response);
    print_r($_REQUEST."\n");
    //echo $response;
}
else
{
    
}

function encodeXml($responseData) {
		// creating object of SimpleXMLElement
		$xml = new SimpleXMLElement('<?xml version="1.0"?><mobile></mobile>');
		foreach($responseData as $key=>$value) {
			$xml->addChild($key, $value);
		}
		return $xml->asXML();
	}
	
function encodeHtml($responseData) {
	
		$htmlResponse = "<table border='1'>";
		foreach($responseData as $key=>$value) {
    			$htmlResponse .= "<tr><td>". $key. "</td><td>". $value. "</td></tr>";
		}
		$htmlResponse .= "</table>";
		return $htmlResponse;		
	}
	
	
function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}

?>