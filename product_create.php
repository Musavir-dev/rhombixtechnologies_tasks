<?php

include "dbconnection.php";
$obj = new DBconnection();
if (isset($_POST) && count($_POST) > 0) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $sql = "INSERT INTO products (Name, Price, Description, Status)
            VALUES ('$name', '$price', '$description', '$status')";

    if ($obj->insert($sql)) {
        echo "New product created successfully";
    } else {
        echo "Error: " . mysqli_error($obj->conn);
    }

    header("Location: dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Form</title>
</head>
<body>
    <form action="product_create.php" method="post">
        <label for="name">Product Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="price">Price:</label><br>
        <input type="text" id="price" name="price" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="status">Status:</label><br>
        <select name="status" id="status">
          <option value="active">active</option>
          <option value="inactive">Inactive</option>
        </select><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>