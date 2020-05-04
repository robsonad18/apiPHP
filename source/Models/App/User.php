<?php 

namespace Source\Models\App;

use CoffeeCode\DataLayer\DataLayer;

class User extends DataLayer 
{
    function __construct()
    {
        parent::__construct("users", ["first_name", "last_name"], "id", false);
    }
}