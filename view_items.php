<?php
require 'includes/db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Lost & Found Items</title>
</head>
<body>
    <h2>View Lost & Found Items</h2>

    <!-- 🔍 Search Form -->
    <form method="GET">
        <input name="query" placeholder="Search by title/location..." />
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
        echo "<div>
                <strong>{$row['title']}</strong> ({$row['status']})<br>
                {$row['description']}<br>
                Location: {$row['location']}<br>
                Date: {$row['date_lost_found']}<br>";

        if (!empty($row['image_path'])) {
            echo "<img src='images/{$row['image_path']}' width='150'><br>";
        }

        echo "<hr></div>";
    }
    ?>
</body>
</html>
