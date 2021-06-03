<?php
require_once 'config/config.php';
include('includes/header.php');

$user = '';
if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
}else{
    header('location: login.php');
}


$msg = '';
// Check that the User ID exists
if (isset($_GET['id'])) {
    $stmt = $conn->prepare('SELECT * FROM todo WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $todo = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$todo) {
        exit('Data doesn\'t exist with that ID!');
    }
    
    // delete operation
    $stmt = $conn->prepare('DELETE FROM todo WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $msg = 'You have deleted the contact!';
    header('Location: index.php');
} else {
    exit('No ID specified!');
}
?>