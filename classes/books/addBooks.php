<?php
    require_once "../classes/books.php";
    $booksObj = new Books();

    $errors = ["title"=>"","author"=>"","publication_year"=>""];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (empty($_POST["title"])) {
            $errors["title"] = "Title is required";
        }
        if (empty($_POST["author"])) {
            $errors["author"] = "Author is required";
        }
        if (empty($_POST["publication_year"])) {
            $errors["publication_year"] = "Publication year is required";
        } 
        elseif ($_POST["publication_year"] > 2025) {
            $errors["publication_year"] = "Publication year cannot be greater than 2025";
        }

        if (!array_filter($errors)) {
            $booksObj->title = $_POST["title"];
            $booksObj->author = $_POST["author"];
            $booksObj->genre = $_POST["genre"];
            $booksObj->publication_year = $_POST["publication_year"];
            
            if ($booksObj->addBook()) {
                header("Location: viewBook.php?status=add_success");
                exit();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
</head>
<body>

    <a href="viewBook.php"><button>Return to Book List</button></a>
    
    <hr>

    <h1>Add a New Book</h1>
    <form action="addBooks.php" method="POST">
        <div>
            <label>Title:</label><br>
            <input type="text" name="title">
            <span style="color:red"><?= $errors['title'] ?></span>
        </div>
        <br>
        <div>
            <label>Author:</label><br>
            <input type="text" name="author">
            <span style="color:red"><?= $errors['author'] ?></span>
        </div>
        <br>
        <div>
            <label>Genre:</label><br>
            <input type="text" name="genre">
        </div>
        <br>
        <div>
            <label>Publication Year:</label><br>
            <input type="number" name="publication_year" max="2025">
            <span style="color:red"><?= $errors['publication_year'] ?></span>
        </div>
        <br>
        <button type="submit">Add Book</button>
    </form>
</body>
</html>
