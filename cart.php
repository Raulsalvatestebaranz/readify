<?php
$page_title = "Your Cart – READIFY";
require "includes/header.php";
require "includes/auth_guard.php";
require "includes/nav.php";

$cart = $_SESSION["cart"] ?? [];
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
