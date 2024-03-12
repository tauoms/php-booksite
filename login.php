<?php
    session_start();
    $errorMsg = "";

    // Check if the GET parameter "logout" is set. If so, log the user out.
    if (isset($_GET['logout'])) {
        session_unset();
        session_destroy();
    }

    // Check if the user is already logged in. If so, redirect to admin.php.
    if(isset($_SESSION["login"]) && $_SESSION["login"] == "OK") {
        header("Location: admin.php");
        exit;
    }

    // Check if the form has been sent. If so, check the username and password and if correct, log the user in and redirect to admin.php.

    if (isset($_POST['username']) AND isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if ($username === "nimda" AND $password === "salasana") {
            $_SESSION['login'] = "OK";
            header("Location: admin.php");
            exit();
        
            // If not correct, show the error message near the form.
            } else {
                $errorMsg = "Wrong username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Favorite Books</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="booksite.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>
<body>
    <div id="container">
        <header>
        <h1>PHP Booksite</h1>
        </header>
        <nav id="main-navi">
            <ul>
                <li><a href="booksite.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                </ul><ul>

                <li><a href="booksite.php?category=adventure">Adventure</a></li>
                <li><a href="booksite.php?category=classic">Classic Literature</a></li>
                <li><a href="booksite.php?category=coming-of-age">Coming-of-age</a></li>
                <li><a href="booksite.php?category=fantasy">Fantasy</a></li>
                <li><a href="booksite.php?category=historical">Historical Fiction</a></li>
                <li><a href="booksite.php?category=horror">Horror</a></li>
                <li><a href="booksite.php?category=mystery">Mystery</a></li>
                <li><a href="booksite.php?category=romance">Romance</a></li>
                <li><a href="booksite.php?category=scifi">Science Fiction</a></li>
            </ul>
        </nav>
        <main>
            <p><?php print $errorMsg ?></p>
            <form action="login.php" method="post">
                <p>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username">
                </p>
                <p>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                </p>
                <p><input type="submit" name="login" value="Log in"></p>
            </form>
            <p class="credentials">Credentials for demo use<br>
                username: nimda<br>
                password: salasana</p>
        </main>
    </div>    
</body>
</html>