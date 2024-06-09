<?php
    include("dbconnect.php");

    $q = $_GET['q'];

    $query = "SELECT id, name FROM users";
    $result = mysqli_query($con, $query);
    $users = mysqli_fetch_all($result);
    $array = array();
    foreach($users as $user)
        array_push($array, ['id' => $user[0], 'name' => $user[1]]);

    foreach($array as $element){
        if(str_contains($element['name'], $q)){
            echo json_encode($element);
            break;
        }
        else if(str_contains($element['id'], $q)){
            echo json_encode($element);
            break;
        }
    }

    