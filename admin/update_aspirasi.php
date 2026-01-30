<?php
require_once __DIR__ . '/../connection.php';
$aspiration_id = intval($_POST['aspiration_id']);
$status = trim($_POST['status']);
$feedback = trim($_POST['feedback']);

$sql = "UPDATE aspirasi SET status = '$status', feedback = '$feedback'
        WHERE aspiration_id = $aspiration_id";
if (mysqli_query($conn, $sql)) {
    header('location: index.php?message=updated');
} else {
    die('Error updating aspiration: ' . mysqli_error($conn));
}
?>