<?php
    require_once "../classes/books.php";
    $booksObj = new Books();
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $genre = isset($_GET['genre']) ? $_GET['genre'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books</title>
</head>

<body>
    <h1>List of Books</h1>
    
    <a href="addBooks.php"><button>Add New Book</button></a>
    <hr>

    <form action="viewBook.php" method="GET">
        <input type="text" name="search" placeholder="Search by title..." value="<?= htmlspecialchars($search) ?>">
        <select name="genre" id="genre">
                <option value="">--SELECT GENRE--</option>
                <option value="History" <?= ($genre == "History")? "selected": ""?> >History</option>
                <option value="Science" <?= ($genre == "Science")? "selected": ""?> >Science</option>
                <option value="Fiction" <?= ($genre == "Fiction")? "selected": ""?> >Fiction</option>
        </select>
        <input type="submit" value="Filter">
    </form>
    <br>

    <table border="1" width="100%">
        <tr>
            <td>No.</td>
            <td>Title</td>
            <td>Book Author</td>
            <td>Genre</td>
            <td>Publication Year</td>
        </tr>
        <?php 
            $no = 1;
            foreach ($booksObj->viewBook($search, $genre) as $books)
            {
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($books["title"]) ?></td>
            <td><?= htmlspecialchars($books["author"]) ?></td>
            <td><?= htmlspecialchars($books["genre"]) ?></td>
            <td><?= htmlspecialchars($books["publication_year"]) ?></td>
        </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>
