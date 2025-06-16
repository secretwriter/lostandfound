<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $status = $_POST['status'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $userId = $_SESSION['user_id'];

    // 🔽 Image Upload
    $imagePath = '';
    if ($_FILES['item_image']['error'] == 0) {
        $targetDir = "images/";
        $imageName = basename($_FILES["item_image"]["name"]);
        $imagePath = $targetDir . $imageName;

        // Move uploaded file
        move_uploaded_file($_FILES["item_image"]["tmp_name"], $imagePath);
    }

    // 🔽 Save to Database
    $stmt = $conn->prepare("INSERT INTO items (title, description, status, date_lost_found, location, image_path, user_id)
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $title, $desc, $status, $date, $location, $imagePath, $userId);
    if ($stmt->execute()) {
        echo "✅ Item posted successfully.";
    } else {
        echo "❌ Error: " . $stmt->error;
    }
}
?>

<!-- ✅ Form Starts Here -->
<h2>Post Lost or Found Item</h2>
<form method="POST" enctype="multipart/form-data">
  <input name="title" placeholder="Item Title" required><br>
  <textarea name="desc" placeholder="Description" required></textarea><br>
  <select name="status">
    <option value="lost">Lost</option>
    <option value="found">Found</option>
  </select><br>
  <input type="date" name="date" required><br>
  <input name="location" placeholder="Location" required><br>
  <input type="file" name="item_image" required><br><br>
  <button type="submit">Post</button>
</form>
