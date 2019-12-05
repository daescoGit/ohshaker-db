<?php
session_start();

require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

if(empty($_SESSION['managerID'])) {
    sendErrorMessage( 'Not logged in [$_SESSION]' , __LINE__ ); 
}

$iCocktailID = (int)htmlspecialchars($_POST['cocktailID']);

$db = new DB();
$con = $db->connect();
if ($con) {
    $statement = $con->prepare(
        "DELETE FROM `tcocktail` WHERE `tcocktail`.`nCocktailID` = ?");
    $statement->execute([$iCocktailID]);
    $stmt = null;
    $db->disconnect($con);
    sendSuccessMessage('Deleted Cocktail' , __LINE__);
}
