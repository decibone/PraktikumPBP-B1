<?php 
    require_once('db_login.php');
    
    $name = isset($_POST['name']) ? $db->real_escape_string($_POST['name']) : '';
    $address = isset($_POST['address']) ? $db->real_escape_string($_POST['address']) : '';
    $city = isset($_POST['city']) ? $db->real_escape_string($_POST['city']) : '';

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
            Name: '.$_POST['name'].'<br>
            Address: '.$_POST['address'].'<br>
            City: '.$_POST['city'].'<br>
            </div>';
        }
        $stmt->close();
    }
    $db->close();
?>