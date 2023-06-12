<?php
/**
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 *
 * Created 5/8/2023
 * 328/secondhand-books/index.php
 * Controller for Sleeping Donuts project
 */

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the autoload file
require_once('vendor/autoload.php');

$dataLayer = new DataLayer();

// Create an instance for f3 object
$f3 = Base::instance();
$con = new Controller($f3);
$f3->OUR_EMAIL = 'jokar.mehdi@student.greenriver.edu';


// Define a default route for home
$f3->route('GET /', function($f3) {


    // Set the title of the page
    $f3->set('title', "Home");
    //$alert = 'This alert will be used for showing a successful operation!';
    $f3->set('alert', $f3->get('SESSION.alert'));
    $f3->set('SESSION.alert', '');

    // Get the data from the model and add to a new card
    $f3->set('books', DataLayer::getBooks());

    // Define a view page
    $view = new Template();
    echo $view->render('views/home.html');
});

// Define a default route for home
$f3->route('GET /home', function($f3) {

    // Get the data from the model and add to a new card
    $f3->set('books', DataLayer::getBooks());

    //Redirect to the default route
    $f3->reroute('/');
});

// Define an about-us route
$f3->route('GET /about-us', function($f3) {

    // Set the title of the page
    $f3->set('title', "About Us");


    // Define a view page
    $view = new Template();
    echo $view->render('views/about-us.html');
});

// Define a book route
$f3->route('GET /book', function() {
    $GLOBALS['con']->book();
});


// Define a terms-of-services route
$f3->route('GET /terms-of-services', function() {
    $GLOBALS['con']->termsOfServices();
});


// Define a faq route
$f3->route('GET /faq', function() {
    $GLOBALS['con']->faq();
});


// Define a contact-us route
$f3->route('GET|POST /contact-us', function() {
    $GLOBALS['con']->contactUS();
});


// Define a contact-owner route
$f3->route('GET|POST /contact-owner', function($f3) {

    if (!Validation::loggedIn($f3)) {
        $f3->reroute('/login');
    }


    // Set the title of the page
    $f3->set('title', "Contact Owner");


    // Define a view page
    $view = new Template();
    echo $view->render('views/contact-owner.html');
});

// Define a login route
$f3->route('GET|POST /login', function() {
    $GLOBALS['con']->login();
});

// Define a register route
$f3->route('GET|POST /register', function() {
    $GLOBALS['con']->register();
});

// Define a profile route
$f3->route('GET|POST /profile', function($f3) {

    if (!Validation::loggedIn($f3)) {
        $f3->reroute('/login');
    }

    if ($f3->get('SESSION.person') instanceof Admin){
        $f3->reroute('/');
    }


    // Set the title of the page
    $f3->set('title', "Profile");


    // Define a view page
    $view = new Template();
    echo $view->render('views/profile.html');
});

// Define an add-book route
$f3->route('GET|POST /add-book', function() {
    $GLOBALS['con']->addBook();
});


// Define a search-results route
$f3->route('GET|POST /search-results', function() {
    $GLOBALS['con']->searchResults();
});


// Define a admin-dashboard route
$f3->route('GET|POST /admin-dashboard', function($f3) {

    if (!Validation::loggedIn($f3)) {
        $f3->reroute('/login');
    }

    if ($f3->get('SESSION.person') instanceof User){
        $f3->reroute('/');
    }

    //If the form has been posted
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        // Get the data
        $approved = (isset($_POST['approved'])) ? $_POST['approved'] : '';

        // *** If price is not valid, set an error variable
        if (!Validation::validBookIds($f3, $approved)) {
            $f3->set('errors["approved"]', 'Invalid value entered');
        }

        // Redirect to home route if there
        // are no errors (errors array is empty)
        if (empty($f3->get('errors'))) {
            // Looping over the $approved array
            foreach ($approved as $id) {
                $GLOBALS['dataLayer']->approveBook($id);
            }
            $f3->reroute('/admin-dashboard');
        }
    }

    // Set the title of the page
    $f3->set('title', "Admin Dashboard");

    $books = $GLOBALS['dataLayer']->getUnapprovedBooks();

    $f3->get('SESSION.person')->setBooksToApprove($books);


    // Define a view page
    $view = new Template();
    echo $view->render('views/admin-dashboard.html');
});

// Define a lists route
$f3->route('GET|POST /lists', function($f3) {

    // Get the data from the model and add to a new card
    $f3->set('books', DataLayer::getBooks());

    // Set the title of the page
    $f3->set('title', "Lists");


    // Define a view page
    $view = new Template();
    echo $view->render('views/lists.html');
});



// Define a confirm-email route
$f3->route('GET /confirm-email', function() {
    $GLOBALS['con']->confirmEmail();
});


// Define a logout route
$f3->route('GET /logout', function() {
    $GLOBALS['con']->logout();
});


// Run Fat-Free
$f3 -> run();