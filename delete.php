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
    // Select the record that is going to be deleted
    $stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        exit('Contact doesn\'t exist with that ID!');
    }
    
    // delete operation
    $stmt = $conn->prepare('DELETE FROM users WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $msg = 'You have deleted the contact!';
    header('Location: index.php');
} else {
    exit('No ID specified!');
}
?>