<?php
// --------------------------------------------------
// Navigation Bar – READIFY
// Displays navigation links based on user login status
// --------------------------------------------------

// Ensure session and cart are initialised
require "includes/session-cart.php";

// Calculate total number of items in the cart
$cart_count = 0;
foreach ($_SESSION["cart"] as $item) {
    $cart_count += $item["quantity"];
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <!-- Brand / Logo -->
        <a class="navbar-brand" href="index.php">READIFY</a>

        <!-- Mobile toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#readifyNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible navigation links -->
        <div class="collapse navbar-collapse" id="readifyNav">
            <ul class="navbar-nav ms-auto">

                <!-- Home link (always visible) -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>

                <?php if (isset($_SESSION["user_id"])): ?>

                    <!-- Links visible only when user is logged in -->

                    <li class="nav-item">
                        <a class="nav-link" href="order_history.php">My Orders</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">
                            Cart
                            <!-- Show cart item count if cart is not empty -->
                            <?php if ($cart_count > 0): ?>
                                <span class="badge bg-success ms-1"><?= $cart_count ?></span>
                            <?php endif; ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="checkout.php">Checkout</a>
                    </li>

                    <!-- Display logged-in user's name -->
                    <li class="nav-item">
                        <span class="nav-link">
                            Welcome, <?= htmlspecialchars($_SESSION["first_name"]) ?>
                        </span>
                    </li>

                    <!-- Logout link -->
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>

                <?php else: ?>

                    <!-- Links visible only when user is logged out -->

                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>

                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>
