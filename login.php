<html>
<head>
    <title>Database selector</title>
</head>
<body>
<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form inputs
    $user = $_POST["user"];
    $pass = $_POST["pass"];

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND passw = ?");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found in the database
        $row = $result->fetch_assoc();
        session_start();
        //Store the user information in session variables
        $_SESSION["username"] = $row["username"];
        $_SESSION["isAdmin"] = $row["isAdmin"];

        if ($row["isAdmin"] == 1) {
            // Redirect to admin page
            header("Location: admin.php");
            exit();
        } else {

            // Redirect to regular user page
            header("Location: user.php");
            exit();
        }
    } else {
        // Invalid credentials, redirect to login page
        header("Location: login.html");
        exit();
    }


}?>
</body>
</html>
