<?php

namespace Models;
use Models\Models;

class UserModels extends Models
{
    protected $table = 'users';
    protected $columns = ['Username','Password','Firstname','Lastname','Middlename'];
}