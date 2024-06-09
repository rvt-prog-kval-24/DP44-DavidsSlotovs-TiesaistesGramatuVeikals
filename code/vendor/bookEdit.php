<?php
    include("dbconnect.php");
    var_dump($_POST);
    $bookID = $_POST['ID'];
    $description = urlencode($_POST['description']);
    $query = "UPDATE products SET description = '". $description ."' WHERE id = '". $bookID ."'";
    mysqli_query($con, $query);
    header("Location: " . $_SERVER['HTTP_REFERER']);
    ?>