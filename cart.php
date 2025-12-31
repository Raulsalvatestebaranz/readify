<?php
// --------------------------------------------------
// Cart Page – READIFY
// Displays cart contents and allows quantity updates
// --------------------------------------------------

// Page title
$page_title = "Your Cart – READIFY";

// Include required files
require "includes/header.php";
require "includes/auth_guard.php";
require "includes/session-cart.php"; // ensures session + cart exist
require "includes/nav.php";

// --------------------------------------------------
// Handle cart updates when form is submitted
// --------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["qty"])) {

    foreach ($_POST["qty"] as $id => $quantity) {

        // Convert values to integers for safety
        $id = (int) $id;
        $quantity = (int) $quantity;

        // Remove item if quantity is zero or less
        if ($quantity <= 0) {
            unset($_SESSION["cart"][$id]);
        }
        // Otherwise update quantity
        elseif (isset($_SESSION["cart"][$id])) {
            $_SESSION["cart"][$id]["quantity"] = $quantity;
        }
    }
}

// Retrieve cart from session
$cart = $_SESSION["cart"];
$total = 0;
?>

<div class="container mt-4">

<?php if (empty($cart)): ?>

    <div class="alert alert-info">
        Your cart is currently empty.
    </div>

    <a href="index.php" class="btn btn-primary">
        Continue shopping
    </a>

<?php else: ?>

    <h2 class="mb-4">Your Shopping Cart</h2>

    <!-- Cart update form -->
    <form method="post">

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

            <?php foreach ($cart as $id => $item): 
                $subtotal = $item["price"] * $item["quantity"];
                $total += $subtotal;
            ?>
                <tr>
                    <td><?= htmlspecialchars($item["title"]) ?></td>
                    <td>£<?= number_format($item["price"], 2) ?></td>
                    <td>
                        <input
                            type="number"
                            name="qty[<?= $id ?>]"
                            value="<?= $item["quantity"] ?>"
                            min="0"
                            class="form-control">
                    </td>
                    <td>£<?= number_format($subtotal, 2) ?></td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center">
            <h4>Total: £<?= number_format($total, 2); ?></h4>
            <button type="submit" class="btn btn-primary">
                Update Cart
            </button>
        </div>

    </form>

    <div class="mt-4">
        <a href="checkout.php" class="btn btn-success">
            Proceed to Checkout
        </a>
    </div>

<?php endif; ?>

</div>

<?php require "includes/footer.php"; ?>
