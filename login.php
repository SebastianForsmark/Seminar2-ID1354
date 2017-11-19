<div id="id01" class="modal">
    <span onclick="document.getElementById('id01').style.display = 'none'"
          class="close" title="Close Modal">&times;</span>

    <!-- Modal Content -->
    <div class="modal-content animate">
        <div class="imgcontainer">
            <img src="resources/logo.png" alt="The logo of the website 2 chefs hats and the word Cooking">
        </div>
        <div class="container">
            <p class="psw">Want to <a href="register.php">register?</a></p>
        </div>
        <div class="container">
            <form action="index.php" method="post">
                <label>Username: </label><input type = "text" name = "username" class = "box"/><br /><br />
                <label>Password: </label><input type = "password" name = "password" class = "box" /><br/><br />
                <input type = "submit" value = "Submit"/><br />
                <button type="button" onclick="document.getElementById('id01').style.display = 'none'" class="cancelbtn">Cancel</button>
                
            </form>

        </div>
    </div>
