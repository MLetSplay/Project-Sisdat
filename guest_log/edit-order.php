<?php

include("config.php");

if( !isset($_GET['id']) ){
    header('Location: index.php');
}

$id = $_GET['id'];

$sql = "SELECT * FROM orders WHERE order_id=$id";
$query = mysqli_query($db, $sql);
$order = mysqli_fetch_assoc($query);

if(mysqli_num_rows($query)<1){
    die("data not found");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Gensokyo Grand Hotel Guest Log</title>
    <link rel="stylesheet" href="aloguest.css">
</head>

<body>
    <header>
        <h3>Edit</h3>
    </header>

    <form action="#update" method="POST">
        <fieldset>
            <input type="hidden" name="id" value="<?php echo $order['order_id'] ?>" />

        <p>
            <label for="order_id">Order ID: </label>
            <input type="text" name="order_id" value="<?php echo $order['order_id'] ?>" />
        </p>
        <p>
            <label for="guest_id">Name: </label>
            <select name="guest_id" required>
                <option value=""></option>
                <?php
                    $sql = "SELECT * FROM guests ORDER BY ABS(guest_id)";
                    $g_query = mysqli_query($db, $sql);

                    while($g_id = mysqli_fetch_array($g_query)){
                        echo "<option>".$g_id['guest_id']."</option>";
                    }
                ?>
            </select>
        </p>
        <p>
            <label for="room_number">Room: </label>
            <select name="room_number" required>
                <option value=""></option>
                <?php
                    $sql = "SELECT * FROM rooms ORDER BY ABS(room_number)";
                    $r_query = mysqli_query($db, $sql);

                    while($room_no = mysqli_fetch_array($r_query)){
                        echo "<option>".$room_no['room_number']."</option>";
                    }
                ?>
            </select>
        </p>
        <p>
            <label for="order_date">Date: </label>
            <input type="date" name="order_date" />
        </p>
        <p>
            <label for="order_time">Time: </label>
            <input type="time" name="order_time" />
        </p>
        <p>
            <input type="submit" value="Save" name="save" />
        </p>
        </fieldset>
    </form>

    <br>

    <button onclick="history.go(-1);">Back </button>
    
    <div id="update">
        <?php
            include("config.php");
            function dateConvert($orgDate){
                $newDate = date("Y-m-d", strtotime($orgDate)); 
                return $newDate;
            }
            if(isset($_POST['save'])){
                $o_id = $_POST['order_id'];
                $g_id = $_POST['guest_id'];
                $room_no = $_POST['room_number'];
                $date = $_POST['order_date'];
                $time = $_POST['order_time'];

                $date = dateConvert($date);

                $sql = "UPDATE orders SET order_id='$o_id', guest_id='$g_id', room_number='$room_no', order_date='$date', order_time='$time' WHERE order_id=$id";
                $query = mysqli_query($db, $sql);

                if($query) {
                    header('Location: index.php?def=order');
                } else {
                    die("Failed to save changes");
                }
            }
        ?>
    </div>
    </body>
</html>