<?php 

namespace MyApp\User;
use MyApp\Data\Database;

class UserController
{
    private $database = null;

    public function __construct(Database $database) {
        $this->database = $database;
    }

    public function getUser($email) {
        return $this->database->getUser($email);
    }

    public function addUser($name,$email,$password) {
        return $this->database->addUser($name,$email,$password);
    }

}
