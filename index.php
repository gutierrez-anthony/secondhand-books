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
//$f3->start();


// Define a default route for home
$f3->route('GET /', function() {
    $GLOBALS['con']->home();
});


// Define a default route for home
$f3->route('GET /home', function() {
    $GLOBALS['con']->home();
});


// Define an about-us route
$f3->route('GET /about-us', function() {
    $GLOBALS['con']->aboutUs();
});


// Define a contact-us route
$f3->route('GET|POST /contact-us', function() {
    $GLOBALS['con']->contactUS();
});


// Define a terms-of-services route
$f3->route('GET /terms-of-services', function() {
    $GLOBALS['con']->termsOfServices();
});


// Define a faq route
$f3->route('GET /faq', function() {
    $GLOBALS['con']->faq();
});


// Define a register route
$f3->route('GET|POST /register', function() {
    $GLOBALS['con']->register();
});


// Define a login route
$f3->route('GET|POST /login', function() {
    $GLOBALS['con']->login();
});


// Define a contact-owner route
$f3->route('GET|POST /contact-owner', function() {
    $GLOBALS['con']->contactOwner();
});


// Define an add-book route
$f3->route('GET|POST /add-book', function() {
    $GLOBALS['con']->addBook();
});


// Define a profile route
$f3->route('GET|POST /profile', function() {
    $GLOBALS['con']->profile();
});


// Define a confirm-email route
$f3->route('GET /confirm-email', function() {
    $GLOBALS['con']->confirmEmail();
});


// Define a admin-dashboard route
$f3->route('GET|POST /admin-dashboard', function() {
    $GLOBALS['con']->adminDashboard();
});


// Define a lists route
$f3->route('GET|POST /lists', function() {
    $GLOBALS['con']->listings();
});


// Define a search-results route
$f3->route('GET|POST /search-results', function() {
    $GLOBALS['con']->searchResults();
});


// Define a book route
$f3->route('GET /book', function() {
    $GLOBALS['con']->book();
});


// Define an edit book route
$f3->route('GET /edit-book', function() {
    $GLOBALS['con']->editBook();
});


// Define a logout route
$f3->route('GET /logout', function() {
    $GLOBALS['con']->logout();
});


// Run Fat-Free
$f3 -> run();