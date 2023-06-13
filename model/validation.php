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
     * This function checks to see that a
     * string is all alphabetic (no numbers)
     * and not empty
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
     * This function checks to see
     * that an email address is valid.
     */
    static function validEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }


    /**
     * This function checks to see that
     * a string is a valid phone number
     * with 10 digits.
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
    static function validatePassword($password)
    {
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
    static function validateConfirmPassword($password, $confirmPassword)
    {
        // Check if the password and confirm password match
        if ($password !== $confirmPassword) {
            return false;
        }

        // Confirm password is valid
        return true;
    }

    /**
     * Check that requester has been authenticated.
     */
    static function loggedIn($f3)
    {
        return !empty($f3->get('SESSION.person'));
    }

    /**
     * Check that price is valid
     */
    static function validatePrice($price)
    {
        // Remove any non-numeric characters except decimal point
        $cleanedPrice = preg_replace('/[^0-9.]/', '', $price);

        // Check if the cleaned price is a valid number
        if (!is_numeric($cleanedPrice)) {
            return false;
        }

        // Check if the price is non-negative
        if ($cleanedPrice < 0) {
            return false;
        }

        // Check if the price has a maximum of 2 decimal places
        if (strpos($cleanedPrice, '.') !== false) {
            $decimalPlaces = strlen(substr($cleanedPrice, strpos($cleanedPrice, '.') + 1));
            if ($decimalPlaces > 2) {
                return false;
            }
        }

        return true;
    }


    /**
     * Check the add book fields not being
     * empty ro less than five character
     */
    static function validateBookField($fieldValue)
    {
        // Remove leading and trailing white spaces
        $trimmedValue = trim($fieldValue);

        // Check if the field is empty
        if (empty($trimmedValue)) {
            return false;
        }

        // Check if the string length is less than 5
        if (strlen($trimmedValue) < 5) {
            return false;
        }


        // Return true if the field passes all validations
        return true;
    }


    static function validBookIds($f3, $book_ids)
    {
        $valid_ids = array();
        $books = $f3->get('SESSION.person')->getBooksToApprove();
        // Looping over the $books array
        foreach ($books as $book) {
            $valid_ids[] = $book->getBookId();
        }

        //
        foreach ($book_ids as $id) {
            if (!in_array($id, $valid_ids)) {
                return false;
            }
        }

        return true;
    }

    static function validateSorting($selectedChoices)
    {
        return (in_array($selectedChoices, DataLayer::getSortingChoices()));
    }
}
