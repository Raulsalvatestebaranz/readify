<?php
require "includes/nav.php";

// Handle cart updates
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["qty"])) {
    foreach ($_POST["qty"] as $id => $qty) {
        $id = (int) $id;
        $qty = (int) $qty;

        if ($qty <= 0) {
            unset($_SESSION["cart"][$id]);
        } else {
            $_SESSION["cart"][$id]["quantity"] = $qty;
        }
    }
}

// If cart is empty after update
if (!isset($_SESSION["cart"]) || empty($_SESSION["cart"])) {
    echo "<p>Your cart is currently empty.</p>";
    exit();
}

$total = 0;
?>

<h2>Your Shopping Cart</h2>

<form action="cart.php" method="post">

<?php
foreach ($_SESSION["cart"] as $id => $item) {

    $subtotal = $item["quantity"] * $item["price"];
    $total += $subtotal;

    echo '
    <div style="margin-bottom: 20px;">
        <strong>' . $item["title"] . '</strong><br>
        Price: £' . $item["price"] . '<br>
        Quantity:
        <input type="number" name="qty[' . $id . ']" value="' . $item["quantity"] . '" min="0">
        <br>
        Subtotal: £' . number_format($subtotal, 2) . '
    </div>
    <hr>
    ';
}
?>

<p><strong>Total: £<?php echo number_format($total, 2); ?></strong></p>

<input type="submit" value="Update Cart">

</form>
