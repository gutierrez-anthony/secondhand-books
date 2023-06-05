<?php

/**
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 *
 * Created 6/4/2023
 * 328/secondhand-books/classes/person.php
 * Person Class represents a person
 * for Sleeping Donuts project
 */
class Person
{
    private $_person_id;
    private $_fname;
    private $_lname;
    private $_email;
    private $_address;
    private $_phone;
    private $_password;
    private $_is_admin;
    private $_uuid;
    private $_password_timestamp;

    /**
     * Parameterized constructor
     * @param $fname String first name
     * @param $lname String last name
     * @param $email String email address
     * @param $address String address
     * @param $phone String phone number
     * @param $password String password
     */
    public function __construct($fname, $lname, $email, $password, $address = '', $phone = '')
    {
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_email = $email;
        $this->_address = $address;
        $this->_phone = $phone;
        $this->_password = $password;
    }

    /**
     * @return int
     */
    public function getPersonId()
    {
        return $this->_person_id;
    }



    /**
     * @return String
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * @param String $fname
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * @return String
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * @param String $lname
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * @return String
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param String $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return String
     */
    public function getAddress()
    {
        return $this->_address;
    }

    /**
     * @param String $address
     */
    public function setAddress($address)
    {
        $this->_address = $address;
    }

    /**
     * @return String
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param String $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return String
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param String $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * @return Boolean
     */
    public function getIsAdmin()
    {
        return $this->_is_admin;
    }

    /**
     * @param Boolean $isadmin
     */
    public function setIsAdmin($isadmin)
    {
        $this->_is_admin = $isadmin;
    }

    /**
     * @return String
     */
    public function getUuid()
    {
        return $this->_uuid;
    }

    /**
     * @param String $uuid
     */
    public function setUuid($uuid)
    {
        $this->_uuid = $uuid;
    }

    /**
     * @return DateTime
     */
    public function getPasswordTimestamp()
    {
        return $this->_password_timestamp;
    }

    /**
     * @param DateTime $passwordtimestamp
     */
    public function setPasswordTimestamp($passwordtimestamp)
    {
        $this->_password_timestamp = $passwordtimestamp;
    }




}
