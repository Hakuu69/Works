<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

if (!isset($_POST['other_user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'No conversation specified']);
    exit;
}

$currentUser = $_SESSION['id'];
$otherUserId = $_POST['other_user_id'];

// Delete messages where the conversation involves the two users
$stmt = $pdo->prepare("DELETE FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?)");
$stmt->execute([$currentUser, $otherUserId, $otherUserId, $currentUser]);

echo json_encode(['status' => 'success', 'message' => 'Conversation deleted']);
?>
