<?php
include_once __DIR__ . '/../connection.php';
$_SESSION = [];
session_destroy();
header('Location: login.php');
exit();
?>