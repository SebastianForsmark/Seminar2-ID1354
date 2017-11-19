<?php
session_start();
include("dbconnect.php");
include("simplexml.php")
?>

<?php
if (filter_input_array(INPUT_POST) && filter_input(INPUT_POST, 'delete')) {
    $toDelete = filter_input(INPUT_POST, 'delete');
    $sql = "DELETE FROM comments WHERE id='$toDelete'";
    $result = mysqli_query($db, $sql);
}


if (filter_input_array(INPUT_POST) && !filter_input(INPUT_POST, 'delete')) {
    $username = $_SESSION['login_user'];
    $row = filter_input(INPUT_POST, 'comment');
    $date = date('Y-m-d');
    $sql = "INSERT INTO comments (username, date, comment) VALUES ('$username', '$date', '$row')";
    $commentSuccess = mysqli_query($db, $sql);

    if (!$commentSuccess) {
        echo("Unable to save comment at this time.");
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
        <link rel="stylesheet" type="text/css" href="css/comments.css">        
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
                <form action="calendar.php">
                    <input type="submit" value="Calendar" />
                </form>     

                <form action="index.php#featuredrecipes">
                    <input type="submit" value="Other recipes:" />
                </form>
                <form action="recipe-meatballs.php">
                    <input type="submit" value="Meatballs" />
                </form>                        

            </div>
        </div>
        <div>
            <h1 id="startOfRecipe">
                <?php echo $recipes->recipe[1]->title; ?>
            </h1>
            <div class="row">
                <div class="six columns">

                    <img id="recipePage" src="<?php echo $recipes->recipe[1]->imagepath; ?>" alt="A picture of a stack of pancakes with 2 sausages charmingly placed on top">
                </div>

                <div class="six columns">
                    <h3>Ingredients:</h3>
                    <ul>
                        <?php
                        foreach ($recipes->recipe[1]->ingredient->children() as $a => $b) {
                            ?>
                            <li><?php echo "$b" ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="row">
                <h3>Instructions:</h3>
                <ol>
                    <?php
                    foreach ($recipes->recipe[1]->recipetext->children() as $a => $b) {
                        ?>
                        <li><?php echo "$b" ?></li>
                    <?php } ?>
                </ol>
            </div>

            <div>
                <div>

                    <!-- Comment Submission -->
                    <?php if (isset($_SESSION['login_user'])) { ?>
                        <h3>Submit comment</h3>
                        <form action="recipe-pancakes.php" method="post">
                            <div>
                                <textarea name="comment" id="comment"></textarea>
                            </div>
                            <input type="submit" value="Submit">
                        </form> 
                    <?php } ?>
                    <!-- Comment Display -->

                    <h4>Comments:</h4>
                    <div class="comments">
                        <?php
                        $sql = "SELECT id, username, date, comment FROM comments";
                        $result = mysqli_query($db, $sql);
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            ?>
                            <?php if (isset($_SESSION['login_user']) && $row['username'] == $_SESSION['login_user']) { ?>
                                <form action = "recipe-pancakes.php" method="POST">
                                    <button id="deleteButton" type=submit name="delete" value="<?php echo($row['id']) ?>">Delete</button>
                                </form>
                            <?php }
                            ?>
                            <p id="username"><?php echo($row['username']) ?>:</p>
                            <p id="comment"><?php echo($row['comment']) ?></p>
                            <p id ="date"><?php echo($row['date']) ?></p>
                        <?php }
                        ?>

                    </div>
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
    </body>

</html>
