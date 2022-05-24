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
            <label for="service_id">Service ID: </label>
            <input type="text" name="service_id" required/>
        </p>
        <p>
            <label for="service_name">Service Name: </label>
            <input type="text" name="service_name" />
        </p>
        <p>
            <label for="unit_price">Unit: </label>
            <input type="int" name="unit_price" />
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
            include("config.php");
            if(isset($_POST['insert'])){
                $id = $_POST['service_id'];
                $name = $_POST['service_name'];
                $prc_u = $_POST['unit_price'];

                $sql = "INSERT INTO services (service_id, service_name, unit_price) VALUE ('$id', '$name', '$prc_u')";
                $query = mysqli_query($db, $sql);
                
                if( $query ) {
                    header('Location: index.php?status=success&def=service');
                } else {
                    header('Location: index.php?status=failed');
                }
            }
        ?>
    </div>
</body>

</html>