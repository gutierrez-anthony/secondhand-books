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
     * Returns the books associated with the user.
     * @return array The books associated with the user.
     */
    public function getBooks()
    {
        return $this->_books;
    }

    /**
     * Sets the books associated with the user.
     * @param array $books The books associated with the user.
     */
    public function setBooks($books)
    {
        $this->_books = $books;
    }
}
