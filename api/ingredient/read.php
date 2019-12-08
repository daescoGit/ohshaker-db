<?php
require_once(__DIR__.'../../restricted-connection.php');

if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

$db = new DB();
$con = $db->connect();
if ($con) {
    $statement = $con->query("SELECT * FROM tingredient");
    $results = $statement->fetchAll();
    $statement = null;
    $db->disconnect($con);
    echo json_encode($results);
}
