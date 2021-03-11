<?php
$public_access =  true;
require_once "../lib/autoload.php";
header("Access-Control-Allow-Origin: 'https://gf.dev'");


header("Access-Control-Allow-Credentials 'true'");


//Allow GET, POST, PUT, DELETE, OPTIONS http methods
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

//Allow some types of headers
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

//Set response content type and character set
header("Content-Type: application/json; charset=UTF-8");



$method = $_SERVER['REQUEST_METHOD'];
$request_uri = $_SERVER['REQUEST_URI'];

$parts = explode("/", $request_uri);

//zoek "rest" in de uri
for ( $i=0; $i<count($parts) ;$i++)
{
    if ( $parts[$i] == "rest" )
    {
        break;
    }
}

$request_part = $parts[$i+2];
if ( count($parts) > $i + 3 ) $id = $parts[$i + 3];

//GET btwcodes: alle btwcodes geven
if ( $method == "GET" AND $request_part == "btwcodes" )
{
    $sql = "select * from eu_btw_codes";
    // ... execute $sql
    print json_encode( [ "msg" => $sql ] ) ;
}

//GET btwcode: één btwcode geven
if ( $method == "GET" AND $request_part == "btwcode" )
{
    $sql = "select * from eu_btw_codes where eub_id=$id";
    // ... execute $sql
    print json_encode( [ "msg" => $sql ] ) ;
}

//POST btwcodes: een btwcode toevoegen
if ( $method == "POST" AND $request_part == "btwcodes"  )
{
    $code = $_POST["code"];
    $sql = "INSERT INTO eu_btw_codes SET eub_code='$code' ";
    // ... execute $sql
    http_response_code(201);
    print json_encode( [ "msg" => $sql ] ) ;
}

//PUT btwcode: een btwcode updaten
if ( $method == "PUT" AND $request_part == "btwcode" )
{
    $contents = json_decode( file_get_contents("php://input") );
    $newdata = $contents->code;

    $sql = "UPDATE eu_btw_codes SET eub_code='$newdata' WHERE eub_id=$id";
    // ... execute $sql
    print json_encode( [ "msg" => $sql ] ) ;
}

//DELETE btwcode: een btwcode verwijderen
if ( $method == "DELETE" AND $request_part == "btwcode" )
{
    $sql = "DELETE FROM eu_btw_codes WHERE eub_id=$id";
    // ... execute $sql
    print json_encode( [ "msg" => $sql ] ) ;
}

?>

