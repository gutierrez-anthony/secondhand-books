<?php

/**
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 *
 * Created 6/4/2023
 * 328/secondhand-books/classes/admin.php
 * Admin Class represents an admin
 * for Sleeping Donuts project
 */


class Admin extends Person
{
    private $_books_to_approve;

    /**
     * * Returns the array of books to be approved.
     * @return Array The array of books to be approved.
     */
    public function getBooksToApprove()
    {
        return $this->_books_to_approve;
    }

    /**
     * Sets the array of books to be approved.
     * @param Array $books_to_approve The array of books to be approved.
     */
    public function setBooksToApprove($books_to_approve)
    {
        $this->_books_to_approve = $books_to_approve;
    }
}
