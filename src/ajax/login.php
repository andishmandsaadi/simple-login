<?php

session_start();

use MyApp\data\Database;

use MyApp\user\UserController;

require_once realpath("../../vendor/autoload.php");

if (isset($_POST['email']) && $_POST['email'] && isset($_POST['password']) && $_POST['password']) {
    
    $database = new Database();

    $user = new UserController($database);

    $userDatail = $user->getUser($_POST['email']);

    
    if(count($userDatail) == 0){

        echo json_encode(array('success' => 0,'detail' => 'User doesnt exist'));

    }else{

        if($userDatail['password'] == hash('sha256', $_POST['password'])){
            
            $_SESSION["userDatail"] = $userDatail['name'];

            echo json_encode(array('success' => 1));

        }else{

            echo json_encode(array('success' => 0,'detail' => 'Password is wrong'));

        }

    }
    
} else {
    
    echo json_encode(array('success' => 0));
    
}