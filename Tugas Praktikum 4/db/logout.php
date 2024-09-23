<?php 
// TODO 1: Inisialisasi session
session_start();
if(isset($_SESSION['username'])){
    unset($_SESSION['username']);
    session_destroy();
}
header('Location: login.php');
?>