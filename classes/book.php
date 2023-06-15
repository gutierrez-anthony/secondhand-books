<?php

/**
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 *
 * Created 6/4/2023
 * 328/secondhand-books/classes/book.php
 * Book Class represents a book
 * for Sleeping Donuts project
 */

class Book
{
    private $_book_id;
    private $_title;
    private $_owner;
    private $_authors;
    private $_description;
    private $_subject;
    private $_photo_path;
    private $_photo_name;
    private $_price;
    private $_is_approved;
    private $_post_time;
    private $_edition;

    /**
     * Constructs a new Book object and assigns the parameters to its respective fields.
     * @param $title
     * @param $owner
     * @param $authors
     * @param $description
     * @param $subject
     * @param $photo_path
     * @param $photo_name
     * @param $price
     */
    public function __construct($title, $owner, $authors, $price, $photo_path = '', $photo_name = '', $description = '', $subject = '', $edition = '')
    {
        $this->_title = $title;
        $this->_owner = $owner;
        $this->_authors = $authors;
        $this->_description = $description;
        $this->_subject = $subject;
        $this->_photo_path = $photo_path;
        $this->_photo_name = $photo_name;
        $this->_price = $price;
        $this->_edition = $edition;
    }

    /**
     * Returns the edition of a Book object.
     * @return mixed
     */
    public function getEdition()
    {
        return $this->_edition;
    }

    /**
     * Assigns the edition of a book object with the parameter.
     * @param mixed $edition
     */
    public function setEdition($edition)
    {
        $this->_edition = $edition;
    }

    /**
     * Returns the book ID of a Book object.
     * @return mixed
     */
    public function getBookId()
    {
        return $this->_book_id;
    }

    /**
     * Assigns the ID of a book object with the parameter.
     * @param mixed $book_id
     */
    public function setBookId($book_id)
    {
        $this->_book_id = $book_id;
    }


    /**
     * Returns the title of a Book object.
     * @return mixed
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * Assigns the title of a book object with the parameter.
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * Returns the owner of a Book object.
     * @return mixed
     */
    public function getOwner()
    {
        return $this->_owner;
    }

    /**
     * Assigns the owner of a book object with the parameter.
     * @param mixed $owner
     */
    public function setOwner($owner)
    {
        $this->_owner = $owner;
    }

    /**
     * Returns the author of a Book object.
     * @return mixed
     */
    public function getAuthors()
    {
        return $this->_authors;
    }

    /**
     * Assigns the author of a book object with the parameter.
     * @param mixed $authors
     */
    public function setAuthors($authors)
    {
        $this->_authors = $authors;
    }

    /**
     * Returns the description of a Book object.
     * @return mixed|string
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * Assigns the description of a book object with the parameter.
     * @param mixed|string $description
     */
    public function setDescription($description)
    {
        $this->_description = $description;
    }

    /**
     * Returns the subject of a Book object.
     * @return mixed|string
     */
    public function getSubject()
    {
        return $this->_subject;
    }

    /**
     * Assigns the subject of a book object with the parameter.
     * @param mixed|string $subject
     */
    public function setSubject($subject)
    {
        $this->_subject = $subject;
    }

    /**
     * Returns the file path of the phone of a Book object.
     * @return mixed|string
     */
    public function getPhotoPath()
    {
        return $this->_photo_path;
    }

    /**
     * Assigns the file path of the photo of a book object with the parameter.
     * @param mixed|string $photo_path
     */
    public function setPhotoPath($photo_path)
    {
        $this->_photo_path = $photo_path;
    }

    /**
     * Returns the file name for a photo of a Book object.
     * @return mixed|string
     */
    public function getPhotoName()
    {
        return $this->_photo_name;
    }

    /**
     * Assigns the file name for a photo of a book object with the parameter.
     * @param mixed|string $photo_name
     */
    public function setPhotoName($photo_name)
    {
        $this->_photo_name = $photo_name;
    }

    /**
     * Returns the price of a Book object.
     * @return mixed
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * Assigns the price of a book object with the parameter.
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->_price = $price;
    }

    /**
     * Returns true if the Book object is approved.
     * @return mixed
     */
    public function getIsApproved()
    {
        return $this->_is_approved;
    }

    /**
     * Assigns true or false to a book object with the parameter.
     * @param mixed $is_approved
     */
    public function setIsApproved($is_approved)
    {
        $this->_is_approved = $is_approved;
    }

    /**
     * Returns the datetime group the Book object was posted into the database.
     * @return mixed
     */
    public function getPostTime()
    {
        return $this->_post_time;
    }






}
