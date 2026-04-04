<?php include 'includes/db_connect.php'; ?>
<!DOCTYPE html><html><head><link rel="stylesheet" href="css/style.css"></head>
<body>
<div class="container">
    <nav><a href="index.php">Home</a><a href="enrollment.php">Enroll</a></nav>
    <h1>Center Overview</h1>
    <?php
    $stmt = $pdo->query("SELECT c.room_name, COUNT(ch.id) as total FROM classrooms c LEFT JOIN children ch ON c.id = ch.classroom_id GROUP BY c.id");
    while ($row = $stmt->fetch()) {
        echo "<div class='room-card'>{$row['room_name']}: {$row['total']} children</div>";
    }
    ?>
</div></body></html>
