<?php

require_once "include/include.php";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

require_once "include/Database.php";
$db = new Database();

$options = $db->select("SELECT id, name FROM cities");
$years = $db->select("SELECT DISTINCT(YEAR(Birthdate)) AS BirthDate FROM employees;");
$titlecoptions = $db->select("SELECT DISTINCT(Title) FROM employees ORDER BY Title ASC");

$employees = [];
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
            <a href="home.php" class="active">Home</a>
        </div>

        <?php
        if ($_SESSION["isAdmin"] == 1){
            ?>
        <!-- The Modal -->
        <div id="myModal" class="modal">
            <form id="ModalForm" method="POST" style="margin: 0px;" action="include/add_update_employee.php">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" id="clearContent">&times;</span>
                    <h2>Добавяне на потербител</h2>
                </div>
                <div class="modal-body">
                        <!--<label>ID</label><br>-->
                        <input type="text" name="inputEmployeeID" id="inputEmployeeID" style="display: none;"><br>
                        <label>Име</label><br>
                        <input type="text" name="inputFirstName" id="inputFirstName"><br>
                        <label>Фамилия</label><br>
                        <input type="text" name="inputLastName" id="inputLastName"><br>
                        <label>Работно място</label><br>
                        <input type="text" name="inputTitle" id="inputTitle"><br>
                        <label>Нарицание</label><br>
                        <input type="text" name="inputTitleOfCourtesy" id="inputTitleOfCourtesy"><br>
                        <label>Рожденна дата</label><br>
                        <input type="text" name="inputBirthDate" id="inputBirthDate" value="YYYY-MM-DD 00:00:00"><br>
                        <label>Дата наемане</label><br>
                        <input type="text" name="inputHireDate" id="inputHireDate" value="YYYY-MM-DD 00:00:00"><br>
                        <label>Адрес</label><br>
                        <input type="text" name="inputAddress" id="inputAddress"><br>
                        <label>Град</label><br>
                        <?php
                            echo "<select id='inputIdCity' style=\"margin-bottom: 20px;\" name='inputIdCity'>";
                            echo "<option value=''>Град</option>";
                            foreach ($options as $option) {
                            $selected = $_POST['cities'] == $option['id'] ? 'selected' : '';
                            echo "<option $selected value='{$option['id']}'>{$option['name']}</option>";
                            }
                            echo "</select>";
                            ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Подай</button>
                </div>
            </div>
            </form>
        </div>
        <?php
        }
        ?>

        <?php
        if ($_SESSION["isAdmin"] == 1){ ?>
        <div class="container">
            <form method="POST">

                <label for="search_options">Търсене по:</label>
                <select name="search_options" id="search_options">
                    <option value="0">Изберете опция</option>
                    <option value="city">Град</option>
                    <option value="years">Година раждане</option>
                    <option value="titleofcourtesy">Длъжност</option>
                </select><br>

                <label for="search_properties" id="critlabel" style="display: none;">Критерии:</label>
                <select name="search_city_properties" id="search_city_properties" style="margin-top: 20px; display: none;">
                    <option value="allcities">Всички градове</option>
                        <?php
                        foreach ($options as $option){
                            $selected = $_POST['cities'] == $option['id'] ? 'selected' : '';
                            echo  "<option $selected value=\"{$option['id']}\">{$option['name']}</option>";
                        }
                        ?>
                </select>
                <select name="search_year_properties" id="search_year_properties" style="margin-top: 20px; display: none;">
                    <option value="allyears" style="text-align: center;">Всички години</option>
                    <?php
                    foreach ($years as $yearsoption){
                        $selectedyear = $_POST['employees'] == $yearsoption['BirthDate'] ? 'selected' : '';
                        echo  "<option $selectedyear value=\"{$yearsoption['BirthDate']}\">{$yearsoption['BirthDate']}</option>";
                    }
                    ?>
                </select>
                <select name="search_titleofcourt_properties" id="search_titleofcourt_properties" style="margin-top: 20px; display: none;">
                    <option value="alltitles" style="text-align: center;">Изберете титла</option>
                    <?php
                    foreach ($titlecoptions as $tcoption){
                        $selectedtitle = $_POST['employees'] == $tcoption['Title'] ? 'selected' : '';
                        echo  "<option $selectedtitle value=\"{$tcoption['Title']}\">{$tcoption['Title']}</option>";
                    }
                    ?>
                </select><br>
            </form>
            <button type="button" id="myBtn" style="margin-top: 15px;">Добави потребител</button>
        </div>
        <?php } ?>
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
