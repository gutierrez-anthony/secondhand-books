<?php

/**
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 *
 * Created 6/4/2023
 * 328/secondhand-books/classes/person.php
 * User Class represents a user
 * for Sleeping Donuts project
 */

class User extends Person
{
    private $_books;

    /**
     * @return Array
     */
    public function getBooks()
    {
        return $this->_books;
    }

    /**
     * @param Array $books
     */
    public function setBooks($books)
    {
        $this->_books = $books;
    }


}
