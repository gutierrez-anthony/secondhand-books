<?php

/**
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 *
 * Created 6/3/2023
 * 328/secondhand-books/model/validation.php.php
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

}
