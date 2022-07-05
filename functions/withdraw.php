<?php

include "../connection.php";

if (isset($_POST["submit"])) {

    $sql = "SELECT balance FROM balance_box WHERE id = 1";
    $result = $conn->query($sql);
    $data = $result->fetch_column();

    $withdraw = mysqli_real_escape_string($conn, $_POST['withdraw']);

    if ($withdraw > $data) {
        echo "<script>alert('Withdraw is failed....!!!');
        location.href='../';</script>";
    } else {
        $balance = $data - $withdraw;

        $queries = "UPDATE balance_box SET balance = $balance WHERE id = 1";

        if ($conn->query($queries) === TRUE) {
            echo "<script>alert('Withdraw is success....!!!');
            location.href='../';</script>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}
