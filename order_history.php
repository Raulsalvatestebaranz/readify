<?php
// --------------------------------------------------
// Order History Page – READIFY
// Displays all past orders for the logged-in user
// --------------------------------------------------

// Page title
$page_title = "My Orders – READIFY";

// Include required files
require "includes/header.php";
require "includes/auth_guard.php"; // Only logged-in users
require "includes/nav.php";
require "connect_db.php";

// Get the logged-in user's ID
$user_id = $_SESSION["user_id"];

// --------------------------------------------------
// Retrieve all orders for this user
// --------------------------------------------------
$order_query = "
    SELECT order_id, total, order_date
    FROM orders
    WHERE user_id = $user_id
    ORDER BY order_date DESC
";
$order_result = mysqli_query($link, $order_query);
?>

<div class="container mt-4">

    <h2 class="mb-4">My Orders</h2>

    <?php
    // --------------------------------------------------
    // Display success message after checkout (if set)
    // --------------------------------------------------
    ?>
    <?php if (isset($_SESSION["order_success"])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_SESSION["order_success"]) ?>
        </div>
        <?php unset($_SESSION["order_success"]); ?>
    <?php endif; ?>

    <?php if (mysqli_num_rows($order_result) === 0): ?>

        <div class="alert alert-info">
            You have not placed any orders yet.
        </div>

    <?php else: ?>

        <?php while ($order = mysqli_fetch_assoc($order_result)): ?>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <strong>
                        Order #<?= $order["order_id"] ?>
                        — <?= date("d M Y, H:i", strtotime($order["order_date"])) ?>
                    </strong>
                    <span>
                        Total: £<?= number_format($order["total"], 2) ?>
                    </span>
                </div>

                <div class="card-body">

                    <?php
                    // --------------------------------------------------
                    // Retrieve items for this order
                    // --------------------------------------------------
                    ?>
                    <?php
                    $items_query = "
                        SELECT oi.quantity, oi.price, b.title
                        FROM order_items oi
                        JOIN books b ON oi.book_id = b.book_id
                        WHERE oi.order_id = {$order['order_id']}
                    ";
                    $items_result = mysqli_query($link, $items_query);
                    ?>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Book</th>
                                <th>Qty</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php while ($item = mysqli_fetch_assoc($items_result)): ?>
                            <tr>
                                <td><?= htmlspecialchars($item["title"]) ?></td>
                                <td><?= $item["quantity"] ?></td>
                                <td>£<?= number_format($item["price"], 2) ?></td>
                            </tr>
                        <?php endwhile; ?>

                        </tbody>
                    </table>

                </div>
            </div>

        <?php endwhile; ?>

    <?php endif; ?>

</div>

<?php require "includes/footer.php"; ?>
