<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );
$public_access =  true;
require_once "../lib/autoload.php";

header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Credentials 'true'");

//Allow GET, POST, PUT, DELETE, OPTIONS http methods
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

//Allow some types of headers
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

//Set response content type and character set
header("Content-Type: application/json; charset=UTF-8");

//Hardcoded authenticatie toegevoegd
/* if ( $_SERVER['PHP_AUTH_USER'] !== "denes123" OR $_SERVER['PHP_AUTH_PW'] !== "dnsvr123" )
{
    //als er geen juiste credentials doorgegeven worden, afbreken met code 401 Unauthorized
    header('WWW-Authenticate: Basic realm="Provide your username and password for the Voorbeeld API"');
    header('HTTP/1.0 401 Unauthorized');
    exit;
} */

$method = $_SERVER['REQUEST_METHOD'];
$request_uri = $_SERVER['REQUEST_URI'];

$parts = explode("/", $request_uri);
$request_part = $parts[4];

if ( count($parts) > 5 ) $id = $parts[5];

//errors
if ( $method == "GET" AND $request_part != "btwcodes" AND $request_part != "btwcode" )
{
    print json_encode( [ "msg" => "Deze combinatie van Resource en Method is niet toegelaten" ] ) ;
    exit;
}

//GET btwcodes: alle btwcodes geven
if ( $method == "GET" AND $request_part == "btwcodes" )
{
    $sql = "select * from eu_btw_codes";
    $data = $container->getDBManager()->GetData( $sql, 'assoc');

    print json_encode( [ "msg" => "OK", "data" => $data ] ) ;
    exit;
}

//GET btwcode: één btwcode geven
if ( $method == "GET" AND $request_part == "btwcode" )
{
    if(is_numeric($id)) {
    $sql = "select * from eu_btw_codes where eub_id=$id";
    $data = $container->getDBManager()->GetData( $sql, 'assoc');


        print json_encode(["msg" => "OK", "data" => $data]);
        exit;
    } else {
        print json_encode(["msg" => "NOT"]);
        exit;
    }
}

//POST btwcodes: een btwcode toevoegen
if ( $method == "POST" AND $request_part == "btwcodes" )
{
    //$code = $_POST["code"];
    //$land = $_POST["land"];
    $contents = json_decode( file_get_contents("php://input") );
    $newCode = $contents->code;
    $newLand = $contents->land;
    $sql = "INSERT INTO eu_btw_codes SET eub_land='$newLand', eub_code='$newCode'";
    $data = $container->getDBManager()->ExecuteSQL( $sql );

    http_response_code(201);
    print json_encode( [ "msg" =>"BTW code $newCode - $newLand aangemaakt", "id" => $container->getDBManager()->GetData( "SELECT MAX(eub_id) FROM eu_btw_codes", 'assoc' )[0]['MAX(eub_id)'] ] ) ;
    exit;
}

//PUT btwcode: een btwcode updaten
if ( $method == "PUT" AND $request_part == "btwcode" )
{
    $contents = json_decode( file_get_contents("php://input") );
    $newCode = $contents->code;
    $newLand = $contents->land;

    $sql = "UPDATE eu_btw_codes SET eub_code='$newCode', eub_land='$newLand' WHERE eub_id=$id";
    $data = $container->getDBManager()->ExecuteSQL( $sql );

    print json_encode( [ "msg" =>"OK", "info" =>"BTW code $newCode - $newLand gewijzigd" ] ) ;
    exit;
}

//DELETE btwcode: een btwcode verwijderen
if ( $method == "DELETE" AND $request_part == "btwcode" )
{
    $sql = "DELETE FROM eu_btw_codes where eub_id=$id";
    $data = $container->getDBManager()->ExecuteSQL( $sql );

    print json_encode( [ "msg" => "OK", "info" => "BTW code $id verwijderd" ] ) ;
    exit;
}

if ($id && $request_part == "btwcodes") {
    print json_encode(["msg" => 'Deze combinatie van Request en Method is niet toegelaten']);
    exit;
}
