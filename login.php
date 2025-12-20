<?php
// Display errors if they exist
if (isset($errors) && !empty($errors)) {
    echo '<p>The following error(s) occurred:</p>';
    foreach ($errors as $msg) {
        echo "$msg<br>";
    }
}
?>

<h2>Login</h2>

<form action="login_action.php" method="post">
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="pass" placeholder="Password"><br>
    <input type="submit" value="Login">
</form>
