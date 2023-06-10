<?php

/**
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 *
 * Created 6/3/2023
 * 328/secondhand-books/model/validation.php
 * Validation Class for Sleeping Donuts project
 */

class Validation
{
    /**
    This function checks to see that a
    string is all alphabetic (no numbers)
    and not empty
     */
    static function validName($name)
    {
        $name = trim($name);

        if (empty($name)) {
            return false;
        }

        return preg_match('/^[A-Za-z\s]+$/', $name);
    }



    /**
    This function checks to see
    that an email address is valid.
     */
    static function validEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }


    /**
    This function checks to see that
    a string is a valid phone number
    with 10 digits.
     */
    static function validPhone($phoneNumber)
    {
        // Remove any non-digit characters from the phone number
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        // Check if the phone number has exactly 10 digits
        return strlen($phoneNumber) === 10;
    }

    /**
     * This function validate messages (body of emails)
     */
    static function validateMessage($message)
    {
        // Remove leading and trailing whitespace
        $message = trim($message);

        // Check if the message is empty
        if (empty($message)) {
            return false;
        }

        // Check the length of the message
        $messageLength = strlen($message);
        if ($messageLength < 5 || $messageLength > 255) {
            return false;
        }

        // If all validation checks pass, return true
        return true;
    }

    /**
     * This function validate email subject
     */
    static function validateEmailSubject($subject)
    {
        // Remove leading and trailing whitespace
        $subject = trim($subject);

        // Check if the subject is empty
        if (empty($subject)) {
            return false;
        }

        return true;
    }

    /**
     * This function validate the password
     * @param $password password
     * @return bool true if password is valid
     */
    static function validatePassword($password) {
        // Password length should be between 8 and 20 characters
        if (strlen($password) < 8 || strlen($password) > 20) {
            return false;
        }

        // Password should contain at least one uppercase letter,
        // one lowercase letter, one digit, and one special character
        if (!preg_match('/[A-Z]/', $password) ||
            !preg_match('/[a-z]/', $password) ||
            !preg_match('/\d/', $password) ||
            !preg_match('/[\W_]/', $password)) {
            return false;
        }

        // Password is valid
        return true;
    }

    /**
     * This function checks if the second password equals password
     * @param $password password
     * @param $confirmPassword second password
     * @return bool true is password equals confirmed password
     */
    static function validateConfirmPassword($password, $confirmPassword) {
        // Check if the password and confirm password match
        if ($password !== $confirmPassword) {
            return false;
        }

        // Confirm password is valid
        return true;
    }

}
