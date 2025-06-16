<?php
require 'includes/db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Lost & Found Items</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 8px;
            width: 300px;
            font-size: 16px;
        }

        button {
            padding: 8px 12px;
            font-size: 16px;
        }

        .item-card {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .item-card img {
            margin-top: 10px;
            border: 1px solid #aaa;
            max-width: 150px;
        }

        h3 {
            margin-bottom: 5px;
        }

        p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h2>📋 View Lost & Found Items</h2>

    <!-- 🔍 Search Form -->
    <form method="GET">
        <input type="text" name="query" placeholder="Search by title or location..." />
        <button type="submit">Search</button>
    </form>

    <hr>

    <?php
    // 🔍 Search Logic
    $search = $_GET['query'] ?? '';
    $searchWildcard = "%$search%";

    $stmt = $conn->prepare("SELECT * FROM items WHERE title LIKE ? OR location LIKE ?");
    $stmt->bind_param("ss", $searchWildcard, $searchWildcard);
    $stmt->execute();
    $result = $stmt->get_result();

    // 🔄 Loop Through Results
    while ($row = $result->fetch_assoc()) {
        $title = htmlspecialchars($row['title']);
        $description = nl2br(htmlspecialchars($row['description']));
        $status = htmlspecialchars($row['status']);
        $location = htmlspecialchars($row['location']);
        $date = htmlspecialchars($row['date_lost_found']);
        $imagePath = $row['image_path'];

        echo "<div class='item-card'>";
        echo "<h3>{$title} <small>({$status})</small></h3>";
        echo "<p><strong>Description:</strong> {$description}</p>";
        echo "<p><strong>Location:</strong> {$location}</p>";
        echo "<p><strong>Date:</strong> {$date}</p>";

        if (!empty($imagePath) && file_exists($imagePath)) {
            echo "<img src='{$imagePath}' alt='Item Image'>";
        }

        echo "</div>";
    }

    $stmt->close();
    $conn->close();
    ?>
</body>
</html>
