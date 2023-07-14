<?php

require_once "include/config.php";

$db = new Database();

$employees = [];
if (!empty($_POST['cities'])){
    $employees = $db->select("
    SELECT e.*,CONCAT(c.name, \", \", e.Address) AS AddressWithCity  
    FROM employees e
    LEFT JOIN cities c ON c.id = e.IdCity
    WHERE idCity = " . intval($_POST['cities']));
}
else {
    $employees = $db->select("
    SELECT e.*,CONCAT(c.name, \", \", e.Address) AS AddressWithCity  
    FROM employees e
    LEFT JOIN cities c ON c.id = e.IdCity");
}

$aEmployeesForJS = [];

if(!empty($employees)){
    echo "<table>";
    echo "<tr><th>ID</th><th>Име</th><th>Фамилия</th><th>Работа</th><th>Нарицание</th><th style='padding: 10px;'>Рожд. дата</th><th style='padding: 14px;'>Дата на наемане</th><th>Адрес</th></tr>";
    foreach ($employees as $employee){
        $aEmployeesForJS[$employee["EmployeeID"]] = $employee;
        echo "<tr>";
        echo "<td><a href='javascript:void(0)' onclick='openModal(" . $employee["EmployeeID"] . ")' id='employee_" . $employee["EmployeeID"] . "'>" . $employee["EmployeeID"] . "</a></td>";
        echo "<td>" . $employee["FirstName"] . "</td>";
        echo "<td>" . $employee["LastName"] . "</td>";
        echo "<td>" . $employee["Title"] . "</td>";
        echo "<td>" . $employee["TitleOfCourtesy"];
        echo "<td>" . explode(" ", $employee["BirthDate"])[0] . "</td>";
        echo "<td>" . explode(" ", $employee["HireDate"])[0] . "</td>";
        echo "<td>" . $employee["AddressWithCity"] . "</td>";
        if(!empty($_SESSION["isAdmin"])){
        echo "<td><button onclick='confirmRemove(" . $employee["EmployeeID"] . ")' class=\"removeBttn\">Изтрии</button></td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
else {
    echo "No employees found.";
}

// Close the connection
CONN->close();
?>

<script>
    var employees = <?= json_encode($aEmployeesForJS); ?>
</script>
