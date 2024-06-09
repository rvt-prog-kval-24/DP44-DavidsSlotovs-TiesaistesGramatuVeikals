<?php
    include('dbconnect.php');
    $orderID = $_GET['id'];
    $query = "DELETE FROM orders WHERE id = $orderID";
    mysqli_query($con, $query);
    header("Location: " . $_SERVER['HTTP_REFERER']);