<?php include("config.php");?>
<!DOCTYPE html>
<html>
<head>
    <title>Grand Hotel Guest Log</title>
</head>

<body>
    <header>
        <h3>Insert Order</h3>
    </header>

    <form action="#process" method="POST">
        <fieldset>
            
            <p>
                <label for="order_id">ID: </label>
                <input type="text" name="order_id" required/>
            </p>
            <p>
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
                <input type="submit" value="Insert" name="insert" />
            </p>
        
        </fieldset>
    </form>

    <br>

    <button onclick="history.go(-1);">Back </button>

    <div id="process">
        <?php
            function dateConvert($orgDate){
                $newDate = date("Y-m-d", strtotime($orgDate)); 
                return $newDate;
            }

            if(isset($_POST['insert'])){
                $o_id = $_POST['order_id'];
                $g_id = $_POST['guest_id'];
                $room_no = $_POST['room_number'];
                $date = $_POST['order_date'];
                $time = $_POST['order_time'];

                $date = dateConvert($date);

                $sql = "INSERT INTO orders (order_id, guest_id, room_number, order_date, order_time) VALUE ('$o_id', '$g_id', '$room_no', '$date', '$time')";
                $query = mysqli_query($db, $sql);

                if( $query ) {
                    header('Location: index.php?status=success&def=order');
                } else {
                    header('Location: index.php?status=failed&def=order');
                }
            }
        ?>
    </div>
</body>

</html>