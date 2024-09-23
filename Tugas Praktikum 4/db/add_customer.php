<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit();
}

require_once('../db/db_login.php');
include('../db/header.php');

$valid = TRUE;
$error_customerid = $error_name = $error_address = $error_city = "";

if (isset($_POST["submit"])) {
    // Validate Customer ID
    $customerid = test_input($_POST['customerid']);
    if ($customerid == '') {
        $error_customerid = "Customer ID is required";
        $valid = FALSE;
    } elseif (!is_numeric($customerid)) {
        $error_customerid = "Customer ID must be a number";
        $valid = FALSE;
    } else {
        // Check if Customer ID is unique
        $query = "SELECT * FROM customers WHERE customerid = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $customerid);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $error_customerid = "This Customer ID already exists. Please use a unique ID.";
            $valid = FALSE;
        }
        $stmt->close();
    }

    $name = test_input($_POST['name']);
    if ($name == '') {
        $error_name = "Name is required";
        $valid = FALSE;
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $error_name = "Only letters and white space allowed";
        $valid = FALSE;
    }

    $address = test_input($_POST['address']);
    if ($address == '') {
        $error_address = 'Address is required';
        $valid = FALSE;
    }

    $city = test_input($_POST['city']);
    if ($city == '' || $city == 'none') {
        $error_city = "City is required";
        $valid = FALSE;
    }

    if ($valid) {
        $address = $db->real_escape_string($address);
        
        $query = "INSERT INTO customers (customerid, name, address, city) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("isss", $customerid, $name, $address, $city);
        
        if ($stmt->execute()) {
            $stmt->close();
            $db->close();
            header('Location: view_customer_php.php');
            exit();
        } else {
            die("Could not insert into the database: " . $db->error);
        }
    }
}
?>

<br>
<div class="card">
    <div class="card-header">Add New Customer</div>
    <div class="card-body">
        <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="customerid">Customer ID:</label>
                <input type="text" class="form-control" id="customerid" name="customerid" value="<?php echo isset($customerid) ? $customerid : ''; ?>">
                <div class="error"><?php echo $error_customerid; ?></div>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
                <div class="error"><?php echo $error_name; ?></div>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea class="form-control" id="address" name="address" rows="5"><?php echo isset($address) ? $address : ''; ?></textarea>
                <div class="error"><?php echo $error_address; ?></div>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <select name="city" id="city" class="form-control" required>
                    <option value="none" <?php if (!isset($city)) echo 'selected="true"'; ?>>--Select a city--</option>
                    <option value="Airport West" <?php if(isset($city) && $city=="Airport West") echo 'selected="true"'; ?>>Airport West</option>
                    <option value="Box Hill" <?php if(isset($city) && $city== 'Box Hill') echo 'selected = "true"'; ?>>Box Hill</option>
                    <option value="Yarraville" <?php if(isset($city) && $city=="Yarraville") echo 'selected = "true"'; ?>>Yarraville</option>
                </select>
                <div class="error"><?php echo $error_city; ?></div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
            <a href="view_customer_php.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php 
include('../db/footer.php');
$db->close();
?>