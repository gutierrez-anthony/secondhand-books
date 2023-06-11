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
            if (!Validation::validName($name)) {
                $this->_f3->set('errors["name"]', 'Invalid name entered');
            }

            // *** If subject is not valid, set an error variable
            if (!Validation::validateEmailSubject($subject)) {
                $this->_f3->set('errors["subject"]', 'Invalid subject entered');
            }

            // *** If email is not valid, set an error variable
            if (!Validation::validEmail($email)) {
                $this->_f3->set('errors["email"]', 'Invalid email entered');
            }

            // *** If message is not valid, set an error variable
            if (!Validation::validateMessage($message)) {
                $this->_f3->set('errors["message"]', 'Invalid message entered');
            }

            // Redirect to home route if there
            // are no errors (errors array is empty)
            if (empty($this->_f3->get('errors'))) {
                $send_email = SendEmail::sendToUs($this->_f3->get('OUR_EMAIL'), $email, $subject, $message, $name);
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

    function register()
    {

        //If the form has been posted
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            // Get the data
            $first_name = (isset($_POST['firstName'])) ? $_POST['firstName'] : '';
            $last_name = (isset($_POST['lastName'])) ? $_POST['lastName'] : '';
            $email = (isset($_POST['email'])) ? $_POST['email'] : '';
            $phone = (isset($_POST['phoneNumber'])) ? $_POST['phoneNumber'] : '';
            $password = (isset($_POST['password'])) ? $_POST['password'] : '';
            $confirm_password = (isset($_POST['confirmPassword'])) ? $_POST['confirmPassword'] : '';
            $address = (isset($_POST['address'])) ? $_POST['address'] : '';

            // *** If first name is not valid, set an error variable
            if (!Validation::validName($first_name)) {
                $this->_f3->set('errors["fname"]', 'Invalid first name entered');
            }

            // *** If last name is not valid, set an error variable
            if (!Validation::validName($last_name)) {
                $this->_f3->set('errors["lname"]', 'Invalid last name entered');
            }

            // *** If email is not valid, set an error variable
            if (!Validation::validEmail($email)) {
                $this->_f3->set('errors["email"]', 'Invalid email entered');
            }

            // *** If phone is not valid, set an error variable
            if (!Validation::validPhone($phone)) {
                $this->_f3->set('errors["phone"]', 'Invalid message entered');
            }


            // *** If password is not valid, set an error variable
            if (!Validation::validatePassword($password)) {
                $this->_f3->set('errors["password"]', 'Password length should be between 8 and 20 characters and 
                contains at least one uppercase letter, one lowercase letter, one digit, and one special character');
            }

            // *** If confirm_password is not valid, set an error variable
            if (!Validation::validateConfirmPassword($password, $confirm_password)) {
                $this->_f3->set('errors["confirm_password"]', 'The passwords must match');
            }

            // Redirect to home route if there
            // are no errors (errors array is empty)
            if (empty($this->_f3->get('errors'))) {
                $person = new Person($first_name, $last_name, $email, $password, $phone, $address);
                $this->_f3->set('SESSION.person', $person);
                $person_id = $GLOBALS['dataLayer']->insertPerson($this->_f3->get('SESSION.person'));
                $person = $GLOBALS['dataLayer']->getPerson($person_id);
                $to = $person->getEmail();
                $uuid = $person->getUuid();
                $send_email = SendEmail::sendConfirmLink($to, $this->_f3->get('OUR_EMAIL'), $uuid, $this->_f3);
                if($send_email){
                    $this->_f3->set('SESSION.alert', 'Confirm your email address');
                }

                $this->_f3->reroute('/');
            }


        }


        // Set the title of the page
        $this->_f3->set('title', "Register");


        // Define a view page
        $view = new Template();
        echo $view->render('views/register.html');
    }

    function login()
    {

        //If the form has been posted
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            // Get data
            $email = (isset($_POST['email'])) ? $_POST['email'] : '';
            $raw_password = (isset($_POST['password'])) ? $_POST['password'] : '';
            $email = trim($email);


            // *** If email is not valid, set an error variable
            if (!Validation::validEmail($email)) {
                $this->_f3->set('errors["email"]', 'Invalid email entered');
            }


            // Redirect to home route if there
            // are no errors (errors array is empty)
            if (empty($this->_f3->get('errors'))) {
                $person = $GLOBALS['dataLayer']->getPersonByEmail($email);
                $hashed_password = $person->getPassword();

                // Verify password
                if(!password_verify($raw_password, $hashed_password)){
                    $this->_f3->set('errors["password"]', 'Wrong password entered');
                } else{
                    $this->_f3->set('SESSION.person', $person);
                    $this->_f3->reroute('/');
                }
            }
        }

        // Set the title of the page
        $this->_f3->set('title', "LogIn");


        // Define a view page
        $view = new Template();
        echo $view->render('views/login.html');
    }

    function addBook()
    {
        if (!Validation::loggedIn($this->_f3)) {
            $this->_f3->reroute('/login');
        }


        //If the form has been posted
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            // Get the data
            $title = (isset($_POST['title'])) ? $_POST['title'] : '';
            $authors = (isset($_POST['authors'])) ? $_POST['authors'] : '';
            $edition = (isset($_POST['edition'])) ? $_POST['edition'] : '';
            $subject = (isset($_POST['subject'])) ? $_POST['subject'] : '';
            $price = (isset($_POST['price'])) ? $_POST['price'] : '';
            $description = (isset($_POST['description'])) ? $_POST['description'] : '';

            // *** If price is not valid, set an error variable
            if (!Validation::validatePrice($price)) {
                $this->_f3->set('errors["price"]', 'Invalid price entered');
            }

            // *** If title is not valid, set an error variable
            if (!Validation::validateBookField($title)) {
                $this->_f3->set('errors["title"]', 'Invalid title entered');
            }

            // *** If authors is not valid, set an error variable
            if (!Validation::validateBookField($authors)) {
                $this->_f3->set('errors["authors"]', 'Invalid authors entered');
            }

            // *** If edition is not valid, set an error variable
            if (!Validation::validateBookField($edition)) {
                $this->_f3->set('errors["edition"]', 'Invalid edition entered');
            }

            // *** If subject is not valid, set an error variable
            if (!Validation::validateBookField($subject)) {
                $this->_f3->set('errors["subject"]', 'Invalid subject entered');
            }

            //=========Upload Image==================//
            if(isset($_FILES['image']) && $_FILES['image']['name'] != ''){
                $errors= array();
                $file_name = $_FILES['image']['name'];
                $file_name = uniqid() . $file_name;
                $target_dir = "uploads/";
                $target_file = $target_dir . $file_name;
                $file_size =$_FILES['image']['size'];
                $file_tmp =$_FILES['image']['tmp_name'];
                $file_ext= strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                $extensions= array("jpeg","jpg","png");

                if(in_array($file_ext,$extensions)=== false){
                    $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                }

                // Check if file already exists
                if (file_exists($target_file)) {
                    $errors[]='File already exists.';
                }

                if($file_size > 2097152){
                    $errors[]='File size must be excately 2 MB';
                }

                if(empty($errors)==true){
                    move_uploaded_file($file_tmp, $target_file);
                }else{
                    $this->_f3->set('errors["image"]', $errors);
                }
            } else {
                $file_name = 'default_book.jpg';
                $target_file = 'images/default_book.jpg';
            }
            //================End of image upload================



            // Redirect to home route if there
            // are no errors (errors array is empty)
            if (empty($this->_f3->get('errors'))) {
                $owner = $this->_f3->get('SESSION.person')->getPersonId();
                $book = new Book($title, $owner, $authors, $price, $target_file, $file_name, $description, $subject);
                $this->_f3->set('SESSION.book', $book);
                $book_id = $GLOBALS['dataLayer']->insertBook($this->_f3->get('SESSION.book'));
                if(!empty($book_id)){
                    $this->_f3->set('SESSION.alert', 'Your book will be online after approval.');
                }

                $this->_f3->reroute('/');
            }


        }



        // Set the title of the page
        $this->_f3->set('title', "Add Book");


        // Define a view page
        $view = new Template();
        echo $view->render('views/add-book.html');
    }

}
