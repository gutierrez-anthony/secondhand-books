<?php

/**
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 *
 * Created 6/4/2023
 * 328/secondhand-books/classes/person.php
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

    /**
     * @param $title
     * @param $owner
     * @param $authors
     * @param $description
     * @param $subject
     * @param $photo_path
     * @param $photo_name
     * @param $price
     */
    public function __construct($title, $owner, $authors, $price, $photo_path = '', $photo_name = '', $description = '', $subject = '')
    {
        $this->_title = $title;
        $this->_owner = $owner;
        $this->_authors = $authors;
        $this->_description = $description;
        $this->_subject = $subject;
        $this->_photo_path = $photo_path;
        $this->_photo_name = $photo_name;
        $this->_price = $price;
    }

    /**
     * @return mixed
     */
    public function getBookId()
    {
        return $this->_book_id;
    }


    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->_owner;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner($owner)
    {
        $this->_owner = $owner;
    }

    /**
     * @return mixed
     */
    public function getAuthors()
    {
        return $this->_authors;
    }

    /**
     * @param mixed $authors
     */
    public function setAuthors($authors)
    {
        $this->_authors = $authors;
    }

    /**
     * @return mixed|string
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @param mixed|string $description
     */
    public function setDescription($description)
    {
        $this->_description = $description;
    }

    /**
     * @return mixed|string
     */
    public function getSubject()
    {
        return $this->_subject;
    }

    /**
     * @param mixed|string $subject
     */
    public function setSubject($subject)
    {
        $this->_subject = $subject;
    }

    /**
     * @return mixed|string
     */
    public function getPhotoPath()
    {
        return $this->_photo_path;
    }

    /**
     * @param mixed|string $photo_path
     */
    public function setPhotoPath($photo_path)
    {
        $this->_photo_path = $photo_path;
    }

    /**
     * @return mixed|string
     */
    public function getPhotoName()
    {
        return $this->_photo_name;
    }

    /**
     * @param mixed|string $photo_name
     */
    public function setPhotoName($photo_name)
    {
        $this->_photo_name = $photo_name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->_price = $price;
    }

    /**
     * @return mixed
     */
    public function getIsApproved()
    {
        return $this->_is_approved;
    }

    /**
     * @param mixed $is_approved
     */
    public function setIsApproved($is_approved)
    {
        $this->_is_approved = $is_approved;
    }

    /**
     * @return mixed
     */
    public function getPostTime()
    {
        return $this->_post_time;
    }






}
