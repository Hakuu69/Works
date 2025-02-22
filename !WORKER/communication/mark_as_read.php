<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit;
}

if (!isset($_POST['other_user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Other user ID not provided.']);
    exit;
}

$loggedInUser = $_SESSION['id'];
$otherUserId   = $_POST['other_user_id'];

// Update messages: mark as read messages that were sent by the other user and not yet read.
$stmt = $pdo->prepare("UPDATE messages SET is_read = 1 WHERE sender_id = ? AND receiver_id = ? AND is_read = 0");
$stmt->execute([$otherUserId, $loggedInUser]);

echo json_encode(['status' => 'success']);
?>
