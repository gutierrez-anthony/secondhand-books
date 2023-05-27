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
require_once('model/data-layer.php');

// Create an instance for f3 object
$f3 = Base::instance();

// Define a default route for home
$f3->route('GET /', function($f3) {

    // Set the title of the page
    $f3->set('title', "Home");

    // Get the data from the model and add to a new card
    $f3->set('books', getBooks());

    // Define a view page
    $view = new Template();
    echo $view->render('views/home.html');
});

// Define a default route for home
$f3->route('GET /home', function($f3) {

    // Get the data from the model and add to a new card
    $f3->set('books', getBooks());

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
$f3->route('GET /book', function($f3) {

    // Set the title of the page
    $f3->set('title', "Book Information");


    // Define a view page
    $view = new Template();
    echo $view->render('views/book.html');
});


// Define a terms-of-services route
$f3->route('GET /terms-of-services', function($f3) {

    // Set the title of the page
    $f3->set('title', "Terms of Services");


    // Define a view page
    $view = new Template();
    echo $view->render('views/terms-of-services.html');
});


// Define a faq route
$f3->route('GET /faq', function($f3) {

    // Set the title of the page
    $f3->set('title', "FAQ");


    // Define a view page
    $view = new Template();
    echo $view->render('views/faq.html');
});


// Define a contact-us route
$f3->route('GET|POST /contact-us', function($f3) {

    // Set the title of the page
    $f3->set('title', "Contact Us");


    // Define a view page
    $view = new Template();
    echo $view->render('views/contact-us.html');
});


// Define a contact-owner route
$f3->route('GET|POST /contact-owner', function($f3) {

    // Set the title of the page
    $f3->set('title', "Contact Owner");


    // Define a view page
    $view = new Template();
    echo $view->render('views/contact-owner.html');
});

// Define a login route
$f3->route('GET|POST /login', function($f3) {

    // Set the title of the page
    $f3->set('title', "LogIn");


    // Define a view page
    $view = new Template();
    echo $view->render('views/login.html');
});

// Define a register route
$f3->route('GET|POST /register', function($f3) {

    // Set the title of the page
    $f3->set('title', "Register");


    // Define a view page
    $view = new Template();
    echo $view->render('views/register.html');
});

// Define a profile route
$f3->route('GET|POST /profile', function($f3) {

    // Set the title of the page
    $f3->set('title', "Profile");


    // Define a view page
    $view = new Template();
    echo $view->render('views/profile.html');
});

// Define an add-book route
$f3->route('GET|POST /add-book', function($f3) {

    // Set the title of the page
    $f3->set('title', "Add Book");


    // Define a view page
    $view = new Template();
    echo $view->render('views/add-book.html');
});


// Define a search-results route
$f3->route('GET|POST /search-results', function($f3) {

    // Set the title of the page
    $f3->set('title', "Search Results");


    // Define a view page
    $view = new Template();
    echo $view->render('views/search-results.html');
});


// Define a admin-dashboard route
$f3->route('GET|POST /admin-dashboard', function($f3) {

    // Set the title of the page
    $f3->set('title', "Admin Dashboard");


    // Define a view page
    $view = new Template();
    echo $view->render('views/admin-dashboard.html');
});

// Define a lists route
$f3->route('GET|POST /lists', function($f3) {

    // Get the data from the model and add to a new card
    $f3->set('books', getBooks());

    // Set the title of the page
    $f3->set('title', "Lists");


    // Define a view page
    $view = new Template();
    echo $view->render('views/lists.html');
});

// Run Fat-Free
$f3 -> run();