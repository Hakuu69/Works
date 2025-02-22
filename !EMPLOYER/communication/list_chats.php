<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit;
}

$user_id = $_SESSION['id'];

$query = "
SELECT t.chat_partner, u.fullname, u.firstname AS partner_firstname, u.profimg, m.message, m.sent_at, m.sender_id, m.is_read
FROM (
    SELECT 
        CASE WHEN sender_id = ? THEN receiver_id ELSE sender_id END AS chat_partner,
        MAX(sent_at) AS last_sent
    FROM messages
    WHERE sender_id = ? OR receiver_id = ?
    GROUP BY chat_partner
) t
JOIN messages m ON (
    ((m.sender_id = ? AND m.receiver_id = t.chat_partner) OR (m.sender_id = t.chat_partner AND m.receiver_id = ?))
    AND m.sent_at = t.last_sent
)
JOIN (
    SELECT id, CONCAT(firstname, ' ', lastname) AS fullname, firstname, profimg FROM users
) u ON u.id = t.chat_partner
ORDER BY m.sent_at DESC
";

$stmt = $pdo->prepare($query);
$stmt->execute([$user_id, $user_id, $user_id, $user_id, $user_id]);
$conversations = $stmt->fetchAll();

echo json_encode(['status' => 'success', 'conversations' => $conversations]);
?>
