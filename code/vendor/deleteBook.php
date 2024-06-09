<?php
    include("dbconnect.php");
    $bookId = $_GET['ID'];
    $query = "DELETE FROM products WHERE id = '$bookId'";
    mysqli_query($con, $query);
    header("Location: /bookstore/index.php");