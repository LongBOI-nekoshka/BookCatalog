<?php
namespace Models;

require_once __DIR__.'/Models.php';

use Models\Models;

class Books extends Models
{
    protected $table = 'books';
    protected $columns = ['Title','ISBN','Author','Publisher','Year Published','Category','Archived'];

}