<?php
session_start();
// Check if the user is logged in as a regular user
if (!isset($_SESSION["username"])) {
    // Redirect to the login page or display an error message
    header("Location: login.html");
    exit();
}
?>

<html>

    <head>

    </head>
    <body>
        <form action="logout.php" method="post">
            <input type="submit" value="Logout">
        </form>
    </body>
</html>


