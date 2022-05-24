<?php 
    include("config.php");
    $id = $_GET['is_id'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Grand Hotel Guest Log</title>
</head>

<body>
    <header>
        <h3>Order <?php echo $id?></h3>
    </header>
    <div id="include-service">
        <table border="1">
            <thead>
                <tr>
                    <th>Service ID</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT service_id, qty, price FROM includes_services ORDER BY ABS(service_id)";
                $query = mysqli_query($db, $sql);

                while($serv = mysqli_fetch_array($query)){
                    echo "<tr>";

                    echo "<td>".$serv['service_id']."</td>";
                    echo "<td>".$serv['qty']."</td>";
                    echo "<td>".$serv['price']."</td>";

                    echo "<td>";
                    echo "<button onClick=\"location.href='include-service.php?is_id=".$id."&d_id=".$serv['service_id']."';\">Delete</button>";
                    echo "</td>";

                    echo "</tr>";
                }
                ?>
                <td colspan="3">
                    <?php
                    echo "<button onClick=\"location.href='insert-include.php?id=".$id."';\">Add Orders</button>"
                    ?>
                </td>
            

            </tbody>
        </table>

        <p>Total: <?php echo mysqli_num_rows($query) ?></p>

        <br>

        <button onclick="history.go(-1);">Back </button>

        <div id="delete_s">
            <?php if(isset($_GET['d_id'])){
                    $d_id = $_GET['d_id'];

                    $sql = "DELETE FROM includes_services WHERE service_id=$d_id";
                    $query = mysqli_query($db, $sql);

                    if( $query ){
                    } else {
                        die("delete attempt failed");
                    }
                }
            ?>
        </div>  
    </div>  