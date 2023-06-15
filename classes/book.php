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
     * Constructor for the Book class.
     *
     * @param mixed $title The title of the book.
     * @param mixed $owner The owner of the book.
     * @param mixed $authors The authors of the book.
     * @param mixed $price The price of the book.
     * @param mixed $photo_path (optional) The photo path of the book.
     * @param mixed $photo_name (optional) The photo name of the book.
     * @param mixed $description (optional) The description of the book.
     * @param mixed $subject (optional) The subject of the book.
     * @param mixed $edition (optional) The edition of the book.
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
     * Returns the edition of the book.
     * @return mixed The edition of the book.
     */
    public function getEdition()
    {
        return $this->_edition;
    }

    /**
     * Sets the book ID.
     * @param mixed $book_id The book ID.
     */
    public function setBookId($book_id)
    {
        $this->_book_id = $book_id;
    }

    /**
     * Sets the edition of the book.
     * @param mixed $edition The edition of the book.
     */
    public function setEdition($edition)
    {
        $this->_edition = $edition;
    }

    /**
     * Returns the book ID.
     * @return mixed The book ID.
     */
    public function getBookId()
    {
        return $this->_book_id;
    }


    /**
     * Returns the title of the book.
     * @return mixed The title of the book.
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * Sets the title of the book.
     * @param mixed $title The title of the book.
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * Returns the owner of the book.
     * @return mixed The owner of the book.
     */
    public function getOwner()
    {
        return $this->_owner;
    }

    /**
     * Sets the owner of the book.
     * @param mixed $owner The owner of the book.
     */
    public function setOwner($owner)
    {
        $this->_owner = $owner;
    }

    /**
     * Returns the authors of the book.
     * @return mixed The authors of the book.
     */
    public function getAuthors()
    {
        return $this->_authors;
    }

    /**
     * Sets the authors of the book.
     * @param mixed $authors The authors of the book.
     */
    public function setAuthors($authors)
    {
        $this->_authors = $authors;
    }

    /**
     * Returns the description of the book.
     * @return mixed|string The description of the book.
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * Sets the description of the book.
     * @param mixed|string $description The description of the book.
     */
    public function setDescription($description)
    {
        $this->_description = $description;
    }

    /**
     * Returns the subject of the book.
     * @return mixed|string The subject of the book.
     */
    public function getSubject()
    {
        return $this->_subject;
    }

    /**
     * Sets the subject of the book.
     * @param mixed $subject The subject of the book.
     */
    public function setSubject($subject)
    {
        $this->_subject = $subject;
    }

    /**
     * Returns the photo path of the book.
     * @return mixed|string The photo path of the book.
     */
    public function getPhotoPath()
    {
        return $this->_photo_path;
    }

    /**
     * Sets the photo path of the book.
     * @param mixed|string $photo_path The photo path of the book.
     */
    public function setPhotoPath($photo_path)
    {
        $this->_photo_path = $photo_path;
    }

    /**
     * Returns the photo name of the book.
     * @return mixed|string The photo name of the book.
     */
    public function getPhotoName()
    {
        return $this->_photo_name;
    }

    /**
     * Sets the photo name of the book.
     * @param mixed|string $photo_name The photo name of the book.
     */
    public function setPhotoName($photo_name)
    {
        $this->_photo_name = $photo_name;
    }

    /**
     * Returns the price of the book.
     * @return mixed The price of the book.
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * Sets the price of the book.
     * @param mixed $price The price of the book.
     */
    public function setPrice($price)
    {
        $this->_price = $price;
    }

    /**
     * Returns the approval status of the book.
     * @return mixed The approval status of the book.
     */
    public function getIsApproved()
    {
        return $this->_is_approved;
    }

    /**
     * Sets the approval status of the book.
     * @param mixed $is_approved The approval status of the book.
     */
    public function setIsApproved($is_approved)
    {
        $this->_is_approved = $is_approved;
    }

    /**
     * Returns the post time of the book.
     * @return mixed The post time of the book.
     */
    public function getPostTime()
    {
        return $this->_post_time;
    }
}
