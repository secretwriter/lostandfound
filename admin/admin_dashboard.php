<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die("Access denied.");
}

$result = $conn->query("SELECT items.*, users.name FROM items JOIN users ON items.user_id = users.user_id");

echo "<h2>Admin Dashboard - All Reported Items</h2>";

while ($row = $result->fetch_assoc()) {
    echo "<div>
        <strong>{$row['title']}</strong> ({$row['status']})<br>
        Reported by: {$row['name']}<br>
        Location: {$row['location']}<br>
        Date: {$row['date_lost_found']}<br>
        <a href='delete_item.php?id={$row['item_id']}'>Delete</a>
        <hr></div>";
}
