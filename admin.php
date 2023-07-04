<?php
session_start();
// Check if the user is logged in as an admin
if (!isset($_SESSION["username"]) || empty($_SESSION["isAdmin"])) {
    // Redirect to the login page or display an error message
    header("Location: login.html");
    exit();
}
?>

<html>
    <head>
        <title>Admin page</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

        <div id="navbar">
            <a href="login.html">Login</a>
            <a href="user.php">User DB Finder</a>
            <a href="admin.php" class="active">Admin DB Ramble</a>
        </div>
        <script>
            var prevScrollpos = window.pageYOffset;
            window.onscroll = function() {
                var currentScrollPos = window.pageYOffset;
                if (prevScrollpos > currentScrollPos) {
                    document.getElementById("navbar").style.top = "0";
                }
                else {
                    document.getElementById("navbar").style.top = "-50px";
                }
                prevScrollpos = currentScrollPos;
            }
        </script>

        <div class="margin, center">
            <form action="logout.php" method="post">
                <input type="submit" value="Logout">
            </form>
        </div>

        <div class="footer" id="footer">
        <p> Made by:
            <a href="https://www.instagram.com/ivaylo.kolev1/" class="insta">Ivaylo Kolev</a>
        </p>
        </div>
        <script>
            window.addEventListener('scroll', function() {
                var footer = document.getElementById('footer');
                var scrollPosition = window.innerHeight + window.pageYOffset;
                var documentHeight = document.body.offsetHeight;

                if (scrollPosition >= documentHeight) {
                    footer.style.bottom = '0';
                } else {
                    footer.style.bottom = '-50px';
                }
            })
        </script>

    </body>
</html>
