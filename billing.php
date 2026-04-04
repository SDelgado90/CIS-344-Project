<?php
include 'includes/db_connect.php';
$pdo->beginTransaction();
try {
    // 1. Logic to create invoice
    // 2. Logic to update guardian balance
    $pdo->commit();
    echo "Billing Processed Successfully.";
} catch (Exception $e) {
    $pdo->rollBack();
    echo "Transaction Failed: " . $e->getMessage();
}
?>
