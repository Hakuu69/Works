<?php
ini_set('display_errors', 0);
error_reporting(0);

session_start();
include 'connection.php';

if (!isset($_SESSION['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit;
}

if (!isset($_POST['email']) || empty(trim($_POST['email']))) {
    echo json_encode(['status' => 'error', 'message' => 'Email is required.']);
    exit;
}

$email = trim($_POST['email']);
$stmt = $pdo->prepare("SELECT id, firstname, lastname, profimg FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user) {
    if ($user['id'] == $_SESSION['id']) {
        echo json_encode(['status' => 'error', 'message' => "You can't start a conversation with yourself."]);
        exit;
    }
    echo json_encode([
        'status' => 'success',
        'chat_partner' => $user['id'],
        'name' => $user['firstname'] . ' ' . $user['lastname'],
        'profimg' => $user['profimg']
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'User with that email not found.']);
}
?>
