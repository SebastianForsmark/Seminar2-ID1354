<?php
include("dbconnect.php");
session_start();

if (filter_input_array(INPUT_POST)) {
    $myusername = filter_input(INPUT_POST, 'username');
    $mypassword = filter_input(INPUT_POST, 'password');
    $sql = "SELECT userId FROM registeredusers WHERE userName = '$myusername' and userPass = '$mypassword'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row
    if ($count == 1) {
        $_SESSION['login_user'] = $myusername;
        
        header("location: welcome.php");
    } else {
        echo("We're afraid we can't find a user with that name and password");
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
        <link rel="stylesheet" type="text/css" href="css/skeleton.css">
    </head>

    <body>
        <div class="row">
            <div class="four columns">
                <a href="index.php"><img id="logo" src="resources/logo.png" alt="The logo of the website 2 chefs hats and the word Cooking"></a>
            </div>
        </div>
        <div>
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
        <div class="container">
            <div class="row" id="featuredrecipes">
                <h3>Featured Recipes</h3>
                <div class="five columns">
                    <a href="recipe-meatballs.php#startOfRecipe"><img src="resources/meatballs.jpg" alt="A picture of meatballs served with delicious mashed potatoes"></a>
                    <h3><a href="recipe-meatballs.php">Swedish Meatballs</a></h3>
                    <p>by: Karim</p>
                </div>
                <div class="five columns">
                    <a href="recipe-pancakes.php#startOfRecipe"><img src="resources/pancakes.jpg" alt="A picture of a stack of pancakes with 2 sausages charmingly placed on top"></a>
                    <h3><a href="recipe-pancakes.php">Pancake</a></h3>
                    <p>by: Mikael</p>
                </div>
            </div>
        </div>
        <div class="socialMediaLinks">
            <h5>Find us on social media</h5>
            <a href="" target="_blank" id="facebook">Facebook</a>
            <a href="" target="_blank" id="twitter">Twitter</a>
            <a href="" target="_blank" id="youtube">Youtube</a>
            <a href="" target="_blank" id="flickr">Flickr</a>
            <a href="" target="_blank" id="googleplus">Google&#43;</a>
        </div>
        <div class="footer">
            <p>
                &copy; <em>Copyright 2019. No rights reserved</em>
            </p>
        </div>


        <?php include("login.php"); ?>


    </div>
</div>

</body>

</html>
