<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['id'])) {
    echo json_encode(['status'=>'error','message'=>'User not logged in']);
    exit;
}

if (!isset($_GET['id'])) {
    echo json_encode(['status'=>'error','message'=>'No user id provided']);
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT id, firstname, lastname, profimg FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if ($user) {
    $user['name'] = $user['firstname'] . ' ' . $user['lastname'];
    echo json_encode(['status'=>'success', 'user'=>$user]);
} else {
    echo json_encode(['status'=>'error', 'message'=>'User not found']);
}
?>
