<?php
require '../includes/db.php';
$id = $_GET['id'] ?? 0;
$conn->query("DELETE FROM items WHERE item_id = $id");
header("Location: admin_dashboard.php");
