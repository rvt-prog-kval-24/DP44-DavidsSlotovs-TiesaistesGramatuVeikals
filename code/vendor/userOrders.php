<?php
    include('dbconnect.php');

    if(isset($_GET['userID'])){
        $userID = $_GET['userID'];
    
        $userOrders = GetUsersOrders($con, $userID);
        $orderedItems = GetOrderedItems($con, $userOrders);
        $orderedBooks = GetOrderedBooks($con, $orderedItems);
        GetOrderedBooksJSON($userOrders, $orderedBooks);
    }

    function GetOrderedBooksJSON($userOrders, $orderedBooks){
        $array = array();
        foreach($userOrders as $order)
            array_push($array, ['id' => $order[0], 'userID' => $order[1], 'status' => $order[2], 'books' => $orderedBooks]);
        echo json_encode($array);
    }
    function GetOrderBooks($con, $userID){
        $userOrders = GetUsersOrders($con, $userID);
        $orderedItems = GetOrderedItems($con, $userOrders);
        $orderedBooks = GetOrderedBooks($con, $orderedItems);

        return $orderedBooks;
    }

    function GetOrderedItems($con, $userOrders){
        $orderedItems = array();
        foreach($userOrders as $orders){
            $orderID = $orders[0];
            $query = "SELECT productID FROM orderItems WHERE orderID = $orderID";
            $result = mysqli_query($con, $query);
            $orderItems = mysqli_fetch_all($result);
            array_push($orderedItems, $orderItems);
        }
        return $orderItems;
    }

    function GetOrderedBooks($con, $orderedItems){
        $orderedBooks = array();
        foreach($orderedItems as $item){
            $books = array();
            for($i = 0; $i < count($item); $i++)
            {
                $bookID = $item[$i];
                $query = "SELECT id, title FROM products WHERE id = $bookID";
                $result = mysqli_query($con, $query);
                $book = mysqli_fetch_assoc($result);
                array_push($books, $book);
            }
            array_push($orderedBooks, $books);
        }
        return $orderedBooks;
    }
    function GetUsersOrders($con, $userID){
        $query = "SELECT * FROM orders WHERE userID = $userID";
        $result = mysqli_query($con, $query);
        return mysqli_fetch_all($result);
    }
