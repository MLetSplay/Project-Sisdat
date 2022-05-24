<?php

include("config.php");

if( !isset($_GET['id']) ){
    header('Location: index.php');
}

$id = $_GET['id'];

$sql = "SELECT * FROM rooms WHERE room_number=$id";
$query = mysqli_query($db, $sql);
$room = mysqli_fetch_assoc($query);

if(mysqli_num_rows($query)<1){
    die("data not found");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Grand Hotel Guest Log</title>
</head>

<body>
    <header>
        <h3>Edit</h3>
    </header>

    <form action="#update" method="POST">
        <fieldset>
            <input type="hidden" name="id" value="<?php echo $room['room_number'] ?>" />

        <p>
            <label for="room_number">Room Number: </label>
            <input type="text" name="room_number" value="<?php echo $room['room_number'] ?>" />
        </p>
        <p>
            <label for="room_type">Type: </label>
            <?php $type = $room['room_type']; ?>
            <select name="room_type">
                <option <?php echo ($type == 'Standard') ? "selected": "" ?>>Standard</option>
                <option <?php echo ($type == 'Deluxe') ? "selected": "" ?>>Deluxe</option>
                <option <?php echo ($type == 'Penhouse') ? "selected": "" ?>>Penhouse</option>
            </select>
        </p>
        <p>
            <label for="status">Status: </label>
            <?php $stat = $room['status']; ?>
            <select name="status">
                <option <?php echo ($stat == 'Vacant') ? "selected": "" ?>>Vacant</option>
                <option <?php echo ($stat == 'Booked') ? "selected": "" ?>>Booked</option>
                <option <?php echo ($stat == 'Occupied') ? "selected": "" ?>>Occupied</option>
            </select>
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
            if(isset($_POST['save'])){
                $id = $_POST['id'];
                $room_no = $_POST['room_number'];
                $type = $_POST['room_type'];
                $stat = $_POST['status'];

                $sql = "UPDATE rooms SET room_number='$room_no', room_type='$type', status='$stat' WHERE room_number=$id";
                $query = mysqli_query($db, $sql);

                if($query) {
                    header('Location: index.php');
                } else {
                    die("Failed to save changes");
                }
            }
        ?>
    </div>
    </body>
</html>