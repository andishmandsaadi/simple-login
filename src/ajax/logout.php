<?php

session_start();

require_once realpath("../../vendor/autoload.php");

if (isset($_SESSION["userDatail"])) {

    session_unset(); 
    
    echo json_encode(array('success' => 1));

}