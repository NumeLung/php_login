<?php
include "config.php";
include "Database.php";
$db = new Database();

// Assuming you have established a database connection, you can retrieve the necessary values from the $_POST variable
$inputEmployeeID = $_POST['inputEmployeeID'];
$inputFirstName = $_POST['inputFirstName'];
$inputLastName = $_POST['inputLastName'];
$inputTitle = $_POST['inputTitle'];
$inputTitleOfCourtesy = $_POST['inputTitleOfCourtesy'];
$inputBirthDate = $_POST['inputBirthDate'];
$inputHireDate = $_POST['inputHireDate'];
$inputAddress = $_POST['inputAddress'];
$inputIdCity = $_POST['inputIdCity'];

if(!empty($inputEmployeeID)){
    $updateQuery = "UPDATE employees SET 
        LastName = '$inputLastName', 
        FirstName = '$inputFirstName', 
        Title = '$inputTitle', 
        TitleOfCourtesy = '$inputTitleOfCourtesy', 
        BirthDate = '$inputBirthDate', 
        HireDate = '$inputHireDate', 
        Address = '$inputAddress', 
        IdCity = '$inputIdCity' 
        WHERE EmployeeID = '$inputEmployeeID'";
    mysqli_query($db->connection, $updateQuery);
}
else {
    $insertQuery = "INSERT INTO employees (LastName, FirstName, Title, TitleOfCourtesy, BirthDate, HireDate, Address, IdCity) 
        VALUES ('$inputLastName', '$inputFirstName', '$inputTitle', '$inputTitleOfCourtesy', '$inputBirthDate', '$inputHireDate', '$inputAddress', $inputIdCity)";
    mysqli_query($db->connection, $insertQuery);
}
header("Location: /home.php");
exit();
?>