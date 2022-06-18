<?php 
require_once 'navbar.php';
if($_SERVER["REQUEST_METHOD"] == "POST") 
{

    $htn = $_POST['hotelname'];
    $htt = $_POST['hoteltype'];
    $loc = $_POST['loc'];

    $collection = $client->pdmds->hotel;

    var_dump($collection->count());
    $nextid  = $collection->count()+1;
    
    $insertOneResult = $collection->insertOne([
        'hotel_id' => $nextid,
        'hotel_type' => $htt,
        'hotel_name' => $htn,
        'country_code' => $loc,
     ]);
     
     printf("Inserted %d document(s)\n", $insertOneResult->getInsertedCount());
     
     var_dump($insertOneResult->getInsertedId());

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="fa5/css/all.css" rel="stylesheet">
    <!--load all styles -->
    <script src="pace/pace.js"></script>
    <link href="pace/themes/silver/pace-theme-flash.css" rel="stylesheet" />
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">


    <style type="text/css">
        body {

            font: 14px sans-serif;
            background-image: url("/SODA/uploads/bg.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;


        }

        .wrapper {
            width: 350px;
            padding: 20px;
            background-color: lightslategray;
        }
    </style>
</head>
<body>
    <div class="container py-5 d-flex justify-content-center ">
        <div class=" wrapper text-white ">
            <h3>Hotel Insert</h1>
            <br>
            <br>
            <form method="post">
            <div class="form-group ">
                    <i class="fas fa-user"> Hotel Name</i><input type="text" name="hotelname" class="form-control" placeholder="Hotel Name" required>
                </div>
                <br>
                <div class="form-group ">
                    <i class="fas fa-user"> Hotel Type</i><input type="text" name="hoteltype" class="form-control" placeholder="Hotel Type" required>
                </div>
                <br>
                <div class="form-group ">
                    <i class="fas fa-user"> Country Location (3 char code)</i><input type="text" name="loc" class="form-control" placeholder="Ex: INA" required>
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" class="form-control btn btn-dark" value="Booking"></input>
                    
                </div>
                <br>
                <a href="hotel.php " class="form-control btn btn-secondary">View</a> <br> 
            </form>
        </div>
    </div>
</body>

</html>

