<?php 
session_start();

$id = isset($_GET['id']) ? $_GET['id'] : "";

if ($id != "") {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = 1;
    } else {
        $_SESSION['cart'][$id]++;
    }
}
?>
<?php include('../db/header.php')?>
<br>
<div class="card">
    <div class="card-reader">Shopping Cart</div>
    <div class="card-body">
        <br>
        <table class="table table-striped">
            <tr>
                <th>ISBN</th>
                <th>Author</th>
                <th>Title</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Price * Qty</th>
            </tr>
            <?php
            require_once('../db/db_login.php');
            $sum_qty = 0;
            $sum_price = 0;
            if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
                foreach ($_SESSION['cart'] as $id => $qty){
                    $query = "SELECT * FROM books WHERE isbn='".mysqli_real_escape_string($db, $id)."'";
                    $result = $db->query($query);
                    if (!$result){
                        die ("Could not query the database: <br>".$db->error."<br>Query: ".$query);
                    }
                    while ($row = $result->fetch_object()){
                        echo '<tr>';
                        echo '<td>'.$row->isbn.'</td>';
                        echo '<td>'.$row->author.'</td>';
                        echo '<td>'.$row->title.'</td>';
                        echo '<td>'.$row->price.'</td>';
                        echo '<td>'.$qty.'</td>';
                        echo '<td>'.($row->price * $qty).'</td>';
                        echo '</tr>';
                        $sum_qty += $qty;
                        $sum_price += ($row->price * $qty);
                    }
                    $result->free();
                }
                echo '<tr><td colspan="4"></td><td>'.$sum_qty.'</td><td>'.$sum_price.'</td></tr>';
                $db->close();
            } else {
                echo '<tr><td colspan="6" align="center">There is no item in the shopping cart</td></tr>';
            }
            ?>
        </table>
        Total items = <?php echo $sum_qty; ?><br><br>
        <a class="btn btn-primary" href="view_books.php">Continue Shopping</a>
        <a class="btn btn-danger" href="delete_cart.php">Empty Cart</a><br /><br />
    </div>
</div>
<?php include('../db/footer.php')?>