<?php
    // If the user is not logged in, redirect them back to login.php.

    session_start();

    // Read the file into array variable $books:
   

    if(!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit;
    }

    // Check the POST parameter "bookid". If it's set, delete the corresponding book from the data file.
    if (isset($_POST['restorebackup'])) {
        $json = file_get_contents("booksbackup.json");
        $books = json_decode($json, true);
    }

    // Redirect back to admin.php.
    header("Location:" . $_SERVER["HTTP_REFERER"]);

    file_put_contents("books.json", json_encode($books));