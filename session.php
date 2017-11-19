<?php
   include('dbconnect.php');
   session_start();
  
 if (isset($_SESSION['login_user'])) {

   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select username from registeredusers where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   }
?>