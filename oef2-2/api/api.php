<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );
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
$request_part = $parts[4];

if ( count($parts) > 5 ) $id = $parts[5];

//GET btwcodes: alle btwcodes geven
if ( $method == "GET" AND $request_part == "btwcodes" )
{
    $sql = "select * from eu_btw_codes";
    $data = $container->getDBManager()->GetData( $sql, 'assoc');

    print json_encode( [ "msg" => "OK", "data" => $data ] ) ;
}

//GET btwcode: één btwcode geven
if ( $method == "GET" AND $request_part == "btwcode" )
{
    $sql = "select * from eu_btw_codes where eub_id=$id";
    $data = $container->getDBManager()->GetData( $sql, 'assoc');

    print json_encode( [ "msg" => "OK", "data" => $data ] ) ;
}

//POST btwcodes: een btwcode toevoegen
if ( $method == "POST" AND $request_part == "btwcodes"  )
{
    $code = $_POST["code"];
    $land = $_POST["land"];
    $sql = "INSERT INTO eu_btw_codes SET eub_land='$land', eub_code='$code'";
    $data = $container->getDBManager()->ExecuteSQL( $sql );

    http_response_code(201);
    print json_encode( [ "msg" =>"BTW code $code - $land aangemaakt", "id" => $container->getDBManager()->GetData( "SELECT MAX(eub_id) FROM eu_btw_codes", 'assoc' )[0]['MAX(eub_id)'] ] ) ;
    //eub_id nog toevoegen in json_encode
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
}

//DELETE btwcode: een btwcode verwijderen
if ( $method == "DELETE" AND $request_part == "btwcode" )
{
    $sql = "DELETE FROM eu_btw_codes where eub_id=$id";
    $data = $container->getDBManager()->ExecuteSQL( $sql );

    print json_encode( [ "msg" => "OK", "info" => "BTW code $id verwijderd" ] ) ;
}

?>

