<?php

include "../connection.php";

$id = $_GET['id'];
$sql = "UPDATE products SET product_sold = 1 WHERE product_id = $id";

if ($conn->query($sql) === TRUE) {
    header('location:../');
} else {
    echo "Error updating record: " . $conn->error;
}
