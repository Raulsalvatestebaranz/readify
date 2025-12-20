<?php
require "includes/nav.php";
require "connect_db.php";

// Cart must exist
if (!isset($_SESSION["cart"]) || empty($_SESSION["cart"])) {
    echo "<p>Your cart is empty. <a href=\"index.php\">Go shopping</a></p>";
    exit();
}

// Handle order confirmation
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Calculate total
    $total = 0;
    foreach ($_SESSION["cart"] as $item) {
        $total += $item["quantity"] * $item["price"];
    }

    // Insert into orders
    $user_id = (int) $_SESSION["user_id"];
    $q = "INSERT INTO orders (user_id, total, order_date)
          VALUES ($user_id, $total, NOW())";
    mysqli_query($link, $q);

    // Get the new order ID
    $order_id = mysqli_insert_id($link);

    // Insert order items
    foreach ($_SESSION["cart"] as $book_id => $item) {
        $book_id = (int) $book_id;
        $qty = (int) $item["quantity"];
        $price = (float) $item["price"];

        $qi = "INSERT INTO order_items (order_id, book_id, quantity, price)
               VALUES ($order_id, $book_id, $qty, $price)";
        mysqli_query($link, $qi);
    }

    // Clear cart
    $_SESSION["cart"] = [];

    echo "<h2>Order Confirmed</h2>";
    echo "<p>Thank you for your order. Your order number is <strong>#$order_id</strong>.</p>";
    echo "<p><a href=\"index.php\">Continue shopping</a></p>";
    exit();
}

// If GET request, show checkout summary
$total = 0;
?>

<h2>Checkout</h2>
<p>Please review your order below:</p>
<hr>

<?php
foreach ($_SESSION["cart"] as $item) {
    $subtotal = $item["quantity"] * $item["price"];
    $total += $subtotal;

    echo '
    <div style="margin-bottom: 15px;">
        <strong>' . $item["title"] . '</strong><br>
        Quantity: ' . $item["quantity"] . '<br>
        Price: £' . $item["price"] . '<br>
        Subtotal: £' . number_format($subtotal, 2) . '
    </div>
    <hr>
    ';
}
?>

<p><strong>Total Amount: £<?php echo number_format($total, 2); ?></strong></p>

<form action="checkout.php" method="post">
    <input type="submit" value="Confirm Order">
</form>
