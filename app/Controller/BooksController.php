<?php

namespace Controller;

require_once __DIR__.'/../Models/Books.php';

use Models\Books;

class BooksController
{
    public function createBooks()
    {
        $Books = new Books;
        return $Books->insert([
            'Title'=>$_POST['Title'],
            'ISBN'=>$_POST['ISBN'],
            'Author'=>$_POST['Author'],
            'Publisher'=>$_POST['Publisher'],
            'Year Published'=>date('Y', strtotime($_POST['Year'])),
            'Category'=>$_POST['Category'],
            'Archived'=>isset($_POST['Archived']) ? 1 : 0
        ]);
    }
    
    public function deleteBooks()
    {
        $Books = new Books;
        return $Books->delete($_POST['id']);
    }
    
    public function editBooks()
    {
        $Books = new Books;
        return $Books->update(
            $_POST['id'],
            $_POST['data']
        );
    }
    
    public function showBooks()
    {
        
    }
}