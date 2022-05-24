<!DOCTYPE html>
<html>
<head>
    <title>Grand Hotel Guest Log</title>
    <link rel="stylesheet" href="aloguest.css">
</head>

<body>
    <header>
        <h3>Insert Services</h3>
    </header>

    <form action="#process" method="POST">
        <fieldset>

        <p>
            <label for="service_id">Service: </label>
            <select name="service_id" required>
                <option value=""></option>
                <?php
                    include("config.php");
                    $sql = "SELECT * FROM services ORDER BY ABS(service_id)";
                    $s_query = mysqli_query($db, $sql);

                    while($s_id = mysqli_fetch_array($s_query)){
                        echo "<option>".$s_id['service_id']."</option>";
                    }
                ?>
            </select>
        </p>
        <p>
            <label for="qty">Quantity: </label>
            <input type="int" name="qty" />
        </p>
        <p>
            <label for="price">Price: </label>
            <input type="int" name="price" />
        </p>
        <p>
            <input type="submit" value="Insert" name="insert" />
        </p>
        
        </fieldset>
    </form>
    
    <br>

    <button onclick="location.href='index.php?def=order';">Back </button>

    <div id="process">
        <?php
            include("config.php");
            $id = $_GET['id'];
            if(isset($_POST['insert'])){
                $s_id = $_POST['service_id'];
                $qty = $_POST['qty'];
                $prc_u = $_POST['price'];

                $sql = "INSERT INTO includes_services (order_id, service_id, qty, price) VALUE ('$id', '$s_id', '$qty', '$prc_u')";
                $query = mysqli_query($db, $sql);
                
                if( $query ) {
                    header('Location: include-service.php?status=success&is_id='.$id);
                } else {
                    header('Location: index.php?status=failed');
                }
            }
        ?>
    </div>
</body>

</html>