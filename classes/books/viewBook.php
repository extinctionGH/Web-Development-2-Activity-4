<?php
    require_once "../classes/books.php";
    $booksObj = new Books();
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

    <table border="1" width="100%">
        <tr>
            <td>No.</td>
            <td>Title</td>
            <td>Author</td>
            <td>Genre</td>
            <td>Publication Year</td>
        </tr>

        <?php
        $no = 1;
        foreach ($booksObj->viewBook() as $books) {
        ?>
        <tr>
            <!-- Corrected PHP short tags -->
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($books["title"]) ?></td>
            <td><?= htmlspecialchars($books["author"]) ?></td>
            <td><?= htmlspecialchars($books["genre"]) ?></td>
            <!-- Corrected array key -->
            <td><?= htmlspecialchars($books["publication_year"]) ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>