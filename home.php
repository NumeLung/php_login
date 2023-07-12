<?php

require_once "include/include.php";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

require_once "include/Database.php";
$db = new Database();
$options = $db->select("SELECT id, name FROM cities");

$employees = [];
if (!empty($_POST['cities'])) {
    $employees = $db->select("SELECT * FROM employees WHERE idCity = " . intval($_POST['cities']));
}


//todo formi4ka za dobavqne i redaktirane na slujiteli
/*redaktirane e sus id na klient, update query
nov klient e bez id, insert query*/

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
            <a href="home.php" class="active">Home</a>
        </div>


        <!-- The Modal -->
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" id="clearContent">&times;</span>
                    <h2>Добавяне на потербител</h2>
                </div>
                <div class="modal-body">
                    <form>
                        <label>Име</label><br>
                        <input type="text" id="inputFirstName"><br>
                        <label>Фамилия</label><br>
                        <input type="text" id="inputLastName"><br>
                        <label>Работно място</label><br>
                        <input type="text" id="inputTitle"><br>
                        <label>Нарицание</label><br>
                        <input type="text" id="inputTitleOfCourtesy"><br>
                        <label>Рожденна дата</label><br>
                        <input type="text" id="inputBirthDate"><br>
                        <label>Дата наемане</label><br>
                        <input type="text" id="inputHireDate"><br>
                        <label>Адрес</label><br>
                        <input type="text" id="inputAddress"><br>
                        <label>Град</label><br>
                        <?php
                            echo "<select id='inputCity'>";
                            echo "<option value=''>Град</option>";
                            foreach ($options as $option) {
                            $selected = $_POST['cities'] == $option['id'] ? 'selected' : '';
                            echo "<option $selected value='{$option['id']}'>{$option['name']}</option>";
                            }
                            echo "</select>";
                            ?>
                    </form>
                </div>
                <div class="modal-footer">

                    <button type="submit" style="text-align: center;">Подай</button>
                </div>
            </div>
        </div>
        <!--<div class="container"></div>-->

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
             echo "<button style=\"text-align: center; margin-top: 10px;\">Изпрати</button><br>";
             echo "<button type=\"button\" id=\"myBtn\" style=\"margin-top: 15px;\">Добави потребител</button>";
             echo "</form>";
            }
             ?>
            <!-- Debug info
            <p style="text-align: center;">ID на избрания град: <span id="selectedCity"><?php /*=($_POST['cities']??'')*/?></span></p>-->
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
