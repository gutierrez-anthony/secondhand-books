<?php

/**
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 *
 * Created 6/3/2023
 * 328/secondhand-books/controllers/controller.php
 * Controllers for Sleeping Donuts project
 */


class Controller
{
    //F3 object
    private $_f3;


    function __construct($f3)
    {
        $this->_f3 = $f3;
    }


    function contactUs()
    {

        //If the form has been posted
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            // Get the data
            $name = (isset($_POST['name'])) ? $_POST['name'] : '';
            $subject = (isset($_POST['subject'])) ? $_POST['subject'] : '';
            $email = (isset($_POST['email'])) ? $_POST['email'] : '';
            $message = (isset($_POST['message'])) ? $_POST['message'] : '';

            // *** If name is not valid, set an error variable
            if (Validation::validName($name)) {
            } else {
                $this->_f3->set('errors["name"]', 'Invalid name entered');
            }

            // *** If subject is not valid, set an error variable
            if (Validation::validateEmailSubject($subject)) {
            } else {
                $this->_f3->set('errors["name"]', 'Invalid name entered');
            }

            // *** If email is not valid, set an error variable
            if (Validation::validEmail($email)) {
            } else {
                $this->_f3->set('errors["name"]', 'Invalid name entered');
            }

            // *** If message is not valid, set an error variable
            if (Validation::validateMessage($message)) {
            } else {
                $this->_f3->set('errors["name"]', 'Invalid name entered');
            }

            // Redirect to home route if there
            // are no errors (errors array is empty)
            if (empty($this->_f3->get('errors'))) {
                $send_email = DataLayer::sendEmail($this->_f3->get('OUR_EMAIL'), $email, $subject, $message, $name);
                if($send_email){
                    $this->_f3->set('SESSION.alert', 'Your email has sent successfully.');
                }

                $this->_f3->reroute('/');
            }


        }

        // Set the title of the page
        $this->_f3->set('title', "Contact Us");


        // Define a view page
        $view = new Template();
        echo $view->render('views/contact-us.html');
    }
}
