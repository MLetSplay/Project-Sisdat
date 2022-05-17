<!DOCTYPE html>
<html>
<head>
    <title>Grand Hotel Guest Log</title>
</head>

<body>
    <header>
        <h3>Insert Room</h3>
    </header>

    <form action="#process" method="POST">

        <fieldset>

        <p>
            <label for="room_number">Room Number: </label>
            <input type="text" name="room_number" />
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

    <div id="process">
        <?php
            include("config.php");
            // cek apakah tombol daftar sudah diklik atau blum?
            if(isset($_POST['insert'])){
                // ambil data dari formulir
                $room_no = $_POST['room_number'];
                $type = $_POST['room_type'];
                $stat = $_POST['status'];
                // buat query
                $sql = "INSERT INTO rooms (room_number, room_type, status) VALUE ('$room_no', '$type', '$stat')";
                $query = mysqli_query($db, $sql);
                // apakah query simpan berhasil?
                if( $query ) {
                    // kalau berhasil alihkan ke halaman index.php dengan status=sukses
                    header('Location: index.php?status=success');
                } else {
                    // kalau gagal alihkan ke halaman indek.php dengan status=gagal
                    header('Location: index.php?status=failed');
                }
            }
        ?>
    </div>
</body>

</html>