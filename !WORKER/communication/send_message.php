<?php
session_start();
include 'connection.php';

// Ensure the user is logged in
if (!isset($_SESSION['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit;
}

// Validate required POST parameters
if (!isset($_POST['receiver_id'], $_POST['message'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
    exit;
}

$sender_id   = $_SESSION['id'];
$receiver_id = $_POST['receiver_id'];
$message_text = trim($_POST['message']);

if (empty($message_text)) {
    echo json_encode(['status' => 'error', 'message' => 'Message cannot be empty.']);
    exit;
}

$stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
$stmt->execute([$sender_id, $receiver_id, $message_text]);

echo json_encode(['status' => 'success', 'message' => 'Message sent successfully.']);
?>
