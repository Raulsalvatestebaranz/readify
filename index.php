<?php
// Connect to database
require 'connect_db.php';

// Retrieve all books
$query = "SELECT * FROM books";
$result = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>READIFY – Online Book Store</title>
</head>
<body>

<h1>Welcome to READIFY</h1>
<p>Browse our collection of books below.</p>

<hr>

<?php
// Check if there are books
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo '
        <div style="margin-bottom: 30px;">
            <img src="' . $row['cover_image'] . '" alt="' . $row['title'] . '" width="120"><br>
            <strong>Title:</strong> ' . $row['title'] . '<br>
            <strong>Author:</strong> ' . $row['author'] . '<br>
            <strong>Price:</strong> £' . $row['price'] . '
        </div>
        <hr>
        ';
    }

} else {
    echo '<p>No books available.</p>';
}
?>

</body>
</html>
