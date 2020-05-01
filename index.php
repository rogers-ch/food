<?php
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

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
$f3->route('GET|POST /order', function($f3){      // |POST tells f3 it can access the order route via the Post method
                                                    // as well as the GET method.  And you can make a different route for
                                                    // POST /order if you want to.

    //If the form has been submitted
    if($_SERVER["REQUEST_METHOD"]=="POST") {
        var_dump($_POST);
        //array(2) { ["food"]=> string(5) "tacos" ["meal"]=> string(5) "lunch" }

        //validate the data
        $meals = array("breakfast", "lunch", "dinner");

        if(empty($_POST['food']) || !in_array($_POST['meal'], $meals)) {
            echo"<p>Please enter a food and select a meal</p>";
        }

        //data is valid
        else {
            //Store the data in the session array - b/c this form is posting to self, and you don't want to lose data
            // when you go to the summary page
            $_SESSION['food'] = $_POST['food'];
            $_SESSION['meal'] = $_POST['meal'];

            //Redirect to summary page
            $f3->reroute('summary');
            session_destroy();   //to make sure we're starting with a blank slate the next time someone comes to place an order
                                    //any site shared on one domain shares the same session, so it's important to destroy the session when
                                    // you are done with it so you don't run into old data or data from a different app.
        }

    }


    $view = new Template();
    echo $view->render("views/order.html");


});

//Summary route
$f3->route('GET /summary', function() {
    //echo '<h1>Welcome to my summary</h1>';

    $view = new Template();
    echo $view->render('views/summary.html');

});


//Run F3
$f3->run();               // -> to run instance methods





