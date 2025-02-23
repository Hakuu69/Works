<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

if (!isset($_GET['other_user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Other user ID not specified']);
    exit;
}

$current_user = $_SESSION['id'];
$other_user = $_GET['other_user_id'];

$stmt = $pdo->prepare("
    SELECT m.*, u.firstname AS sender_firstname, u.profimg AS sender_profimg
    FROM messages m
    JOIN users u ON m.sender_id = u.id
    WHERE (m.sender_id = ? AND m.receiver_id = ?)
       OR (m.sender_id = ? AND m.receiver_id = ?)
    ORDER BY m.sent_at ASC
");
$stmt->execute([$current_user, $other_user, $other_user, $current_user]);
$messages = $stmt->fetchAll();

echo json_encode(['status' => 'success', 'messages' => $messages]);
?>
