<?php

/**
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 *
 * Created 6/4/2023
 * 328/secondhand-books/classes/person.php
 * Admin Class represents an admin
 * for Sleeping Donuts project
 */


class Admin extends Person
{
    private $_books_to_approve;

    /**
     * @return Array
     */
    public function getBooksToApprove()
    {
        return $this->_books_to_approve;
    }

    /**
     * @param Array $bookstoapprove
     */
    public function setBooksToApprove($books_to_approve)
    {
        $this->_books_to_approve = $books_to_approve;
    }


}
