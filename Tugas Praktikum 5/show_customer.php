<?php include 'header.php'?>
<script src="ajax.js"></script>

<br>
<div class="card">
    <div class="card-header">Show Customer Data</div>
    <div class="card-body">
        <select name="customer" id="customer" class="form-control" onchange="showCustomer(this.value)">
            <option value="">--Select a Customer--</option>
            <?php
            require_once('../ajax/db_login.php');
            $query = " SELECT * FROM customers ORDER BY customerid ";
            $result = $db->query($query);
            if (!$result){
                die("Could not query the database: <br />". $db->error);
            }
            while ($row = $result->fetch_object()) {
                echo '<option value="'.$row->customerid.'">'.$row->name.'</option>';
            }
            $result->free();
            $db->close();
            ?>
        </select>
        <br>
        <div id="detail_customer"></div>
    </div>
</div>
<?php include('footer.html') ?>