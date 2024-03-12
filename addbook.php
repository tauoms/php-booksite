<?php
    // If the user is not logged in, redirect them back to login.php.
    session_start();

    if(!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit;
    }

    // Read the file into array variable $books:
    $json = file_get_contents("books.json");
    $books = json_decode($json, true);
    $message = '';

    // if the form has been sent, add the book to the data file
    if (!empty($_POST['bookid']) AND !empty($_POST['title']) AND !empty($_POST['author']) AND !empty($_POST['year']) AND !empty($_POST['genre']) AND !empty($_POST['description'])) {
        // In order to protect against cross-site scripting attacks (i.e. basic PHP security), remove HTML tags from all input.
    // There's a function for that. E.g.
    // $title = strip_tags($_POST["title"]);
        $id = strip_tags($_POST['bookid']);
        $title = strip_tags($_POST['title']);
        $author = strip_tags($_POST['author']);
        $year = strip_tags($_POST['year']);
        $genre = strip_tags($_POST['genre']);
        $description = strip_tags($_POST['description']);

        $newBook = (object) [
            "id" => $id, 
            "title" => $title, 
            "author" => $author, 
            "publishing_year" => $year, 
            "genre" => $genre,
            "description" => $description];

        $books[] = $newBook;

        $message = "Book added!";

        // Once you have added the new book to the variable $books write it into the file.
    file_put_contents("books.json", json_encode($books));

    } elseif (isset($_POST['add-book']) AND (empty($_POST['bookid']) OR empty($_POST['title']) OR empty($_POST['author']) OR empty($_POST['year']) OR empty($_POST['genre']) OR empty($_POST['description']))) {
        $message = "Please fill in all fields.";
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
                <li><a href="admin.php">Admin Home</a></li>
                <li><a href="addbook.php">Add a New Book</a></li>
                <li><a href="login.php?logout">Log Out</a></li>
            </ul>
        </nav>
        <main>
            <h2>Add a New Book</h2>
            <form action="addbook.php" method="post">
                <p>
                    <label for="bookid">ID:</label>
                    <input type="number" id="bookid" name="bookid">
                </p>
                <p>
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title">
                </p>
                <p>
                    <label for="author">Author:</label>
                    <input type="text" id="author" name="author">
                </p>
                <p>
                    <label for="year">Year:</label>
                    <input type="number" id="year" name="year">
                </p>
                <p>
                    <label for="genre">Genre:</label>
                    <select id="genre" name="genre">
                        <option value="Adventure">Adventure</option>
                        <option value="Classic Literature">Classic Literature</option>
                        <option value="Coming-of-age">Coming-of-age</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Historical Fiction">Historical Fiction</option>
                        <option value="Horror">Horror</option>
                        <option value="Mystery">Mystery</option>
                        <option value="Romance">Romance</option>
                        <option value="Science Fiction">Science Fiction</option>
                    </select>
                </p>
                <br>
                <p>
                    <label for="description">Description:</label><br>
                    <textarea rows="5" cols="100" id="description" name="description"></textarea>
                </p>
                <p><input type="submit" name="add-book" value="Add Book"></p>
            </form>
            <p class="message"><?php print $message ?></p>
        </main>
    </div>    
</body>
</html>