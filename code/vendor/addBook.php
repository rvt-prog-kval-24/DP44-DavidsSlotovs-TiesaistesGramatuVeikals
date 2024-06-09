<?php
    include("dbconnect.php");
    if(isset($_POST)){
        $title = $_POST['title'];
        $price = $_POST['price'];
        $author = $_POST['author'];
        $category = $_POST['category'];
        $description = urlencode($_POST['description']);

        $image = $_FILES['image'];
        $fileName = $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileType = $_FILES['image']['type'];
    
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $fileNameNew = $fileName . uniqid('', true) . "." . $fileActualExt;
        $fileDestinationToDB = 'assets/uploads/' . $fileNameNew;
        $fileDestination = '../assets/uploads/' . $fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);

        $query = "INSERT INTO products (title, authorID, price, category, description, image) 
        VALUES ('$title', $author, $price, '$category', '$description', '$fileDestinationToDB')";
        echo '<pre>';
        var_dump($query);
        echo '</pre>';
        mysqli_query($con, $query);
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }