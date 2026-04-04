<?php
require_once 'includes/db_connect.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $dob_raw = $_POST['dob'];
    
    // 1. Calculate Age in Months
    $birthDate = new DateTime($dob_raw);
    $today = new DateTime();
    $diff = $today->diff($birthDate);
    $ageMonths = ($diff->y * 12) + $diff->m;

    // 2. Map Age to Room Name
    if ($ageMonths <= 12) $targetRoom = 'Red Room';
    elseif ($ageMonths <= 18) $targetRoom = 'Blue Room';
    elseif ($ageMonths <= 24) $targetRoom = 'Green Room';
    elseif ($ageMonths <= 30) $targetRoom = 'Yellow Room';
    elseif ($ageMonths <= 36) $targetRoom = 'Orange Room';
    else $targetRoom = 'Purple Room';

    // 3. Check Capacity (Database Constraint Logic)
    $stmt = $pdo->prepare("
        SELECT id, capacity, 
        (SELECT COUNT(*) FROM children WHERE classroom_id = classrooms.id) as current_count 
        FROM classrooms WHERE room_name = ?
    ");
    $stmt->execute([$targetRoom]);
    $roomData = $stmt->fetch();

    if ($roomData['current_count'] < $roomData['capacity']) {
        // 4. Secure Insert using Prepared Statements
        $insert = $pdo->prepare("INSERT INTO children (first_name, last_name, dob, classroom_id) VALUES (?, ?, ?, ?)");
        $insert->execute([$fname, $lname, $dob_raw, $roomData['id']]);
        $message = "<p style='color:green;'>Success! Enrolled in $targetRoom.</p>";
    } else {
        $message = "<p style='color:red;'>Error: $targetRoom is full.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enrollment - Childcare System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <nav><a href="index.php">Dashboard</a> | <a href="attendance.php">Attendance</a></nav>
        <h1>Enroll a New Child</h1>
        <?php echo $message; ?>
        <form method="POST">
            <div class="form-group">
                <label>First Name:</label>
                <input type="text" name="first_name" required>
            </div>
            <div class="form-group">
                <label>Last Name:</label>
                <input type="text" name="last_name" required>
            </div>
            <div class="form-group">
                <label>Date of Birth:</label>
                <input type="date" name="dob" required>
            </div>
            <button type="submit" class="btn">Register Child</button>
        </form>
    </div>
</body>
</html>
