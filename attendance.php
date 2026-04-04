<?php
require_once 'includes/db_connect.php';

// SQL JOIN: Retrieving children linked to their specific classrooms
$query = "
    SELECT 
        children.first_name, 
        children.last_name, 
        classrooms.room_name, 
        classrooms.age_range
    FROM children
    JOIN classrooms ON children.classroom_id = classrooms.id
    ORDER BY classrooms.room_name ASC
";

$stmt = $pdo->query($query);
$roster = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daily Attendance - Childcare System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <nav><a href="index.php">Dashboard</a> | <a href="enrollment.php">Enrollment</a></nav>
        <h1>Daily Attendance Roster</h1>
        
        <table>
            <thead>
                <tr>
                    <th>Child Name</th>
                    <th>Classroom</th>
                    <th>Age Group</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roster as $child): ?>
                <tr>
                    <td><?php echo $child['first_name'] . " " . $child['last_name']; ?></td>
                    <td><strong><?php echo $child['room_name']; ?></strong></td>
                    <td><?php echo $child['age_range']; ?></td>
                    <td>
                        <select name="status">
                            <option value="present">Present</option>
                            <option value="absent">Absent</option>
                        </select>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <button class="btn">Save Attendance</button>
    </div>
</body>
</html>
