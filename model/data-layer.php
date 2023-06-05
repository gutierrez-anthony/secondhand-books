<?php

/**
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 *
 * Created 6/3/2023
 * 328/secondhand-books/model/data-layer.php
 * The DataLayer class for Sleeping Donuts project
 */


require_once($_SERVER['DOCUMENT_ROOT'].'/../pdo.php');
class DataLayer
{

    /**
     * @var PDO The database connection object
     */
    private $_dbh;

    /**
     * DataLayer Constructor
     */
    function __construct()
    {
        try{
            //Instantiate a database object
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            //echo "Connected to database!";
        }
        catch(PDOException $e){
            echo $e->getMessage();

        }
    }


    static function getBooks()
    {
        $books = array("book one", "book two", "book three", "book four");
        return $books;
    }

    /**
     * This function send an email
     * @param $to destenation address
     * @param $from sender email
     * @param $subject subject of the email
     * @param $message body of email
     * @param $name name of sender
     * @return true if email has sent
     */
    static function sendEmail($to, $from, $subject, $message, $name)
    {
        // Send as an email
        $message = "
        <html>
        <head>
        <title>" . $subject . "</title>
        </head>
        <body>
        <p>Name:" . $name . "</p>
        <p>" . $message . "</p>
        <br>
        <br>
        </body>
        </html>";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <' . $from . '>' . "\r\n";


        mail($to,$subject,$message,$headers);

        return true;
    }
}