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
     * Returns the person ID.
     * @return mixed The person ID.
     */
    public function getPersonId()
    {
        return $this->_person_id;
    }


    /**
     * Sets the person ID.
     * @param string $person_id The person ID.
     */
    public function setPersonId($person_id)
    {
        $this->_person_id = $person_id;
    }


    /**
     * Returns the first name.
     * @return string The first name.
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * Sets the first name.
     * @param string $fname The first name.
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * Returns the last name.
     * @return string The last name.
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * Sets the last name.
     * @param string $lname The last name.
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * Returns the email.
     * @return string The email.
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Sets the email.
     * @param string $email The email.
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * Returns the address.
     * @return string The address.
     */
    public function getAddress()
    {
        return $this->_address;
    }

    /**
     * Sets the address.
     * @param string $address The address.
     */
    public function setAddress($address)
    {
        $this->_address = $address;
    }

    /**
     * Returns the phone number.
     * @return string The phone number.
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * Sets the phone number.
     * @param string $phone The phone number.
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * Returns the password.
     * @return string The password.
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * Sets the password.
     * @param string $password The password.
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * Returns whether the user is an administrator.
     * @return bool Whether the user is an administrator.
     */
    public function getIsAdmin()
    {
        return $this->_is_admin;
    }

    /**
     * Returns whether the user is active.
     * @return bool Whether the user is active.
     */
    public function getIsActive()
    {
        return $this->_is_active;
    }

    /**
     * Sets the user as an administrator or not.
     * @param bool $is_admin Whether the user is an administrator.
     */
    public function setIsAdmin($isadmin)
    {
        $this->_is_admin = $isadmin;
    }

    /**
     * Sets the user as active or inactive.
     * @param bool $is_active Whether the user is active.
     */
    public function setIsActive($isctive)
    {
        $this->_is_active = $isctive;
    }

    /**
     * Returns the UUID (Universally Unique Identifier) of the user.
     * @return string The UUID of the user.
     */
    public function getUuid()
    {
        return $this->_uuid;
    }

    /**
     * Sets the UUID (Universally Unique Identifier) of the user.
     * @param string $uuid The UUID of the user.
     */
    public function setUuid($uuid)
    {
        $this->_uuid = $uuid;
    }

    /**
     * Returns the timestamp of the valid reset password link.
     * @return DateTime The timestamp of the valid reset password link.
     */
    public function getPasswordTimestamp()
    {
        return $this->_password_timestamp;
    }

    /**
     * Sets the timestamp of the valid reset password link.
     * @param DateTime $password_timestamp The timestamp of the valid reset password link.
     */
    public function setPasswordTimestamp($passwordtimestamp)
    {
        $this->_password_timestamp = $passwordtimestamp;
    }
}
