<?php 
//Nama: Laurentius Lucky Andriawan
//NIM: 24060122130100
//File: Show_books.php

include 'header.php'?>
<script src="ajax.js"></script>

<br>
<div class="card">
    <div class="card-header">Search Books</div>
    <div class="card-body">
        <label for="books">Masukkan judul buku</label><br>
        <input type="text" id="title" name="title" class="form-control" required>
        <br>
        <button type="button" class="btn btn-primary" onclick="searchBook()">Search</button>
        <br><br>
        <div id="detail_buku"></div>
    </div>
</div>
<?php include('footer.php') ?>