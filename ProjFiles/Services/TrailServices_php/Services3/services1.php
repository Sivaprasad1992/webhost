<?php

//url:http://localhost:8052/WebHosts-master/ProjFiles/Services/Services3/servicestest.php?table=frddffdgdf&key=20
$json = file_get_contents('php://input');
$req_details = $json;
echo ($req_details);
//exit;
print_r($_REQUEST);
//exit;

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);
$json = file_get_contents('php://input');
$inputs = json_decode($json);


var_dump($input);
var_dump($inputs);
var_dump($json);

$table="";
$key="";
if(isset($_GET["table"]))
{
    $table = $_GET["table"];
}
else
{
    $table="Hello";
}

if(isset($_GET["key"]))
{
    $key = $_GET["key"];
}
else
{
    $key="World";
}
/*
$table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
echo $table;
$key = array_shift($request)+0;
echo $key;
*/
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
/*  
// connect to the mysql database
$link = mysqli_connect('localhost', 'user', 'pass', 'dbname');
mysqli_set_charset($link,'utf8');


// retrieve the table and key from the path
$table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
$key = array_shift($request)+0;

 
// escape the columns and values from the input object
$columns = preg_replace('/[^a-z0-9_]+/i','',array_keys($input));
$values = array_map(function ($value) use ($link) {
  if ($value===null) return null;
  return mysqli_real_escape_string($link,(string)$value);
},array_values($input));
 
// build the SET part of the SQL command
$set = '';
for ($i=0;$i<count($columns);$i++) {
  $set.=($i>0?',':'').'`'.$columns[$i].'`=';
  $set.=($values[$i]===null?'NULL':'"'.$values[$i].'"');
}
 
// create SQL based on HTTP method
switch ($method) {
  case 'GET':
    $sql = "select * from `$table`".($key?" WHERE id=$key":''); break;
  case 'PUT':
    $sql = "update `$table` set $set where id=$key"; break;
  case 'POST':
    $sql = "insert into `$table` set $set"; break;
  case 'DELETE':
    $sql = "delete `$table` where id=$key"; break;
}
 
// excecute SQL statement
$result = mysqli_query($link,$sql);
 
// die if SQL statement failed
if (!$result) {
  http_response_code(404);
  die(mysqli_error());
}
 
// print results, insert id or affected row count
if ($method == 'GET') {
  if (!$key) echo '[';
  for ($i=0;$i<mysqli_num_rows($result);$i++) {
    echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
  }
  if (!$key) echo ']';
} elseif ($method == 'POST') {
  echo mysqli_insert_id($link);
} else {
  echo mysqli_affected_rows($link);
}
 
// close mysql connection
mysqli_close($link);
*/

$rawData = array('error' => 'No mobiles found!',
'method' => $method,
'input' => $input,
'input0' => $json,
'input1' => $inputs[0],
'input2' => $inputs[1],
'input3' => $_REQUEST->{'table'},
//'input1' => $inputs->{'table'},
//'input2' => $inputs->{'key'},
'value1' => $table,
'value2' => $key,
'value3' => 'bye-bye');
//$response = encodeXml($rawData);
//$response = encodeHtml($rawData);
$response = encodeJson($rawData);


echo $response;

?>