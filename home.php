<?php

require_once "include/include.php";

if (!isset($_SESSION["username"])/* || empty($_SESSION["isAdmin"])*/) {
    header("Location: login.php");
    exit();
}

require_once "include/Database.php";
$db = new Database();
$options = $db->select("SELECT id, name FROM cities");

$employees = [];
/*$idCity = !empty($_POST['cities']) ? $_POST['cities'] : $_GET['cities'];*/
if (!empty($_POST['cities'])) {
    $employees = $db->select("SELECT * FROM employees WHERE idCity = " . intval($_POST['cities']));
}
?>

<html>
    <head>
        <title>Home page</title>
        <link rel="stylesheet" href="include/style.css">
        <script src="include/script.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>

        <div id="navbar">
            <a href="logout.php">Logout</a>
            <!--<a href="user.php">User DB Finder</a>-->
            <a href="home.php" class="active">Home</a>
        </div>

        <div class="container">
            <?php
            if ($_SESSION["isAdmin"] == 1){

                echo "<form method=\"POST\">";
                echo "<label for=\"cities\">Град</label>";
                echo "<select name=\"cities\" id=\"cities\">";
                echo "<option value=\"0\">Изберете град</option>";

                foreach ($options as $option){
                $selected = $_POST['cities'] == $option['id'] ? 'selected' : '';
                echo  "<option $selected value=\"{$option['id']}\">{$option['name']}</option>";
                }

             echo "</select>";
             echo "<br>";
             echo "<button type=\"submit\" style=\"text-align: center; margin-top: 10px;\">Изпрати</button>";
             echo "</form>";
            }
             ?>
            <!--<p style="text-align: center;">ID на избрания град: <span id="selectedCity"><?php /*=($_POST['cities']??'')*/?></span></p>-->
        </div>
        <div class="container">
            <p style="text-align: center;">
                <?php require_once "include/generateDB.php" ?>
            </p>
        </div>

        <div class="footer" id="footer">
            <p> Made by:
                <a href="https://www.instagram.com/ivaylo.kolev1/" class="insta">Ivaylo Kolev</a>
            </p>
        </div>

    </body>
</html>
