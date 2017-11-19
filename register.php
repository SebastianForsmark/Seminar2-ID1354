<?php
include("dbconnect.php");
session_start();

if (filter_input_array(INPUT_POST)) {
    // username, password and email sent from form 
    $registerUserName = filter_input(INPUT_POST, 'username');
    $registerPassword = filter_input(INPUT_POST, 'password');
    $registerEmail = filter_input(INPUT_POST, 'email');

    $sql = "INSERT INTO registeredusers (userName, userEmail, userPass) VALUES ('$registerUserName', '$registerEmail', '$registerPassword')";
    $result = mysqli_query($db, $sql);

    if ($result) {
        $_SESSION['login_user'] = $registerUserName;

        header("location: welcome.php");
    } else {
        echo("We're sorry but we are unable to register new users right now.");
    }
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Tasty Recipes</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/reset.css">
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/skeleton.css">
    </head>

    <body>
        <div class="row">
            <div class="four columns">
                <a href="index.php"><img id="logo" src="resources/logo.png" alt="The logo of the website 2 chefs hats and the word Cooking"></a>
                <div class ="six columns"
                     <div class="menu">

                        <form action="index.php">
                            <input type="submit" value="Home" />
                        </form>

                        <?php if (!isset($_SESSION['login_user'])) { ?>

                            <button onclick="document.getElementById('id01').style.display = 'block'" <p>Log in</p></button>                                 


                        <?php } ?>

                        <?php if (isset($_SESSION['login_user'])) { ?>

                            <form action="logout.php">
                                <input type="submit" value="Log out" />
                            </form>
                        <?php } ?>


                        <form action="index.php#featuredrecipes">
                            <input type="submit" value="Featured recipes" />
                        </form>
                        <form action="calendar.php">
                            <input type="submit" value="Calendar" />
                        </form>                             
                    </div>
                </div>
                <div class="six columns">
                    <form class="form-signin" method="POST">
                        <h2 class="form-signin-heading">Please Register</h2>


                        <div class="input-group">
                            <span class="registration-input"></span>
                            <label for="inputUsername">User name</label>
                            <input type="text" name="username" id="inputText" placeholder="Username" required>
                        </div>

                        <div class="registration-input">
                            <label for="inputPassword">Password</label>
                            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                        </div>

                        <div class="registration-input">
                            <label for="inputEmail">Email address</label>
                            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>

                        </div>


                        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
                    </form>
                </div>
            </div>
            <?php include("login.php"); ?>
    </body>