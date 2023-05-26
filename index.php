<?php
/**
 * @author Anthony Gutierrez, Mehdi Jokar, Thanh Doan
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

// Run Fat-Free
$f3 -> run();