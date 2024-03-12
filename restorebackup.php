<?php
    // If the user is not logged in, redirect them back to login.php.

    session_start();   

    if(!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit;
    }

    // Restore original booklist from backup file
    if (isset($_POST['restorebackup'])) {
        $json = file_get_contents("booksbackup.json");
        $books = json_decode($json, true);
        $_SESSION["restoremessage"] = "Backup restored!";

        file_put_contents("books.json", json_encode($books));
    }

    // Redirect back to admin.php.
    header("Location:" . $_SERVER["HTTP_REFERER"]);

