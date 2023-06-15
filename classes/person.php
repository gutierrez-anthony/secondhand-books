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
    private $_is_active;
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
    public function __construct($fname, $lname, $email, $password, $phone = '', $address = '')
    {
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_email = $email;
        $this->_address = $address;
        $this->_phone = $phone;
        $this->_password = $password;
    }

    /**
     * Returns the ID of a Person object.
     * @return mixed
     */
    public function getPersonId()
    {
        return $this->_person_id;
    }

    /**
     * Assigns the ID of a Person object with the parameter.
     * @param String $person_id
     */
    public function setPersonId($person_id)
    {
        $this->_person_id = $person_id;
    }

    /**
     * Returns the first name of a Person object.
     * @return String
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * Assigns the first name of a Person object with the parameter.
     * @param String $fname
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * Returns the last name of a Person object.
     * @return String
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * Assigns the last name of a Person object with the parameter.
     * @param String $lname
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * Returns the email of a Person object.
     * @return String
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Assigns the email of a Person object with the parameter.
     * @param String $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * Returns the address of a Person object.
     * @return String
     */
    public function getAddress()
    {
        return $this->_address;
    }

    /**
     * Assigns the address of a Person object with the parameter.
     * @param String $address
     */
    public function setAddress($address)
    {
        $this->_address = $address;
    }

    /**
     * Returns the phone number of a Person object.
     * @return String
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * Assigns the phone number of a Person object with the parameter.
     * @param String $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * Returns the password of a Person object.
     * @return String
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * Assigns the password of a Person object with the parameter.
     * @param String $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * Returns true if a Person object is an Admin.
     * @return Boolean
     */
    public function getIsAdmin()
    {
        return $this->_is_admin;
    }

    /**
     * Returns true if a Person object's email has been verified.
     * @return Boolean
     */
    public function getIsActive()
    {
        return $this->_is_active;
    }

    /**
     * Assigns true or false to a Person object with the parameter.
     * @param Boolean $isadmin
     */
    public function setIsAdmin($isadmin)
    {
        $this->_is_admin = $isadmin;
    }

    /**
     * Assigns true or false to a Person object with the parameter.
     * @param Boolean $isActive
     */
    public function setIsActive($isActive)
    {
        $this->_is_active = $isActive;
    }

    /**
     * Returns the UU ID of a Person object.
     * @return String
     */
    public function getUuid()
    {
        return $this->_uuid;
    }

    /**
     * Assigns the UU ID of a Person object with the parameter.
     * @param String $uuid
     */
    public function setUuid($uuid)
    {
        $this->_uuid = $uuid;
    }

    /**
     * Returns the datetime for the password of a Person object.
     * @return DateTime
     */
    public function getPasswordTimestamp()
    {
        return $this->_password_timestamp;
    }

    /**
     * Assigns the datetime for the password of a Person object with the parameter.
     * @param DateTime $passwordtimestamp
     */
    public function setPasswordTimestamp($passwordtimestamp)
    {
        $this->_password_timestamp = $passwordtimestamp;
    }




}
