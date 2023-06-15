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
     * Returns an array of books that are waiting to be approved.
     * @return Array
     */
    public function getBooksToApprove()
    {
        return $this->_books_to_approve;
    }

    /**
     * Assigns an array of books objects with the parameter.
     * @param Array $books_to_approve
     */
    public function setBooksToApprove($books_to_approve)
    {
        $this->_books_to_approve = $books_to_approve;
    }


}
