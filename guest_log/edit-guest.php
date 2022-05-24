<?php

include("config.php");

if( !isset($_GET['id']) ){
    header('Location: index.php');
}

$id = $_GET['id'];

$sql = "SELECT * FROM guests WHERE guest_id=$id";
$query = mysqli_query($db, $sql);
$guest = mysqli_fetch_assoc($query);

if(mysqli_num_rows($query)<1){
    die("data not found");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Grand Hotel Guest Log</title>
    <link rel="stylesheet" href="aloguest.css">
</head>

<body>
    <header>
        <h3>Edit</h3>
    </header>

    <form action="#update" method="POST">
        <fieldset>
            <input type="hidden" name="id" value="<?php echo $guest['guest_id'] ?>" />

        <p>
            <label for="guest_id">ID: </label>
            <input type="text" name="guest_id" value="<?php echo $guest['guest_id'] ?>" />
        </p>
        <p>
            <label for="room_number">Room Number: </label>
            <input type="text" name="room_number" value="<?php echo $guest['room_number'] ?>" />
        </p>
        <p>
            <label for="guest_name">Name: </label>
            <input type="text" name="guest_name" value="<?php echo $guest['guest_name'] ?>" />
        </p>
        <p>
            <label for=guest_checkin">Check In Date: </label>
            <input type="date" name="guest_checkin"/>
        </p>
        <p>
            <label for="guest_checkout">Check Out Date: </label>
            <input type="date" name="guest_checkout"/>
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
                $g_id = $_POST['guest_id'];
                $room_no = $_POST['room_number'];
                $name = $_POST['guest_name'];
                $chkin = $_POST['guest_checkin'];
                $chkout = $_POST['guest_checkout'];

                $sql = "UPDATE guests SET guest_id='$g_id', room_number='$room_no', guest_name='$name', guest_checkin='$chkin', guest_checkout='$chkout' WHERE guest_id=$id";
                $query = mysqli_query($db, $sql);

                if($query) {
                    header('Location: index.php?def=guest');
                } else {
                    die("Failed to save changes");
                }
            }
        ?>
    </div>
    </body>
</html>