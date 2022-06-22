<?php 
require_once 'navbar.php';

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $htlid = $_POST['hotelid'];
    $rmnum = $_POST['roomnumber'];
    $rmtyp = $_POST['roomtype'];
    $rmstat = $_POST['roomstatus'];
    $rmrat = $_POST['roomrate'];
    $rmavon = $_POST['roomavon'];
    $rmnote = $_POST['roomnotes'];


    $collection = $client->pdmds->room;


    if (!empty($rmnote))
    {
        $myArray = [];
        array_push($myArray,$rmnote);
 
        $insertOneResult = $collection->insertOne([
            'hotel_id' => $htlid,
            'room_number' => (int)$rmnum,
            'room_type' => $rmtyp,
            'room_status' => $rmstat,
            'room_rate' => (int)$rmrat,
            'avb_on' => $rmavon,
            'room_notes' => $myArray
         ]);

    }
    else
    {
        $insertOneResult = $collection->insertOne([
            'hotel_id' => $htlid,
            'room_number' => (int)$rmnum,
            'room_type' => $rmtyp,
            'room_status' => $rmstat,
            'room_rate' => (int)$rmrat,
            'avb_on' => $rmavon,
         ]);

    }

     
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
</head>
<body>
    <div class="container py-5 d-flex justify-content-center ">
        <div class=" wrapper text-white ">
            <h3>Room Insert</h1>
            <br>
            <br>
            <form method="post">
            <div class="form-group ">
                <i class="fas fa-user"> Hotel List </i>
                <select class="form-select" aria-label="Default select example" id="hotelid" name="hotelid">
                    <option selected>Open this select menu</option>
                    <?php 
                    $collectionhotel = $client->pdmds->hotel;
                    $hoteloption = $collectionhotel ->find();

                    foreach($hoteloption as $attr)
                    {
                    echo '<option value="'.$attr['hotel_id'].'">', $attr['hotel_name'] ,'</option>';
                    }
                    ?>
                </select>
                </div>
<br>
            <div class="form-group ">
                    <i class="fas fa-user"> Room ID (Room Number)</i><input type="roomnumber" name="roomnumber" class="form-control" placeholder="Room Number" required>
                </div>
                <br>
                <div class="form-group ">
                    <i class="fas fa-user"> Room Type</i><input type="text" name="roomtype" class="form-control" placeholder="Ex: Superior" required>
                </div>
                <br>
                <div class="form-group ">
                    <i class="fas fa-user"> Room Status </i>
                    <select class="form-select" aria-label="Default select example" id="roomstatus" name="roomstatus">
                    <option selected>Open this select menu</option>
                    <option value="Available">Available</option>
                    <option value="Not Available">Not Available</option>
                </select>
                </div>
                <br>
                <div class="form-group ">
                    <i class="fas fa-user"> Room Rate </i><input type="text" name="roomrate" class="form-control" placeholder="Ex: 500000" required>
                </div>
                <br>
                <div class="form-group ">
                    <i class="fas fa-user"> Available on (if room not available only) </i><input type="date" name="roomavon" class="form-control" placeholder="Date" >
                </div>
                <br>
                <div class="form-group ">
                    <i class="fas fa-user"> Room Notes </i><input type="text" name="roomnotes" class="form-control" placeholder="Ex: Water Heater Broken" >
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" class="form-control btn btn-dark" value=" Insert Room"></input>
                </div>
                <br>
                <a href="room_view.php " class="form-control btn btn-secondary">View</a> <br> 
                
            </form>
        </div>
    </div>
</body>


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
</html>


