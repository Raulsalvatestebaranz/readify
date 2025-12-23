<?php
$cart_count = 0;
if (!empty($_SESSION["cart"])) {
    foreach ($_SESSION["cart"] as $item) {
        $cart_count += $item["quantity"];
    }
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">READIFY</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#readifyNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="readifyNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>

                <?php if (isset($_SESSION["user_id"])): ?>

                    <li class="nav-item">
                        <a class="nav-link" href="order_history.php">My Orders</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">
                            Cart
                            <?php if ($cart_count > 0): ?>
                                <span class="badge bg-success ms-1"><?= $cart_count ?></span>
                            <?php endif; ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="checkout.php">Checkout</a>
                    </li>

                    <li class="nav-item">
                        <span class="nav-link">
                            Welcome, <?= htmlspecialchars($_SESSION["first_name"]) ?>
                        </span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>

                <?php else: ?>

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
