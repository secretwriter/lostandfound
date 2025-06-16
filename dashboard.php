<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
echo "<h2>Welcome, " . $_SESSION['name'] . "</h2>";
?>

<a href="post_item.php">Post Lost/Found Item</a> |
<a href="view_items.php">View Items</a> |
<a href="logout.php">Logout</a>
