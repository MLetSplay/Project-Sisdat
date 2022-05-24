<?php

include("config.php");

if( !isset($_GET['id']) ){
    header('Location: index.php');
}

$id = $_GET['id'];

$sql = "SELECT * FROM services WHERE service_id=$id";
$query = mysqli_query($db, $sql);
$serv = mysqli_fetch_assoc($query);

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
            <input type="hidden" name="id" value="<?php echo $serv['service_id'] ?>" />

        <p>
            <label for="service_id">Service ID: </label>
            <input type="text" name="service_id" value="<?php echo $serv['service_id'] ?>" />
        </p>
        <p>
            <label for="service_name">Service Name: </label>
            <input type="text" name="service_name" value="<?php echo $serv['service_name'] ?>" />
        </p>
        <p>
            <label for="unit_price">Unit Price: </label>
            <input type="int" name="unit_price" value="<?php echo $serv['unit_price'] ?>" />
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
                $id = $_POST['s_id'];
                $s_id = $_POST['service_id'];
                $name = $_POST['service_name'];
                $prc_u = $_POST['price_unit'];

                $sql = "UPDATE services SET service_id='$s_id', service_name='$name', price_unit='$prc_u' WHERE service_id=$id";
                $query = mysqli_query($db, $sql);

                if($query) {
                    header('Location: index.php?def=service');
                } else {
                    die("Failed to save changes");
                }
            }
        ?>
    </div>
    </body>
</html>