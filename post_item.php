<?php
session_start();
require 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $status = $_POST['status'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO items (title, description, status, date_lost_found, location, user_id)
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $title, $desc, $status, $date, $location, $userId);
    $stmt->execute();
    echo "✅ Item posted!";
}
?>

<form method="POST">
  <input name="title" placeholder="Item Title" required>
  <textarea name="desc" placeholder="Description" required></textarea>
  <select name="status">
    <option value="lost">Lost</option>
    <option value="found">Found</option>
  </select>
  <input name="date" type="date" required>
  <input name="location" placeholder="Location" required>
  <button type="submit">Post</button>
</form>
