<?php include('../db/header.php'); ?>
<div class="card">
<div class="card-header">Customer Data</div>
<div class="card-body">
<br>
<a class="btn btn-primary" href="add_customer.php">+ Add Customer Data</a><br /><br />
<a href="logout.php" class="btn btn-danger btn-sm float-right">Logout</a></div>
<table class="table table-striped">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Address</th>
        <th>City</th>
        <th>Action</th>
    </tr>
<?php
require_once('../db/db_login.php');
$query = " SELECT * FROM customers ORDER BY customerid ";
$result = $db->query($query);
if(!$result){
    die("Could not query the database: <br />".$db->error."<br>Query: ".$query);
}
$i=1;
while ( $row = $result->fetch_object()){
    echo '<tr>';
    echo '<td>'.$i.'</td> ';
    echo '<td>'.$row->name.'</td> ';
    echo '<td>'.$row->address.'</td> ';
    echo '<td>'.$row->city.'</td> ';
    echo '<td><a class="btn btn-warning btn-sm" href="edit_customer.php?id='.$row->customerid.'">Edit</a>&nbsp;&nbsp;
        <a class="btn btn-danger btn-sm" href="delete_customer.php?id='.$row->customerid.'">Delete</a>
        </td>';
    echo '</tr>';
    $i++;
}
echo '</table';
echo '<br />';
echo 'Total Rows = '.$result->num_rows;
$result->free();
$db->close();

?>
</div>
</div>