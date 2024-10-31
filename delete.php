<?php

include "dbconnection.php";
$obj = new DBconnection(); 

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM products WHERE ID = $id";
    
    if ($obj->delete($sql)) {
        echo "Product deleted successfully";
    } else {
        echo "Error: " . $obj->conn->error;
    }
    header("Location: dashboard.php");
    exit();
}
?>