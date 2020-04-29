<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Instantiate the F3 Base class
$f3 = Base::instance();   //Base is a class; instance() is a static method in the Base class
                          // this becomes the object we use to run fatfree
                          //PHP uses double colon to call static methods

//Define a default route
$f3->route('GET /', function() {
    //echo '<h1>Welcome to my Food Page</h1>';

    $view = new Template();
    echo $view->render('views/home.html');
});

//Breakfast route
$f3->route('GET /breakfast', function() {
    //echo '<h1>Welcome to my Breakfast Page</h1>';

    $view = new Template();
    echo $view->render('views/bfast.html');    //filename and route name don't have to be the same!
});

//Breakfast - green eggs & ham route
$f3->route('GET /breakfast/green-eggs', function() {
    //echo '<h1>Welcome to my Breakfast Page</h1>';

    $view = new Template();
    echo $view->render('views/greenEggsAndHam.html');    //filename and route name don't have to be the same!
                                                        // you can match any route to any page
});

//Lunch route
$f3->route('GET /lunch', function() {
    //echo '<h1>Welcome to my Breakfast Page</h1>';

    $view = new Template();
    echo $view->render('views/lunchView.html');    //filename and route name don't have to be the same!
    // you can match any route to any page
});

//Lunch - turkey panini route
$f3->route('GET /lunch/turkey-panini', function() {
    //echo '<h1>Welcome to my Breakfast Page</h1>';

    $view = new Template();
    echo $view->render('views/turkeysandwich.html');    //filename and route name don't have to be the same!
    // you can match any route to any page
});

//form
$f3->route('GET|POST /order', function ($f3){

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        //validate the data
        if(empty($_POST['food'])){
            echo"<p>Please enter a food</p>";
        }
        //data is valid
        else{
            $f3->reroute('summary');
        }

    }

    $view = new Template();
    echo $view->render("views/order.html");


});


//Run F3
$f3->run();               // -> to run instance methods





