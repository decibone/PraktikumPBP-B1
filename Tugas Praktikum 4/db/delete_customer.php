<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit();
}

require_once('../db/db_login.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "DELETE FROM customers WHERE customerid = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $stmt->close();
        $db->close();
        header('Location: view_customer_php.php');
        exit();
    } else {
        die("Could not delete from the database: " . $db->error);
    }
} else {
    header('Location: view_customer_php.php');
    exit();
}
?>