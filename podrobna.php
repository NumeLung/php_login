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
$titleoptions = $db->select("SELECT DISTINCT(Title) FROM employees ORDER BY Title ASC");

$employees = [];
if (!empty($_POST['search_city_properties'])) {
    $employees = $db->select("SELECT * FROM employees WHERE idCity = " . intval($_POST['search_city_properties']));
}
$searchOption = $_POST['search_options'] ?? '';
?>


<?php
        if ($_SESSION["isAdmin"] == 1){ ?>
        <div class="container">
            <form method="POST">

                <label for="search_options">Търсене по:</label>
                <select name="search_options" id="search_options">
                    <option value="0">Изберете опция</option>
                    <option value="city" <?= $searchOption == 'city' ? 'selected' : '' ?> > Град</option>
                    <option value="years" <?= $searchOption == 'years' ? 'selected' : '' ?>>Година раждане</option>
                    <option value="title" <?= $searchOption == 'title' ? 'selected' : '' ?>>Длъжност</option>
                </select><br>

                <label for="search_properties" id="critlabel" style="display: <?php if(in_array($searchOption, ['city', 'years', 'title'])) { echo "";} else { echo "none";} ?> ">Критерии:</label>
                <select name="search_city_properties" id="search_city_properties" style="margin-top: 20px; display: <?= $_POST['search_options'] == 'city' ? '' : 'none' ?> ;" >
                    <option value="0">Всички градове</option>
                        <?php
                        foreach ($options as $option){
                            $selected = $_POST['search_city_properties'] == $option['id'] ? 'selected' : '';
                            echo  "<option $selected value=\"{$option['id']}\">{$option['name']}</option>";
                        }
                        ?>
                </select>
                <select name="search_year_properties" id="search_year_properties" style="margin-top: 20px; display: <?= $_POST['search_options'] == 'years' ? '' : 'none' ?> ;">
                    <option value="allyears" style="text-align: center;">Всички години</option>
                    <?php
                    foreach ($years as $yearsoption){
                        $selectedyear = $_POST['search_year_properties'] == $yearsoption['BirthDate'] ? 'selected' : '';
                        echo  "<option $selectedyear value=\"{$yearsoption['BirthDate']}\">{$yearsoption['BirthDate']}</option>";
                    }
                    ?>
                </select>
                <select name="search_title_properties" id="search_title_properties" style="margin-top: 20px; display: <?= $_POST['search_options'] == 'title' ? '' : 'none' ?> ;;">
                    <option value="alltitles" style="text-align: center;">Изберете титла</option>
                    <?php
                    foreach ($titleoptions as $titleoption){
                        $selectedtitle = $_POST['search_title_properties'] == $titleoption['Title'] ? 'selected' : '';
                        echo  "<option $selectedtitle value=\"{$titleoption['Title']}\">{$titleoption['Title']}</option>";
                    }
                    ?>
                </select><br>
                <button type="submit" style="margin-top: 20px;">Подай</button><br>
                <button type="button" id="myBtn" style="margin-top: 15px;">Добави потребител</button>
            </form>
        </div>
<?php } ?>