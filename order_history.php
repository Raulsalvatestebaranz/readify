<?php
$page_title = "My Orders – READIFY";
require "includes/header.php";
require "includes/auth_guard.php";
require "includes/nav.php";
require "connect_db.php";

$user_id = $_SESSION["user_id"];

/* Fetch orders */
$query = "
    SELECT order_id, total, order_date
    FROM orders
    WHERE user_id = $user_id
    ORDER BY order_date DESC
";
$orders = mysqli_query($link, $query);
?>

<div class="container mt-4">

<h2 class="mb-4">My Orders</h2>

<?php if (isset($_SESSION["order_success"])): ?>
    <div class="alert alert-success">
        <?= htmlspecialchars($_SESSION["order_success"]) ?>
    </div>
    <?php unset($_SESSION["order_success"]); ?>
<?php endif; ?>

<?php if (mysqli_num_rows($orders) === 0): ?>

    <div class="alert alert-info">
        You haven’t placed any orders yet.
    </div>

<?php else: ?>

    <?php while ($order = mysqli_fetch_assoc($orders)): ?>

        <div class="card mb-4">
            <div class="card-header">
                <strong>Order #<?= $order["order_id"] ?></strong>
                — <?= date("d M Y, H:i", strtotime($order["order_date"])) ?>
                <span class="float-end">
                    Total: £<?= number_format($order["total"], 2) ?>
                </span>
            </div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Book</th>
                            <th>Qty</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                    $items_query = "
                        SELECT b.title, oi.quantity, oi.price
                        FROM order_items oi
                        JOIN books b ON oi.book_id = b.book_id
                        WHERE oi.order_id = {$order['order_id']}
                    ";
                    $items = mysqli_query($link, $items_query);
                    ?>

                    <?php while ($item = mysqli_fetch_assoc($items)): ?>
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
