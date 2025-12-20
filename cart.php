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

// If cart is empty
if (!isset($_SESSION["cart"]) || empty($_SESSION["cart"])) {
    echo '<div class="container mt-4"><p>Your cart is currently empty.</p></div>';
    exit();
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart – READIFY</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container mt-4">

    <h2 class="mb-4">Your Shopping Cart</h2>

    <form action="cart.php" method="post">

        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Book</th>
                    <th>Price</th>
                    <th style="width: 120px;">Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>

            <?php
            foreach ($_SESSION["cart"] as $id => $item) {
                $subtotal = $item["quantity"] * $item["price"];
                $total += $subtotal;

                echo '
                <tr>
                    <td>' . $item["title"] . '</td>
                    <td>£' . number_format($item["price"], 2) . '</td>
                    <td>
                        <input type="number" class="form-control" name="qty[' . $id . ']" value="' . $item["quantity"] . '" min="0">
                    </td>
                    <td>£' . number_format($subtotal, 2) . '</td>
                </tr>
                ';
            }
            ?>

            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center">
            <h4>Total: £<?php echo number_format($total, 2); ?></h4>
            <input type="submit" class="btn btn-primary" value="Update Cart">
        </div>

    </form>

    <div class="mt-4">
        <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
    </div>

</div>

</body>
</html>
