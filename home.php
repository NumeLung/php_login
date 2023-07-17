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
                <label for="cities">Град</label>
                <select name="cities" id="cities">
                    <option value="0">Изберете град</option>
                        <?php
                        foreach ($options as $option){
                        $selected = $_POST['cities'] == $option['id'] ? 'selected' : '';
                        echo  "<option $selected value=\"{$option['id']}\">{$option['name']}</option>";
                        }
                        ?>
                </select>
                <button style="text-align: center; margin-top: 10px;">Изпрати</button><br>
                <button type="button" id="myBtn" style="margin-top: 15px;">Добави потребител</button>
            </form>

            <!--forma za obobshten izlged-->
            <form method="POST">
                <label for="summary">Обобщи</label>
                <select name="summary" id="summary">
                    <option value="0">Избери опция</option>
                    <option value="citysum">Град</option>
                    <option value="titlesum">Работа</option>
                    <option value="titleocsum">Нарицание</option>
                </select>
                <button>Заявка</button>
            </form>

            <!--modal da pokazva rezultatite obshtite podrobno-->
                <div id="myModal2" class="modal">
                    <form id="ModalForm" method="POST" style="margin: 0px;" action="include/add_update_employee.php">

                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="close" id="clearContent">&times;</span>
                                <h2>Резултат</h2>
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">Край на резултата</div>
                        </div>
                    </form>
                </div>
            <?php require "include/summary.php" ?>
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
