<?php

/**
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 *
 * Created 6/9/2023
 * 328/secondhand-books\model\SendEmail.php
 * SendEmail Class for sending different emails
 * for Sleeping Donuts project
 */

class SendEmail
{


    /**
     * This function send an email
     * @param $to destenation address
     * @param $from sender email
     * @param $subject subject of the email
     * @param $message body of email
     * @param $name name of sender
     * @return true if email has sent
     */
    static function sendToUs($to, $from, $subject, $message, $name)
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


    /**
     * @param $to destenation address
     * @param $from sender email
     * @param $uuid uuid
     * @param $f3 fat free instance
     * @return true if email has sent
     */
    static function sendConfirmLink($to, $from, $uuid, $f3)
    {
        $baseDomain = $f3->get('BASE');
        $approve_link = 'https://' . $_SERVER['HTTP_HOST'] . $baseDomain . '/confirm-email?uuid=' .  $uuid;


        // Send as an email
        $subject = "Confirm your email address" ;

        $message = "
        <html>
        <head>
        <title>Confirm your email address</title>
        </head>
        <body>
        <p>You have registered in the secondhand-books website.</p>

        <br>
        <br>
        <p>To confirm your email address click on the link below:</p>
        <p><a href='" . $approve_link . "'>" . $approve_link . "</a></p>
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


    /**
     * This function send an email
     * @param $to destenation address
     * @param $from sender email
     * @param $subject subject of the email
     * @param $message body of email
     * @param $name name of sender
     * @return true if email has sent
     */
    static function sendToOwner($to, $from, $subject, $message, $name)
    {
        // Send as an email
        $message = "
        <html>
        <head>
        <title>" . $subject . "</title>
        </head>
        <body>
        <p>Sender name: " . $name . "</p>
        <p>Sender email: " . $from . "</p>
        <hr>
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
