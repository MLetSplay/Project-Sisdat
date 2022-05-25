<!DOCTYPE html>
<html>
<head>
    <title>Gensokyo Grand Hotel Guest Log</title>
    <link rel="stylesheet" href="aloguest.css">
</head>

<body>
    <header>
        <h3>Insert Room</h3>
    </header>

    <form action="#process" method="POST">
        <fieldset>

        <p>
            <label for="room_number">Room Number: </label>
            <input type="text" name="room_number" required/>
        </p>
        <p>
            <label for="room_type">Type: </label>
            <select name="room_type">
                <option>Standard</option>
                <option>Deluxe</option>
                <option>Penhouse</option>
            </select>
        </p>
        <p>
            <label for="status">Status: </label>
            <select name="status">
                <option>Vacant</option>
                <option>Booked</option>
                <option>Occupied</option>
            </select>
        </p>
        <p>
            <input type="submit" value="Insert" name="insert" />
        </p>
        
        </fieldset>
    </form>
    
    <br>

    <button onclick="location.href='index.php?';">Back </button>

    <div id="process">
        <?php
            include("config.php");
            if(isset($_POST['insert'])){
                $room_no = $_POST['room_number'];
                $type = $_POST['room_type'];
                $stat = $_POST['status'];

                $sql = "INSERT INTO rooms (room_number, room_type, status) VALUE ('$room_no', '$type', '$stat')";
                $query = mysqli_query($db, $sql);
                
                if( $query ) {
                    header('Location: index.php?status=success');
                } else {
                    header('Location: index.php?status=failed');
                }
            }
        ?>
    </div>
</body>

</html>