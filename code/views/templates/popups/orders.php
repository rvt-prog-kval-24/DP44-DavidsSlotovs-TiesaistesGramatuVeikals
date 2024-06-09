<?php
    include("vendor/userOrders.php");

    $query = "SELECT * FROM orders";
    $result = mysqli_query($con, $query);
    $orders = mysqli_fetch_all($result);
?>
<li>
    <button type="button" class="btn btn-lg" data-toggle="modal" data-target="#orders">Orders</button>
    <div id="orders" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: green; color: white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">Orders</h4>
                </div>
                <div class="modal-body">
                    <form id="userSearch" action="">
                        <?php echo realpath('../../../vendor/userOrders.php');?>
                        <input type="text" name="" class="form-control" placeholder="Search for user">
                    </form>
                    <div>
                        <h3 id="userName" style="text-align: center;">All orders</h3>
                    </div>
                    <table class="table" id="table">
                        <thead>
                            <th>Order ID</th>
                            <th>User ID</th>
                            <th>Status</th>
                            <th>Books</th>
                            <th>Actions<th>
                        </thead>
                        <tbody>
                            <?php for($i = 0; $i < count($orders); $i++):?>
                                <tr>
                                    <td><?=$orders[$i][0]?></td>
                                    <td><?=$orders[$i][1]?></td>
                                    <td><?=$orders[$i][2]?></td>
                                    <td>
                                        <?php 
                                            foreach(GetOrderBooks($con, $orders[$i][1]) as $book){ 
                                                echo "<a href='/bookstore/description.php/". $book[0]['id']."'>". $book[0]['title']. ";</a>";
                                            }
                                        ?>
                                    </td>
                                    <td><a href='/bookstore/vendor/deleteOrder.php?id=<?= $orders[$i][0]?>'>Mark as done</a></td>
                                </tr>
                            <?php endfor;?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color: green; color: white;">Close</button>
                </div>
            </div>
            <div>

            </div>
        </div>
    </div>
</li>
<script>
    $("#userSearch").on("submit", function(e){
        e.preventDefault();
        $.getJSON("/bookstore/vendor/userSearch.php",{ q: $("#userSearch input").val() }).done(function(data){
            $('#userName').text(data['name']);
            var orders = GetUserOrders(data['id']);
        })
    })

    function GetUserOrders(userID){
        $.getJSON("/bookstore/vendor/userOrders.php", {userID: userID}).done(function(data){
            var tableContent = $("tbody");
            var childrens = tableContent.empty();
            $('#table').css("opacity", 1);
            data.forEach(function(element){
                console.log(element['books']);
                var elementString = "<tr class='table-line'>"
                        + "<td class='table-elem'>" + element['id'] + "</td>" 
                        + "<td class='table-elem'>" + element['userID'] + "</td>" 
                        + "<td class='table-elem'>" + element['status'] + "</td>";
                    if (Array.isArray(element['books'])) {
                        elementString += "<td class='table-elem'>";
                        element['books'].forEach(function(book){
                            if(!book)
                                return;

                            if(book.length === undefined)
                                elementString += "<a href='/bookstore/description.php/" + book['id'] + "'>" + book['title'] + "</a>; ";
                            else
                                elementString += "<a href='/bookstore/description.php/" + book[0]['id'] + "'>" + book[0]['title'] + "</a>; ";
                        });
                        elementString += "</td>";
                    }  
                    elementString += "<td class='table-elem'><a href='/bookstore/vendor/deleteOrder.php?id="+ element['id'] +"'>Mark as done</a></td>" + "</tr>";
                tableContent.append(elementString);
            });
        });
    }
</script>
<style>
    tbody a {
        color: #000 !important;
    }
</style>