<?php

session_start();

use MyApp\data\Database;

use MyApp\user\UserController;

require_once realpath("../../vendor/autoload.php");

if (isset($_POST['name']) && $_POST['name'] && isset($_POST['email']) && $_POST['email'] && isset($_POST['password']) && $_POST['password']) {

    $database = new Database();

    $user = new UserController($database);

    $userDatail = $user->getUser($_POST['email']);

    if(count($userDatail) == 0){

        $result = $user->addUser($_POST['name'],$_POST['email'],hash('sha256', $_POST['password']));
        
        if($result == 1){

            $_SESSION["userDatail"] = $_POST['name'];

            echo json_encode(array('success' => 1,'detail' => 'Signed up successfully'));

        }else{

            echo json_encode(array('success' => 0,'detail' => $result));

        }

    }else{
        
        echo json_encode(array('success' => 0,'detail' => 'User with this email exist'));

    }
    
} else {
    
    echo json_encode(array('success' => 0));
    
}