<?php
session_start();
include 'connection.php';

// Ensure the user is logged in
if (!isset($_SESSION['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit;
}

// Check for the other user's ID in the GET parameters
if (!isset($_GET['other_user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Other user ID not specified.']);
    exit;
}

$current_user = $_SESSION['id'];
$other_user_id = $_GET['other_user_id'];

// Join with users to get the sender's firstname
$stmt = $pdo->prepare("
    SELECT m.*, u.firstname AS sender_firstname 
    FROM messages m 
    JOIN users u ON m.sender_id = u.id 
    WHERE (m.sender_id = ? AND m.receiver_id = ?) 
       OR (m.sender_id = ? AND m.receiver_id = ?)
    ORDER BY m.sent_at ASC
");
$stmt->execute([$current_user, $other_user_id, $other_user_id, $current_user]);
$messages = $stmt->fetchAll();

echo json_encode(['status' => 'success', 'messages' => $messages]);
?>
