<?php include("config.php");?>
<!DOCTYPE html>
<html>
<head>
    <title>Gensokyo Grand Hotel Guest Log</title>
    <link rel="stylesheet" href="aloguest.css">
</head>

<body>
    <header>
        <h3>Insert Guest</h3>
    </header>

    <form action="#process" method="POST">
        <fieldset>

        <p>
            <label for="guest_id">ID: </label>
            <input type="text" name="guest_id" required/>
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
            <label for="guest_name">Name: </label>
            <input type="text" name="guest_name" />
        </p>
        <p>
            <label for="guest_checkin">Check In Date: </label>
            <input type="date" name="guest_checkin" />
        </p>
        <p>
            <label for="guest_checkout">Check Out Date: </label>
            <input type="date" name="guest_checkout" />
        </p>
        <p>
            <input type="submit" value="Insert" name="insert" />
        </p>
        
        </fieldset>
    </form>

    <br>

    <button onclick="location.href='index.php?def=service';">Back </button>

    <div id="process">
        <?php
            function dateConvert($orgDate){
                $newDate = date("Y-m-d", strtotime($orgDate)); 
                return $newDate;
            }
            if(isset($_POST['insert'])){
                $g_id = $_POST['guest_id'];
                $room_no = $_POST['room_number'];
                $name = $_POST['guest_name'];
                $chkin = $_POST['guest_checkin'];
                $chkout = $_POST['guest_checkout'];

                $chkin = dateConvert($chkin);
                $chkout = dateConvert($chkout);
               
                $sql = "INSERT INTO guests (guest_id, room_number, guest_name, guest_checkin, guest_checkout) VALUE ('$g_id', '$room_no', '$name', '$chkin', '$chkout')";
                $query = mysqli_query($db, $sql);

                if( $query ) {
                    header('Location: index.php?status=success&def=guest');
                } else {
                    header('Location: index.php?status=failed&def=guest');
                }
            }
        ?>
    </div>
</body>

</html>