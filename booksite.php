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
                <li><a href="booksite.php?genre=adventure">Adventure</a></li>
                <li><a href="booksite.php?genre=classic">Classic Literature</a></li>
                <li><a href="booksite.php?genre=coming-of-age">Coming-of-age</a></li>
                <li><a href="booksite.php?genre=fantasy">Fantasy</a></li>
                <li><a href="booksite.php?genre=historical">Historical Fiction</a></li>
                <li><a href="booksite.php?genre=horror">Horror</a></li>
                <li><a href="booksite.php?genre=mystery">Mystery</a></li>
                <li><a href="booksite.php?genre=romance">Romance</a></li>
                <li><a href="booksite.php?genre=scifi">Science Fiction</a></li>
            </ul>
        </nav>
        <main>
            <?php
             // Read the file into array variable $books:
             $json = file_get_contents("books.json");
             $books = json_decode($json, true);

             if (isset($_COOKIE['favorites'])) {
                $favorites = explode(",", $_COOKIE["favorites"]);
                } else {
                    $favorites = [];
                }

             $genreLookup = array (
                'adventure' => 'Adventure',
                'classic' => 'Classic Literature',
                'coming-of-age' => 'Coming-of-age',
                'fantasy' => 'Fantasy',
                'historical' => 'Historical Fiction',
                'horror' => 'Horror',
                'mystery' => 'Mystery',
                'romance' => 'Romance',
                'scifi' => 'Science Fiction'
             );

                // Here you should display the books of the given genre (GET parameter "genre"). Check the links above for parameter values.
                // If the parameter is not set, display all books.
                 // Use the HTML template below and a loop (+ conditional if the genre was given) to go through the books in file 
                if (isset($_GET["genre"])) { ?>
                    <h2><?php print $genreLookup[$_GET["genre"]] ?></h2>
                    <?php
                    foreach ($books as $book) {
                        if ($book["genre"] === $genreLookup[$_GET['genre']]) {
                        $id = $book["id"];
                        $title = $book["title"];
                        $author = $book["author"];
                        $publishing_year = $book["publishing_year"];
                        $description = $book["description"]; ?>
                        <section class="book">
                        <a class= 
                        <?php
                // You also need to check the cookies to figure out if the book is favorite or not and display correct symbol.
                
                // If the book is in the favorite list, add the class "fa-star" to the a tag with "bookmark" class.
                // If not, add the class "fa-star-o". These are Font Awesome classes that add a filled star and a star outline respectively.
                if (in_array($id, $favorites)) {
                    ?>"bookmark fa fa-star"
                    <?php
                } else {
                    ?>"bookmark fa fa-star-o"
                    <?php
                }
                ?> href=<?php print "setfavorite.php?id=$id"; ?>></a>
                        <h3><?php print $title; ?></h3>
                        <p class="publishing-info">
                        <span class="author"><?php print $author; ?></span>,
                        <span class="year"><?php print $publishing_year; ?></span>
                        </p>
                        <p class="description">
                        <?php print $description; ?>
                        </p>
                        </section>
                                
                <?php }}
 
                } else { ?>
                    <h2>All Books</h2> <?php
                    foreach ($books as $book) {
                        $id = $book['id'];
                        $title = $book["title"];
                        $author = $book["author"];
                        $publishing_year = $book["publishing_year"];
                        $description = $book["description"]; ?>
                        <section class="book">
                <a class= 
                <?php
                // You also need to check the cookies to figure out if the book is favorite or not and display correct symbol.
                
                // If the book is in the favorite list, add the class "fa-star" to the a tag with "bookmark" class.
                // If not, add the class "fa-star-o". These are Font Awesome classes that add a filled star and a star outline respectively.
                if (in_array($id, $favorites)) {
                    ?>"bookmark fa fa-star"
                    <?php
                } else {
                    ?>"bookmark fa fa-star-o"
                    <?php
                }
                // Also, make sure to set the id parameter for each book, so the setfavorite.php page gets the information which book to favorite/unfavorite.
                ?> href=<?php print "setfavorite.php?id=$id"; ?>></a>
                <h3><?php print $title; ?></h3>
                <p class="publishing-info">
                    <span class="author"><?php print $author; ?></span>,
                    <span class="year"><?php print $publishing_year; ?></span>
                </p>
                <p class="description">
                    <?php print $description; ?>
                </p>
            </section>

                <?php }} 
                ?>
            
        </main>
    </div>    
</body>
</html>