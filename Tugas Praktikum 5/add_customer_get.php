<?php 
    require_once('db_login.php');
    
    $name = isset($_GET['name']) ? $db->real_escape_string($_GET['name']) : '';
    $address = isset($_GET['address']) ? $db->real_escape_string($_GET['address']) : '';
    $city = isset($_GET['city']) ? $db->real_escape_string($_GET['city']) : '';
    echo $name;
    if (!empty($name) && !empty($address) && !empty($city)) {
        $query = "INSERT INTO customers (name, address, city) VALUES (?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("sss", $name, $address, $city);
        $result = $stmt->execute();

        if (!$result) {
            echo '<div class="alert alert-danger alert-dismissible">
            <strong>Error!</strong> Could not query the database<br>'.
            $db->error. '<br>query = '.$query.
            '</div>';
        } else {
            echo '<div class="alert alert-success alert-dismissible">
            <strong>Success!</strong> Data has been added.<br>
            Name: '.$_GET['name'].'<br>
            Address: '.$_GET['address'].'<br>
            City: '.$_GET['city'].'<br>
            </div>';
        }
        $stmt->close();
    }
    $db->close();
?>