<?php

/**
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 *
 * Created 6/4/2023
 * 328/secondhand-books/classes/user.php
 * User Class represents a user
 * for Sleeping Donuts project
 */

class User extends Person
{
    private $_books;

    /**
     * Returns an array of Book objects.
     * @return Array
     */
    public function getBooks()
    {
        return $this->_books;
    }

    /**
     * Assigns an array of Book objects with the parameter.
     * @param Array $books
     */
    public function setBooks($books)
    {
        $this->_books = $books;
    }


}
