<?php

session_start();

require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');


$sName = htmlspecialchars($_POST['name'], ENT_QUOTES); //  ENT_QUOTES allows use of single quotes

if(empty($_SESSION['managerID'])) {
    sendErrorMessage('Not logged in [$_SESSION]', __LINE__); 
}

if(empty( $_POST['name'])){ 
    sendErrorMessage('ingredient name is missing', __LINE__); 
}
if(strlen($_POST['name']) < 2 || strlen($_POST['name']) > 50){
    sendErrorMessage('ingredient name min 2 max 50 characters', __LINE__);
}

$db = new DB();
$con = $db->connect();
if ($con) {
    $statement = $con->prepare(
        "INSERT INTO `tingredient`(`cName`) VALUES (?)");    
    $statement->execute([$sName]);
    $stmt = null;
    $db->disconnect($con);
    sendSuccessMessage('Created ingredient' , __LINE__);
}