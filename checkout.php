<?php
require "includes/nav.php";
require "connect_db.php";

// Cart must exist
if (!isset($_SESSION["cart"]) || empty($_SESSION["cart"])) {
    echo '<div class="container mt-4"><p>Your cart is empty. <a href="index.php">Go shopping</a></p></div>';
    exit();
}

// Handle order confirmation
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $total = 0;
    foreach ($_SESSION["cart"] as $item) {
        $total += $item["quantity"] * $item["price"];
    }

    $user_id = (int) $_SESSION["user_id"];

    $q = "INSERT INTO orders (user_id, total, order_date)
          VALUES ($user_id, $total, NOW())";
    mysqli_query($link, $q);

    $order_id = mysqli_insert_id($link);

    foreach ($_SESSION["cart"] as $book_id => $item) {
        $book_id = (int) $book_id;
        $qty = (int) $item["quantity"];
        $price = (float) $item["price"];

        $qi = "INSERT INTO order_items (order_id, book_id, quantity, price)
               VALUES ($order_id, $book_id, $qty, $price)";
        mysqli_query($link, $qi);
    }

    $_SESSION["cart"] = [];

    echo '
    <div class="container mt-5">
        <div class="alert alert-success">
            <h4 class="alert-heading">Order Confirmed</h4>
            <p>Thank you for your order. Your order number is <strong>#' . $order_id . '</strong>.</p>
            <hr>
            <a href="index.php" class="btn btn-primary">Continue shopping</a>
        </div>
    </div>
    ';
    exit();
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout – READIFY</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container mt-4">

    <h2 class="mb-4">Checkout</h2>

    <div class="card">
        <div class="card-body">

            <table class="table">
                <thead>
                    <tr>
                        <th>Book</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                foreach ($_SESSION["cart"] as $item) {
                    $subtotal = $item["quantity"] * $item["price"];
                    $total += $subtotal;

                    echo '
                    <tr>
                        <td>' . $item["title"] . '</td>
                        <td>' . $item["quantity"] . '</td>
                        <td>£' . number_format($item["price"], 2) . '</td>
                        <td>£' . number_format($subtotal, 2) . '</td>
                    </tr>
                    ';
                }
                ?>

                </tbody>
            </table>

            <h4 class="text-end">Total: £<?php echo number_format($total, 2); ?></h4>

            <form action="checkout.php" method="post" class="text-end mt-3">
                <input type="submit" class="btn btn-success btn-lg" value="Confirm Order">
            </form>

        </div>
    </div>

</div>

</body>
</html>
