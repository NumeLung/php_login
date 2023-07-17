<?php
require_once "include/config.php";

$db = new Database();

$summary = [];
switch ($_POST['summary']){
    case "citysum":
        $summary = $db->select("
        SELECT  c.name AS CityName, COUNT(e.IdCity) empcount,
        CASE
            WHEN LENGTH(CONCAT(GROUP_CONCAT(' ', e.FirstName))) > 100
            THEN CONCAT(LEFT(CONCAT(GROUP_CONCAT(' ', e.FirstName)), 100), '...')
            ELSE CONCAT(GROUP_CONCAT(' ', e.FirstName))
        END AS ConcatenatedNames
        FROM employees e
        JOIN cities c ON e.IdCity = c.id
        GROUP BY e.IdCity, c.name
");
        echo "<table>";
        echo "<tr><th>Град</th><th>Брой Хора</th><th>Имена</th>";
        foreach ($summary as $row) {
            /*$aEmployeesForJS[$employee["EmployeeID"]] = $employee;*/
            echo "<tr>";
            /*echo "<td><a href='javascript:void(0)' onclick='openModal(" . $employee["EmployeeID"] . ")' id='employee_" . $employee["EmployeeID"] . "'>" . $employee["EmployeeID"] . "</a></td>";*/
            echo "<td>" . $row["CityName"] . "</td>";
            echo "<td>" . $row["empcount"] . "</td>";
            echo "<td>" . $row["ConcatenatedNames"] . "</td>";
            echo "<td><button onclick='/*confirmRemove*/(" . $row["CityName"] . ")' class=\"\">Покажи</button></td>";
            echo "</tr>";
        }
        echo "</table>";
        break;
    case "titlesum":
        $summary = $db->select("
        SELECT
        ");
        break;
    case "titleocsum":
        $summary = $db->select("
        
        ");
        break;
}

