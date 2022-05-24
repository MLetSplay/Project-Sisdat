<?php include("config.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Grand Hotel Guest Log</title>
</head>

<body>
    <header>
        <h3>Room List</h3>
    </header>

    <nav>
        <a href="index.php">Home</a>
        <br><br>
        <a href="insert-room.php">[+] Add Room</a>
    </nav>
    
    <br>

    <table border="1">
    <thead>
        <tr>
            <th>Room Number</th>
            <th>Type</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $sql = "SELECT * FROM rooms";
        $query = mysqli_query($db, $sql);

        while($room = mysqli_fetch_array($query)){
            echo "<tr>";

            echo "<td>".$room['room_number']."</td>";
            echo "<td>".$room['room_type']."</td>";
            echo "<td>".$room['status']."</td>";

            echo "<td>";
            echo "<a href='edit-room.php?id=".$room['room_number']."'>Edit</a> | ";
            echo "<a href='room-list.php?id=".$room['room_number']."'>Delete</a>";
            echo "</td>";

            echo "</tr>";
        }
        ?>

    </tbody>
    </table>

    <p>Total: <?php echo mysqli_num_rows($query) ?></p>

    <?php if(isset($_GET['status'])): ?>
            <p>
                <?php
                    if($_GET['status'] == 'success'){
                        echo "Data inserted";
                    } else {
                        echo "Insert attempt failed";
                    }
                ?>
            </p>
    <?php endif; ?>

    <div id="delete">
        <?php if(isset($_GET['id'])){
                // ambil id dari query string
                $id = $_GET['id'];

                // buat query hapus
                $sql = "DELETE FROM rooms WHERE room_number=$id";
                $query = mysqli_query($db, $sql);

                // apakah query hapus berhasil?
                if( $query ){
                    header('Location: room-list.php');
                } else {
                    die("delete attempt failed");
                }
            }
        ?>
    </div>

    </body>
</html>