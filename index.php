<?php
require "includes/nav.php";
require "connect_db.php";

// Retrieve all books
$query = "SELECT * FROM books";
$result = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>READIFY – Online Book Store</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container mt-4">

    <h1 class="mb-3">Welcome to READIFY</h1>
    <p class="mb-4">Browse our collection of books below.</p>

    <div class="row">
    <?php
    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="' . $row['cover_image'] . '" class="card-img-top" alt="' . $row['title'] . '">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">' . $row['title'] . '</h5>
                        <p class="card-text"><strong>Author:</strong> ' . $row['author'] . '</p>
                        <p class="card-text"><strong>Price:</strong> £' . $row['price'] . '</p>
                        <a href="added.php?id=' . $row['book_id'] . '" class="btn btn-primary mt-auto">Add to Cart</a>
                    </div>
                </div>
            </div>
            ';
        }

    } else {
        echo "<p>No books available.</p>";
    }
    ?>
    </div>

</div>

</body>
</html>
