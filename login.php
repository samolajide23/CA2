<?php
session_start();

include_once("config.php");

$message = "";

if (isset($_POST['login'])) {

    $con = config::connect();

    if (empty($_POST["loginUsername"]) || empty($_POST["loginPassword"])) {
        echo '<label class="text-danger"><p>All fields are required </p></label>';
    } else {
        $query = "SELECT * FROM users WHERE username = :username AND password = :password";
        $statement = $con->prepare($query);
        $statement->execute(
            array(
                'username' => $_POST["loginUsername"],
                'password' => $_POST["loginPassword"]
            )
        );
        $count = $statement->rowCount();


        if ($count > 0) {
            $_SESSION["loginUsername"] = $_POST["loginPassword"];
            if ($_POST["loginUsername"] == "admin" && $_POST["loginPassword"] == "admin") {
                header("location: adminCourses.php");
            } else {
                header("location: courses.php");
            }
        } else {
            echo '<label class="text-danger"><p> Invalid username/Password</p></label>';
        }
    }
}

if (isset($_POST["register"])) {

    $con = config::connect();

    if (empty($_POST["regUsername"]) || empty($_POST["regPassword"]) || empty($_POST["regEmail"])) {
        echo '<label class="text-danger"><p>All fields are required </p></label>';
    } else {
        $query = "SELECT * FROM users WHERE username = :username OR email = :email";
        $statement = $con->prepare($query);
        $statement->execute(
            array(
                'username' => $_POST["regUsername"],
                'email' => $_POST["regEmail"]
            )
        );
        $count = $statement->rowCount();

        if ($count == 0) {
            $query = $con->prepare("
                INSERT INTO users( username, email, password )
                VALUES( :username, :email, :password )
            ");

            $query->bindParam(":username", $_POST["regUsername"]);
            $query->bindParam(":email", $_POST["regEmail"]);
            $query->bindParam(":password", $_POST["regPassword"]);
            $query->execute();

            echo '<label class="text-success"><p> Succesfully registered </p></label>';
        } else {
            echo '<label class="text-danger"><p> Invalid username/Email already in use </p></label>';
        }
    }
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <title>Signup Form</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mystyle.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</head>

<body>
    <header>
        <div class="nav-container">
            <nav class="navbar">
                <h1 id="navbar-logo">CAO DATABASE</h1>
                <div class="menu-toggle">
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </nav>
        </div>
    </header>
    <div id="error"></div>
    <div class="container" id="container">
        <div class="leftBox">
            <h1> Log In </h1>

            <form method="post">
                    <input type="text" name="loginUsername" placeholder="username" class="form-control">
                    
                    <input type="password" name="loginPassword" placeholder="password" class="form-control">
                    
                <input type="submit" value="Login" class="btn btn-info" name="login">

            </form>
        </div>
        <div class="rightBox">
            <h1> Sign Up </h1>

            <form id="loginForm" method="post">

                <input type="text" name="regUsername" placeholder="Username">
                <input type="email" name="regEmail" placeholder="Email">
                <input type="password" name="regPassword" placeholder="Password" >

                <input type="submit" value="sign up" name="register">

            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn"> Sign In </button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, There!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp"> Sign Up </button>
                </div>
            </div>
        </div>
    </div>
    <script src="main.js"></script>
    <script src="validation.js"></script>
</body>

</html>