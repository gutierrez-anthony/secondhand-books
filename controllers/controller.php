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


    /**
     * Constructor for the class.
     * @param Object $f3 The Fat-Free Framework object.
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }


    /**
     * The home page controller.
     *
     * This method sets the title of the page, retrieves an
     * alert message from the session, retrieves books data from the model,
     * and renders the home view page.
     */
    function home()
    {

        // Set the title of the page
        $this->_f3->set('title', "Home");
        //$alert = 'This alert will be used for showing a successful operation!';
        $this->_f3->set('alert', $this->_f3->get('SESSION.alert'));
        $this->_f3->set('SESSION.alert', '');

        $books = $GLOBALS['dataLayer']->getBooks();
        $this->_f3->set('SESSION.books', $books);

        // Get the data from the model and add to a new card
        $this->_f3->set('books', $this->_f3->get('SESSION.books'));

        // Define a view page
        $view = new Template();
        echo $view->render('views/home.html');
    }


    /**
     * Controller for the about-us route.
     *
     * This method sets the title of the
     * page and renders the about-us view page.
     */
    function aboutUs()
    {
        // Set the title of the page
        $this->_f3->set('title', "About Us");

        // Define a view page
        $view = new Template();
        echo $view->render('views/about-us.html');
    }


    /**
     * Controller for the contact-us route.
     *
     * This method handles the contact form submission, validates the form data, sends an email,
     * and redirects to the home route if there are no errors.
     * It also sets the title of the page and renders the contact-us view page.
     */
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

    function termsOfServices(){
        // Set the title of the page
        $this->_f3->set('title', "Terms of Services");


        // Define a view page
        $view = new Template();
        echo $view->render('views/terms-of-services.html');
    }

    /**
     * Controller for the faq route
     */
    function faq()
    {
        // Set the title of the page
        $this->_f3->set('title', "FAQ");


        // Define a view page
        $view = new Template();
        echo $view->render('views/faq.html');
    }

    /**
     * Controller for the register route
     */
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
                $this->_f3->set('errors["phone"]', 'Phone number should be 10 digits.');
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
                $person_id = $GLOBALS['dataLayer']->insertPerson($person);
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

    /**
     * Controller for the login route
     */
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

    /**
     * Controller for the contact-owner route
     */
    function contactOwner()
    {

        //If the form has been posted
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            // Get the data
            $name = (isset($_POST['name'])) ? $_POST['name'] : '';
            $sender_email = (isset($_POST['email'])) ? $_POST['email'] : '';
            $subject = (isset($_POST['subject'])) ? $_POST['subject'] : '';
            $message = (isset($_POST['message'])) ? $_POST['message'] : '';

            // *** If subject is not valid, set an error variable
            if (!Validation::validateEmailSubject($subject)) {
                $this->_f3->set('errors["subject"]', 'Invalid subject entered');
            }

            // *** If message is not valid, set an error variable
            if (!Validation::validateMessage($message)) {
                $this->_f3->set('errors["message"]', 'Invalid message entered');
            }

            // *** If email is not valid, set an error variable
            if (!Validation::validEmail($sender_email)) {
                $this->_f3->set('errors["email"]', 'Invalid email entered');
            }

            // *** If name is not valid, set an error variable
            if (!Validation::validName($name)) {
                $this->_f3->set('errors["name"]', 'Invalid name entered');
            }



            // Redirect to home route if there
            // are no errors (errors array is empty)
            if (empty($this->_f3->get('errors'))) {
                $owner_id = $this->_f3->get('SESSION.book')->getOwner();
                $owner_email = $GLOBALS['dataLayer']->getOwnerEmail($owner_id);

                // Send email to the book owner
                $send_email = SendEmail::sendToOwner($owner_email, $sender_email, $subject, $message, $name);

                if($send_email){
                    $this->_f3->set('SESSION.alert', 'Your email is sent successfully.');
                }

                $this->_f3->reroute('/');
            }


        }


        // Get book data
        $book_id = $_GET['id'];
        $book = $GLOBALS['dataLayer']->getBook($book_id);
        $this->_f3->set('SESSION.book', $book);

        // Set the title of the page
        $this->_f3->set('title', "Contact Owner");


        // Define a view page
        $view = new Template();
        echo $view->render('views/contact-owner.html');
    }


    /**
     * Controller for the add-book route
     */
    function addBook()
    {
        if (!Validation::loggedIn($this->_f3)) {
            $this->_f3->reroute('/login');
        }

        if ($this->_f3->get('SESSION.person') instanceof Admin){
            $this->_f3->reroute('/');
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
                    $errors[]='File size must be exactly 2 MB';
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
                $book = new Book($title, $owner, $authors, $price, $target_file, $file_name, $description, $subject, $edition);
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


    /**
     * Controller for the profile route
     */
    function profile()
    {
        if (!Validation::loggedIn($this->_f3)) {
            $this->_f3->reroute('/login');
        }

        if ($this->_f3->get('SESSION.person') instanceof Admin){
            $this->_f3->reroute('/');
        }


        //If the form has been posted
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            // Get the data
            $first_name = (isset($_POST['firstName'])) ? $_POST['firstName'] : '';
            $last_name = (isset($_POST['lastName'])) ? $_POST['lastName'] : '';
            $email = (isset($_POST['email'])) ? $_POST['email'] : '';
            $phone = (isset($_POST['phoneNumber'])) ? $_POST['phoneNumber'] : '';
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
                $this->_f3->set('errors["phone"]', 'Phone number should be 10 digits.');
            }


            // Redirect to home route if there
            // are no errors (errors array is empty)
            if (empty($this->_f3->get('errors'))) {
                $password = $this->_f3->get('SESSION.person')->getPassword();
                $person = new Person($first_name, $last_name, $email, $password, $phone, $address);
                $person->setPersonId($this->_f3->get('SESSION.person')->getPersonId());
                $GLOBALS['dataLayer']->updatePerson($person);


                $this->_f3->set('SESSION.alert', 'Your information is updated successfully.');


                $this->_f3->reroute('/');
            }
        }


        $books = $GLOBALS['dataLayer']->getBooksByOwner($this->_f3->get('SESSION.person')->getPersonId());
        $person = $GLOBALS['dataLayer']->getPerson($this->_f3->get('SESSION.person')->getPersonId());
        $this->_f3->get('SESSION.person')->setBooks($books);
        $this->_f3->get('SESSION.person')->setFname($person->getFname());
        $this->_f3->get('SESSION.person')->setLname($person->getLname());
        $this->_f3->get('SESSION.person')->setEmail($person->getEmail());
        $this->_f3->get('SESSION.person')->setAddress($person->getAddress());
        $this->_f3->get('SESSION.person')->setPhone($person->getPhone());


        // Set the title of the page
        $this->_f3->set('title', "Profile");


        // Define a view page
        $view = new Template();
        echo $view->render('views/profile.html');
    }


    /**
     * Controller for the confirm-email route
     */
    function confirmEmail()
    {
        if(!isset($_GET['uuid'])){
            //Redirect to the default route
            $this->_f3->reroute('/');
        }

        $uuid = $_GET['uuid'];
        $result = $GLOBALS['dataLayer']->confirmEmail($uuid);


        if($result){
            $this->_f3->set('SESSION.alert', 'Your email address is confirmed.');
        }
        $this->_f3->reroute('/');
    }


    /**
     * Controller for the admin-dashboard route
     */
    function adminDashboard()
    {
        if (!Validation::loggedIn($this->_f3)) {
            $this->_f3->reroute('/login');
        }

        if ($this->_f3->get('SESSION.person') instanceof User){
            $this->_f3->reroute('/');
        }

        //If the form has been posted
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            // Get the data
            $approved = (isset($_POST['approved'])) ? $_POST['approved'] : '';

            // *** If price is not valid, set an error variable
            if (!Validation::validBookIds($this->_f3, $approved)) {
                $this->_f3->set('errors["approved"]', 'Invalid value entered');
            }

            // Redirect to home route if there
            // are no errors (errors array is empty)
            if (empty($this->_f3->get('errors'))) {
                // Looping over the $approved array
                foreach ($approved as $id) {
                    $GLOBALS['dataLayer']->approveBook($id);
                }
                $this->_f3->reroute('/admin-dashboard');
            }
        }

        // Set the title of the page
        $this->_f3->set('title', "Admin Dashboard");

        $books = $GLOBALS['dataLayer']->getUnapprovedBooks();

        $this->_f3->get('SESSION.person')->setBooksToApprove($books);


        // Define a view page
        $view = new Template();
        echo $view->render('views/admin-dashboard.html');
    }


    /**
     * Controller for the lists route
     */
    function listings()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            // Get the data
            $sortBy = (isset($_POST['sort'])) ? $_POST['sort'] : '';

            if (Validation::validateSorting($sortBy)) {
                $this->_f3->set('SESSION.sort', $sortBy);

                $books = $GLOBALS['dataLayer']->sortBy($this->_f3->get('SESSION.sort'));
                // Get the data from the model and add to a new card
                $this->_f3->set('SESSION.books', $books);
            }
            else {
                $this->_f3->set('errors["sortBy"]', 'Invalid Selection');
            }
        }

        // Set the title of the page
        $this->_f3->set('title', "Listings");


        // Define a view page
        $view = new Template();
        echo $view->render('views/lists.html');
    }


    /**
     * Controller for the search-results route
     */
    function searchResults()
    {
        //If the form has been posted
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            // Get the data
            $search = (isset($_POST['search'])) ? $_POST['search'] : '';


            $this->_f3->set('SESSION.search', $search);
            $books = $GLOBALS['dataLayer']->search($this->_f3->get('SESSION.search'));

            $this->_f3->set('SESSION.books', $books);

        }

        // Set the title of the page
        $this->_f3->set('title', "Search Results");


        // Define a view page
        $view = new Template();
        echo $view->render('views/search-results.html');
    }


    /**
     * Controller for the book route
     */
    function book()
    {
        if(!isset($_GET['id'])){
            //Redirect to the default route
            $this->_f3->reroute('/');
        }

        $book_id = $_GET['id'];
        $book = $GLOBALS['dataLayer']->getBook($book_id);
        $this->_f3->set('SESSION.book', $book);

        // Set the title of the page
        $this->_f3->set('title', $book->getTitle());


        // Define a view page
        $view = new Template();
        echo $view->render('views/book.html');
    }


    /**
     * Controller for the logout route
     */
    function logout()
    {
        session_start();


        // Destroys session array
        session_destroy();

        $this->_f3->reroute('/');
    }


    /**
     * Controller for the edit-book route
     */
    function editBook()
    {
        if (!Validation::loggedIn($this->_f3)) {
            $this->_f3->reroute('/login');
        }

        if ($this->_f3->get('SESSION.person') instanceof Admin){
            $this->_f3->reroute('/');
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


            // Redirect to home route if there
            // are no errors (errors array is empty)
            if (empty($this->_f3->get('errors'))) {
                $owner = $this->_f3->get('SESSION.person')->getPersonId();
                $book = new Book($title, $owner, $authors, $price, '', '', $description, $subject, $edition);
                $book->setBookId($this->_f3->get('SESSION.book')->getBookId());
                $this->_f3->set('SESSION.book', $book);
                $book_id = $GLOBALS['dataLayer']->updateBook($this->_f3->get('SESSION.book'));
                if(!empty($book_id)){
                    $this->_f3->set('SESSION.alert', 'Your book information is edited successfully.');
                }

                $this->_f3->reroute('/');
            }
        }

        if(!isset($_GET['id'])){
            //Redirect to the default route
            $this->_f3->reroute('/');
        }

        $book_id = $_GET['id'];
        $book = $GLOBALS['dataLayer']->getBook($book_id);
        $this->_f3->set('SESSION.book', $book);

        // If person is not the owner reroute to home
        if ($this->_f3->get('SESSION.person')->getPersonId() != $book->getOwner()){
            $this->_f3->reroute('/');
        }

        // Set the title of the page
        $this->_f3->set('title', "Edit: " . $book->getTitle());


        // Define a view page
        $view = new Template();
        echo $view->render('views/edit-book.html');
    }


    /**
     * Controller for the delete-book route
     */
    function deleteBook()
    {
        if (!Validation::loggedIn($this->_f3)) {
            $this->_f3->reroute('/login');
        }

        if ($this->_f3->get('SESSION.person') instanceof Admin){
            $this->_f3->reroute('/');
        }

        //If the form has been posted
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $book_id = $GLOBALS['dataLayer']->deleteBook($this->_f3->get('SESSION.book')->getBookId());
            if(!empty($book_id)){
                $this->_f3->set('SESSION.alert', 'Your book is deleted successfully.');
            }

            $this->_f3->reroute('/');

        }

        if(!isset($_GET['id'])){
            //Redirect to the default route
            $this->_f3->reroute('/');
        }

        $book_id = $_GET['id'];
        $book = $GLOBALS['dataLayer']->getBook($book_id);
        $this->_f3->set('SESSION.book', $book);

        // If person is not the owner reroute to home
        if ($this->_f3->get('SESSION.person')->getPersonId() != $book->getOwner()){
            $this->_f3->reroute('/');
        }

        // Set the title of the page
        $this->_f3->set('title', "Edit: " . $book->getTitle());


        // Define a view page
        $view = new Template();
        echo $view->render('views/delete-book.html');
    }

    /**
     * Controller for the forgot-password route
     */
    function forgotPassword()
    {
        //If the form has been posted
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            // Get the data
            $email = (isset($_POST['email'])) ? $_POST['email'] : '';

            // *** If email is not valid, set an error variable
            if (!Validation::validEmail($email)) {
                $this->_f3->set('errors["email"]', 'Invalid email entered');
            }


            // Redirect to home route if there
            // are no errors (errors array is empty)
            if (empty($this->_f3->get('errors'))) {

                $uuid = $GLOBALS['dataLayer']->passwordResetLink($email);
                $send_email = SendEmail::sendPasswordResetLink($email, $this->_f3->get('OUR_EMAIL'), $uuid, $this->_f3);
                if($send_email){
                    $this->_f3->set('SESSION.alert', 'Check your email for password reset link.');
                }

                $this->_f3->reroute('/');
            }

        }

        // Set the title of the page
        $this->_f3->set('title', 'Forgot Password');


        // Define a view page
        $view = new Template();
        echo $view->render('views/forgot-password.html');
    }

    /**
     * Controller for the reset-password route
     */
    function resetPassword()
    {
        //If the form has been posted
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            // Get data
            $password = (isset($_POST['password'])) ? $_POST['password'] : '';
            $confirm_password = (isset($_POST['confirmPassword'])) ? $_POST['confirmPassword'] : '';

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

                $GLOBALS['dataLayer']->updatePassword($_POST['uuid'], $password);

                $this->_f3->set('SESSION.alert', 'Your password is updated successfully.');


                $this->_f3->reroute('/');
            }

        }

        if(!isset($_GET['uuid'])){
            //Redirect to the default route
            $this->_f3->reroute('/');
        }

        $uuid = $_GET['uuid'];
        $result = $GLOBALS['dataLayer']->checkUuidExpirationTime($uuid);

        if(!$result){
            $this->_f3->set('expired', 'Your password reset link is expired.');
        } else {
            $this->_f3->set('uuid', $uuid);
        }

        // Set the title of the page
        $this->_f3->set('title', 'Reset Password');


        // Define a view page
        $view = new Template();
        echo $view->render('views/reset-password.html');
    }
}
