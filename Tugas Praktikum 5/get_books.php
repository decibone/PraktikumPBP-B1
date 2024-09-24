<?php
//Nama: Laurentius Lucky Andriawan
//NIM: 24060122130100
//File: get_books.php

require_once('../lib/db_login.php');

$title = $db->real_escape_string($_GET['title']);
$query = "SELECT * FROM books WHERE title LIKE '%$title%'";
$result = $db->query($query);

if(!$result){
    die("Could not query the database: " . $db->error);
}

if($result->num_rows > 0){
    echo "Detail Buku:";
    while($row = $result->fetch_object()){
        echo '<div class="book-details">';
        echo 'ISBN: '.htmlspecialchars($row->isbn).'<br />';
        echo 'Title: '.htmlspecialchars($row->title).'<br />';
        echo 'Author: '.htmlspecialchars($row->author).'<br />';
        echo 'Price: $'.htmlspecialchars($row->price).'<br />';
        echo '</div><hr>';
    }
} else {
    echo "Buku berjudul '".htmlspecialchars($title)."' tidak ditemukan.";
}

$result->free();
$db->close();
?>