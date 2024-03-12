<?php
    // If the user is not logged in, redirect them back to login.php.

    session_start();

    // Read the file into array variable $books:
    $json = file_get_contents("books.json");
    $books = json_decode($json, true);

    if(!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit;
    }

    // Check the POST parameter "bookid". If it's set, delete the corresponding book from the data file.
    if (isset($_POST['bookid'])) {
        $id = $_POST['bookid'];
        $index = array_search($id, array_column($books, 'id'));
        // error_log("indeksi: $index");
        array_splice($books, $index, 1);
    }

    //loop foreach (books as index => book)

    // Hint: array_diff will not work here, since you'd need to create the whole book "object". Find the index and use array_splice instead.

    // Redirect back to admin.php.
    header("Location:" . $_SERVER["HTTP_REFERER"]);

    // Once you have removed the book from the variable $books write it into the file.
    file_put_contents("books.json", json_encode($books));