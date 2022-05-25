<?php include("config.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Gensokyo Grand Hotel Guest Log</title>
    <style>
        .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
        }
    
        /* Style the buttons that are used to open the tab content */
        .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        }
    
        /* Change background color of buttons on hover */
        .tab button:hover {
        background-color: #ddd;
        }
    
        /* Create an active/current tablink class */
        .tab button.active {
        background-color: #ccc;
        }
    
        /* Style the tab content */
        .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
        }
    </style>
    <link rel="stylesheet" href="aloguest.css">
</head>

<body>
    <header>
        <h1>Gensokyo Grand Hotel</h1>
        <h3>Guest Log Database</h3>
    </header>

    <div class="tab">
        <button class="tablinks" onclick="openTable(event, 'Rooms')" id="defaultRoom">Rooms</button>
        <button class="tablinks" onclick="openTable(event, 'Guests')" id="defaultGuest">Guests</button>
        <button class="tablinks" onclick="openTable(event, 'Orders')" id="defaultOrder">Orders</button>
        <button class="tablinks" onclick="openTable(event, 'Services')" id="defaultService">Services</button>
        <button class="tablinks" onclick="openTable(event, 'Gensokyo')">Gensokyo</button>
    </div>

    <div id="Rooms" class="tabcontent">
        <h3>Room List</h3>

        <br>

        <table border="1" class="table">
            <thead>
                <tr>
                    <th>Room Number</th>
                    <th>Type</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    $sql = "SELECT * FROM rooms ORDER BY ABS(room_number)";
                    $query = mysqli_query($db, $sql);

                    while($room = mysqli_fetch_array($query)){
                        echo "<tr>";

                        echo "<td>".$room['room_number']."</td>";
                        echo "<td>".$room['room_type']."</td>";
                        echo "<td>".$room['status']."</td>";

                        echo "<td>";
                        echo "<button onClick=\"location.href='edit-room.php?id=".$room['room_number']."';\">Edit</button> ";
                        echo "<button onClick=\"location.href='index.php?r_id=".$room['room_number']."';\">Delete</a>";
                        echo "</td>";

                        echo "</tr>";
                    }
                ?>
                <td colspan="3">
                    <button onClick="location.href='insert-room.php';">Add Room</button>
                </td>

            </tbody>
        </table>

        <p>Total: <?php echo mysqli_num_rows($query) ?></p>

        <div id="delete_r">
            <?php if(isset($_GET['r_id'])){
                    $id = $_GET['r_id'];

                    $sql = "DELETE FROM rooms WHERE room_number=$id";
                    $query = mysqli_query($db, $sql);

                    if( $query ){
                        header('Location: index.php?');
                    } else {
                        die("delete attempt failed");
                    }
                }
            ?>
        </div>
        
    </div>

    <div id="Guests" class="tabcontent">
        <h3>Guest List</h3>
        
        <br>

        <table border="1" class="table">
            <thead>
                <tr>
                    <th>Guest ID</th>
                    <th>Room</th>
                    <th>Name</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM guests ORDER BY ABS(room_number)";
                $query = mysqli_query($db, $sql);

                while($guest = mysqli_fetch_array($query)){
                    echo "<tr>";

                    echo "<td>".$guest['guest_id']."</td>";
                    echo "<td>".$guest['room_number']."</td>";
                    echo "<td>".$guest['guest_name']."</td>";
                    echo "<td>".$guest['guest_checkin']."</td>";
                    echo "<td>".$guest['guest_checkout']."</td>";

                    echo "<td>";
                    echo "<button onClick=\"location.href='edit-guest.php?id=".$guest['guest_id']."';\">Edit</button> ";
                    echo "<button onClick=\"location.href='index.php?def=guest&g_id=".$guest['guest_id']."';\">Delete</button>";
                    echo "</td>";

                    echo "</tr>";
                }
                ?>
                <td colspan="5">
                    <button onClick="location.href='insert-guest.php'">Add Guest</button>
                </td>
            

            </tbody>
        </table>

        <p>Total: <?php echo mysqli_num_rows($query) ?></p>

        <div id="delete_g">
            <?php if(isset($_GET['g_id'])){
                    $id = $_GET['g_id'];

                    $sql = "DELETE FROM guests WHERE guest_id=$id";
                    $query = mysqli_query($db, $sql);

                    if( $query ){
                    } else {
                        die("delete attempt failed");
                    }
                }
            ?>
        </div>
    </div>

    <div id="Orders" class="tabcontent">
        <h3>Order List</h3>
        
        <br>

        <table border="1" class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Client</th>
                    <th>Room</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM orders ORDER BY order_date DESC, order_time DESC";
                $query = mysqli_query($db, $sql);

                while($order = mysqli_fetch_array($query)){
                    echo "<tr>";

                    echo "<td><button onClick=\"location.href='include-service.php?is_id=".$order['order_id']."';\">".$order['order_id']."</button></td>";
                    echo "<td>".$order['guest_id']."</td>";
                    echo "<td>".$order['room_number']."</td>";
                    echo "<td>".$order['order_date']."</td>";
                    echo "<td>".$order['order_time']."</td>";

                    echo "<td>";
                    echo "<button onClick=\"location.href='edit-order.php?id=".$order['order_id']."'\";>Edit</button> ";
                    echo "<button onClick=\"location.href='index.php?def=order&o_id=".$order['order_id']."'\";>Delete</button>";
                    echo "</td>";

                    echo "</tr>";
                }
                ?>
                <td colspan="5">
                    <button onClick="location.href='insert-order.php'">Add Order</button>
                </td>

            </tbody>
        </table>

        <p>Total: <?php echo mysqli_num_rows($query) ?></p>

        <div id="delete_o" class="table">
            <?php if(isset($_GET['o_id'])){
                    $id = $_GET['o_id'];

                    $sql = "DELETE FROM orders WHERE order_id=$id";
                    $query = mysqli_query($db, $sql);

                    if( $query ){
                    } else {
                        die("delete attempt failed");
                    }
                }
            ?>
        </div>
    </div>

    <div id="Services" class="tabcontent">
        <h3>Service List</h3>
        
        <br>

        <table border="1" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Service Name</th>
                    <th>Price per Unit</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM services ORDER BY ABS(service_id)";
                $query = mysqli_query($db, $sql);

                while($serv = mysqli_fetch_array($query)){
                    echo "<tr>";

                    echo "<td>".$serv['service_id']."</td>";
                    echo "<td>".$serv['service_name']."</td>";
                    echo "<td>".$serv['unit_price']."</td>";

                    echo "<td>";
                    echo "<button onClick=\"location.href='edit-service.php?id=".$serv['service_id']."';\">Edit</button> ";
                    echo "<button onClick=\"location.href='index.php?def=service&s_id=".$serv['service_id']."';\">Delete</button>";
                    echo "</td>";

                    echo "</tr>";
                }
                ?>
                <td colspan="3">
                    <button onClick="location.href='insert-service.php'">Add Service</button>
                </td>
            

            </tbody>
        </table>

        <p>Total: <?php echo mysqli_num_rows($query) ?></p>

        <div id="delete_s">
            <?php if(isset($_GET['s_id'])){
                    $id = $_GET['s_id'];

                    $sql = "DELETE FROM services WHERE service_id=$id";
                    $query = mysqli_query($db, $sql);

                    if( $query ){
                    } else {
                        die("delete attempt failed");
                    }
                }
            ?>
        </div>    
    </div>

    <div id="Gensokyo" class="tabcontent">
        <img src="goingtogensokyo.jpeg" alt="You are going to Gensokyo">
    </div>

    <?php if(isset($_GET['status'])): ?>
        <p>
            <?php
                if($_GET['status'] != 'success'){
                    echo "Insert attempt failed";
                }
            ?>
        </p>
    <?php endif; ?>

    <script>
        function openTable(tbl, tableName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tableName).style.display = "block";
            tbl.currentTarget.className += " active";
        }
        
        document.getElementById("defaultRoom").click();
    </script>

    <?php if(isset($_GET['def'])):   
        if($_GET['def'] == 'guest'){
            echo "<script>document.getElementById(\"defaultGuest\").click();</script>";
        }
        if($_GET['def'] == 'order'){
            echo "<script>document.getElementById(\"defaultOrder\").click();</script>";
        }
        if($_GET['def'] == 'service'){
            echo "<script>document.getElementById(\"defaultService\").click();</script>";
        }
   
    endif; ?>
    
</body>
</html>