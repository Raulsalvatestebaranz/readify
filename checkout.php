<?php
// --------------------------------------------------
// Checkout Page – READIFY
// Finalises the order and stores it in the database
// --------------------------------------------------

// Page title
$page_title = "Checkout – READIFY";

// Include required files
require "includes/header.php";
require "includes/auth_guard.php";        // Only logged-in users
require "includes/session-cart.php";      // Ensure session + cart exist
require "includes/nav.php";
require "connect_db.php";

// --------------------------------------------------
// Handle order submission
// --------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Retrieve cart from session
    $cart = $_SESSION["cart"];

    // Proceed only if cart is not empty
    if (!empty($cart)) {

        // Logged-in user ID
        $user_id = $_SESSION["user_id"];
        $total = 0;

        // Calculate total order price
        foreach ($cart as $item) {
            $total += $item["price"] * $item["quantity"];
        }

        // --------------------------------------------------
        // Create order record
        // --------------------------------------------------
        $query = "
            INSERT INTO orders (user_id, total, order_date)
            VALUES ($user_id, $total, NOW())
        ";
        mysqli_query($link, $query);

        // Get the newly created order ID
        $order_id = mysqli_insert_id($link);

        // --------------------------------------------------
        // Insert order items
        // --------------------------------------------------
        foreach ($cart as $book_id => $item) {
            $price = $item["price"];
            $qty   = $item["quantity"];

            $item_query = "
                INSERT INTO order_items (order_id, book_id, price, quantity)
                VALUES ($order_id, $book_id, $price, $qty)
            ";
            mysqli_query($link, $item_query);
        }

        // --------------------------------------------------
        // Clear cart after successful order
        // --------------------------------------------------
        unset($_SESSION["cart"]);

        // Store success message for order history page
        $_SESSION["order_success"] = "Your order has been placed successfully!";

        // Redirect to order history
        header("Location: order_history.php");
        exit;
    }
}

// Retrieve cart for display
$cart = $_SESSION["cart"];
$total = 0;
?>

<div class="container mt-4">

<?php if (empty($cart)): ?>

    <div class="alert alert-warning">
        Your cart is empty. You can’t proceed to checkout.
    </div>

    <a href="index.php" class="btn btn-primary">
        Continue shopping
    </a>

<?php else: ?>

    <h2 class="mb-4">Checkout</h2>

    <div class="row">

        <!-- Order summary -->
        <div class="col-md-6 mb-4">
            <h4>Order Summary</h4>

            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Book</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach ($cart as $item):
                    $subtotal = $item["price"] * $item["quantity"];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($item["title"]) ?></td>
                        <td><?= $item["quantity"] ?></td>
                        <td>£<?= number_format($subtotal, 2) ?></td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>

            <h5>Total: £<?= number_format($total, 2) ?></h5>
        </div>

        <!-- User details form (mock checkout form) -->
        <div class="col-md-6">
            <h4>Your Details</h4>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea class="form-control" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    Place Order
                </button>
            </form>
        </div>

    </div>

<?php endif; ?>

</div>

<?php require "includes/footer.php"; ?>
